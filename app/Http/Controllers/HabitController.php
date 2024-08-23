<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Http\Resources\HabitResource;
use App\Services\HabitService;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;


class HabitController extends Controller
{
    public function __construct(
        private readonly HabitService $habitService,
        private readonly TaskService $taskService,
    )
    {
    }


    #[OA\Get(
        path: "/api/v1/habits",
        summary: "Get all habits",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Habits"],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of habits",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                ref: "#/components/schemas/HabitSchema"
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function all(): AnonymousResourceCollection
    {
        return HabitResource::collection($this->habitService->all());
    }

    #[OA\Get(
        path: "/api/v1/habits/{id}",
        summary: "Find goal by ID",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Habits"],
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
                description: "Habit found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/HabitSchema",
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
        $habit = $this->habitService->findById($id);
        if (!$habit) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        return response()->json([
            'data' => new HabitResource($habit)
        ]);
    }


    #[OA\Post(
        path: "/api/v1/habits",
        summary: "Create a new habit",
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
                    )

                ],
                type: 'object'
            )
        ),
        tags: ["Habits"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Habit created",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/HabitSchema",
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
    public function create(CreateHabitRequest $request): JsonResponse
    {
        try {
            $data = [
                'user_id' => auth()->user()->id,
                'title' => $request->input('title'),
                'details' => $request->input('details', ''),
            ];
            $habit = $this->habitService->create($data);
            if ($request->has('tasks')) {
                $tasks = $request->input('tasks');
                foreach ($tasks as $task) {
                    $task['habit_id'] = $habit->id;
                    $this->taskService->create($task);
                }
            }
            return response()->json([
                'data' => new HabitResource($habit),
            ], 201);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json(['message' => 'Bad request'], 400);
        }
    }


    #[OA\Put(
        path: "/api/v1/Habits/{id}",
        summary: "Update habit by ID",
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
        tags: ["Habits"],
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
                description: "Habit updated",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/HabitSchema",
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
    public function update(UpdateHabitRequest $request, $id): JsonResponse
    {
        try {
            $updated = $this->habitService->update($request->validated(), $id);
            if (!$updated) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
            $habit = $this->habitService->findById($id);
            return response()->json([
                'data' => new HabitResource($habit),
            ]);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json(['message' => 'Bad request'], 400);
        }
    }


    #[OA\Delete(
        path: "/api/v1/habits/{id}",
        summary: "Delete habit by ID",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Habits"],
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
    public function delete($id)
    {
        try {
            $deleted = $this->habitService->delete($id);
            if (!$deleted) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
            return response()->json(['message' => 'Habit deleted']);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json(['message' => 'Bad request'], 400);
        }
    }
}
