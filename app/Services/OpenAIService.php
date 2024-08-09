<?php

namespace App\Services;

use AllowDynamicProperties;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OpenAIService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl;
    protected $user = null;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
        $this->model = env('OPENAI_MODEL');
        $this->baseUrl = 'https://api.openai.com/v1/chat/completions';
        $this->user = auth()->user();

    }

    private function post($userPrompt, $maxToken = 150)
    {
        $response = Http::timeout(120)->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->post($this->baseUrl, [
            'model' => $this->model,
            'max_tokens' => $maxToken,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful assistant.'
                ],
                [
                    'role' => 'user',
                    'content' => $userPrompt
                ]
            ]
        ]);
        return $response->json();
    }

    public function startDialog($type): array
    {
        $dialogName = $type . '_dialog_' . $this->user->getAuthIdentifier();
        Cache::delete($dialogName);
        $messages = [['role' => 'system', 'content' => "You are an assistant helping users create $type."]];
        $userMessage = "AI, create a $type for me.";
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        $response = $this->post($userMessage, 50);

        $messages[] = ['role' => 'assistant', 'content' => $response['choices'][0]['message']['content']];
        array_shift($messages);
        Cache::put($dialogName, $messages);

        return Cache::get($dialogName);
    }

    public function continueDialog($type, $userMessage)
    {
        $dialogName = $type . '_dialog_' . $this->user->getAuthIdentifier();
        $messages = Cache::get($dialogName, []);
        $messages[] = ['role' => 'user', 'content' => $userMessage];
        $prompt = json_encode($messages);
        $response = $this->post($prompt);
        $messages[] = ['role' => 'assistant', 'content' => $response['choices'][0]['message']['content']];
        Cache::put($dialogName, $messages);
        return Cache::get($dialogName);
    }

    public function finalizeDialog($type, $userMessage)
    {
        $dialogName = $type . '_dialog_' . $this->user->getAuthIdentifier();

        $messages = Cache::get($dialogName, []);
        $messages[] = ['role' => 'user', 'content' => $userMessage];
        $now = now();
        $prompt = json_encode($messages) . "response format json list of $type for example
            [{
                title: title,
                detail: detail,
                urgent: true or false default false but when user ask for urgent/important task it should be true,
                recurrence_type: only can be daily, weekly, monthly, and not required for one time task if not not need this field,
                start_date: user local time example format 2024-01-01 20:15:00 start date must be greater than now { $now },
                end_date: it is depend on dialog context example format 2024-01-01 20:15:00
                and in case of recurring should be greater than start date depending on recurrence type
                and I need seperated tasks for each recurring task for example if user ask for daily task for 5 days,
            }]
        ";


        $response = $this->post($prompt, 1500);

        $finalResponse = $response['choices'][0]['message']['content'];
        $goalDetails = $this->extractJsonArray($finalResponse) ?? [];
        Cache::delete($dialogName);
        return [
            'messages' => $messages,
            'data' => $goalDetails

        ];
    }

    public function extractJsonArray($string)
    {
        $jsonStart = strpos($string, '[');
        $jsonEnd = strrpos($string, ']') + 1;
        $jsonString = substr($string, $jsonStart, $jsonEnd - $jsonStart);

        return json_decode($jsonString, true);
    }
}
