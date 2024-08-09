<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpenAIMessageRequest;
use App\Services\GoalService;
use App\Services\HabitService;
use App\Services\OpenAIService;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OpenAIController extends Controller
{
    public function __construct(
        protected OpenAIService $service,
        protected TaskService $taskService,
        protected GoalService $goalService,
        protected HabitService $habitService
    )
    {
    }
    public function startDialog(OpenAIMessageRequest $request): JsonResponse
    {
        $type = $request->input('type');
        $result = $this->service->startDialog($type);
        return response()->json($result);
    }

    public function continueDialog(OpenAIMessageRequest $request)
    {
        $type = $request->input('type');
        $prompt = $request->input('prompt');
        $result = $this->service->continueDialog($type, $prompt);
        return response()->json($result);
    }

    public function finalizeDialog(OpenAIMessageRequest $request)
    {
        set_time_limit(120);
        $user = auth()->user();
        $type = $request->input('type');
        $prompt = $request->input('prompt');
        $result = $this->service->finalizeDialog($type, $prompt);
        Log::info(json_encode($result));
        $taskType = null;
        if ($type === 'goal') {
            $taskType = $this->goalService->create([
                'user_id' => $user->id,
                'title' => $result['messages'][2]['content'],
                'details' => $result['messages'][count($result['messages']) - 3]['content'],
            ]);
        } elseif ($type === 'habit') {
           $taskType = $this->habitService->create([
                'user_id' => $user->id,
                'title' => $result['messages'][2]['content'],
                'details' => $result['messages'][count($result['messages']) - 3]['content'],
            ]);
        }
        if ($result['data']){
            $data = [
                'user_id' => $user->id,
            ];
            if ($taskType === 'goal'){
                $data['goal_id'] = $taskType->id;
            } elseif ($taskType === 'habit'){
                $data['habit_id'] = $taskType->id;
            }
            foreach ($result['data'] as $res){
                if (isset($data['recurrence_type'])){
                    $data['recurrence_type'] = $res['recurrence_type'];
                }
                $data['title'] = $res['title'];
                $data['details'] = $res['detail'];
                $data['start_date'] = $res['start_date'];
                $data['end_date'] = $res['end_date'];
                $this->taskService->create($data);
            }
        }
        return response()->json([
            'message' => 'Task created successfully',
        ]);
    }
}
