<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Http\Resources\GoalResource;
use App\Services\GoalService;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class GoalController extends Controller
{

    public function __construct(
        private readonly GoalService $goalService,
        private readonly TaskService $taskService
    )
    {
    }


    #[OA\Get(
        path: "/api/v1/goals",
        summary: "Get all goals",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Goals"],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of goals",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                ref: "#/components/schemas/GoalSchema"
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function all(): AnonymousResourceCollection
    {
        return GoalResource::collection($this->goalService->all());
    }


    #[OA\Get(
        path: "/api/v1/goals/{id}",
        summary: "Find goal by ID",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Goals"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "The ID of the resource",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Goal found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/GoalSchema",
                            type: 'object'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Resource not found"
            )
        ]
    )]
    public function findById($id): JsonResponse
    {
        $goal = $this->goalService->find($id);
        if (!$goal) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        return response()->json([
            'data' => new GoalResource($goal),
        ]);
    }


    #[OA\Post(
        path: "/api/v1/goals",
        summary: "Create a new goal",
        security: [
            ['bearerAuth' => []]
        ],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                required: [
                    'name',
                    'type',
                ],
                properties: [
                    new OA\Property(property: 'title', type: 'string'),
                    new OA\Property(property: 'details', type: 'string', nullable: true),
                    new OA\Property(
                        property: 'tasks',
                        type: 'array',
                        items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: 'title',
                                    type: 'string',
                                    example: 'Task title'
                                ),
                                new OA\Property(
                                    property: 'details',
                                    type: 'string',
                                    example: 'Task details'
                                ),
                                new OA\Property(
                                    property: 'block_id',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'completed',
                                    type: 'boolean',
                                    example: false
                                ),
                                new OA\Property(
                                    property: 'start_date',
                                    type: 'string',
                                    format: 'date',
                                    example: '2022-06-10'
                                )
                            ],
                            type: 'object'
                        )
                    ),
                ],
                type: 'object'
            )
        ),
        tags: ["Goals"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Goal created",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/GoalSchema",
                            type: 'object'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )

        ]
    )]
    public function create(CreateGoalRequest $request): JsonResponse
    {

        try {
            $data = [
                'user_id' => auth()->user()->id,
                'title' => $request->get('title'),
                'details' => $request->get('details', ''),
            ];

            $goal = $this->goalService->create($data);
            if ($request->has('tasks')) {
                foreach ($request->get('tasks') as $task) {
                    $task['goal_id'] = $goal->id;
                    $this->taskService->create($task);
                }
            }
            return response()->json([
                'data' => new GoalResource($goal),
            ], 201);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json(['message' => 'Bad request'], 400);
        }


    }

    #[OA\Delete(
        path: "/api/v1/goals/{id}",
        summary: "Delete goal by ID",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Goals"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "The ID of the resource",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Resource deleted"
            ),
            new OA\Response(
                response: 404,
                description: "Resource not found"
            ),
        ]
    )]
    public function delete($id): JsonResponse
    {
        try {
            $deleted = $this->goalService->delete($id);
            if (!$deleted) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
            return response()->json(['message' => 'Goal deleted']);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json(['message' => 'Bad request'], 400);
        }
    }


    #[OA\Put(
        path: "/api/v1/goals/{id}",
        summary: "Update goal by ID",
        security: [
            ['bearerAuth' => []]
        ],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                required: [
                    'name',
                    'type',
                ],
                properties: [
                    new OA\Property(property: 'title', type: 'string'),
                    new OA\Property(property: 'details', type: 'string', nullable: true),
                ],
                type: 'object'
            )
        ),
        tags: ["Goals"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "The ID of the resource",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Goal updated",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/GoalSchema",
                            type: 'object'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Resource not found"
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )
        ]
    )]
    public function update(UpdateGoalRequest $request, $id): JsonResponse
    {
        $updated = $this->goalService->update($request->validated(), $id);
        if (!$updated) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        $goal = $this->goalService->find($id);
        return response()->json([
            'data' => new GoalResource($goal),
        ]);
    }
}
