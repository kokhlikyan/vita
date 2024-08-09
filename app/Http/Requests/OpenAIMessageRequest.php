<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenAIMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'prompt' => [ 'string'],
            'type' => ['string', 'in:goal,habit,task'],
            'chat_id' => ['string', 'uuid']
        ];
    }
}