<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\TaskFilterRequest;
use App\Http\Requests\TaskListQueryParamsRequest;
use App\Http\Resources\BlockResource;
use App\Http\Resources\PaginatorResource;
use App\Http\Resources\TaskListResource;
use App\Http\Resources\TaskResource;
use App\Models\User;
use App\Services\OpenAIService;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class TaskController extends Controller
{

    public function __construct(
        private readonly TaskService $taskService
    )
    {

    }


    #[OA\Get(
        path: "/api/v1/tasks",
        summary: "Get all tasks",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Tasks"],
        parameters: [
            new OA\Parameter(
                name: "search",
                description: "Search by title",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string")
            ),
            new OA\Parameter(
                name: 'page',
                description: 'The number of items to display per page (default 15)',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Tasks found",
                content: [
                    new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(ref: "#/components/schemas/TaskListSchema")
                            ),
                            new OA\Property(
                                property: 'pagination',
                                ref: "#/components/schemas/PaginatorSchema"
                            )
                        ]
                    )
                ]
            ),
            new OA\Response(
                response: 404,
                description: "Resource not found"
            ),
        ]
    )]
    public function all(TaskListQueryParamsRequest $request): JsonResponse
    {
        try {
            $search = $request->input('search', '');
            $page = $request->input('page');
            $tasks = $this->taskService->all($search, $page);
            return response()->json([
                'data' => TaskListResource::collection($tasks),
                'pagination' => new PaginatorResource($tasks)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }


    #[OA\Get(
        path: "/api/v1/tasks/{id}",
        summary: "Find resource by ID",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Tasks"],
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
                description: "Tasks found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/TaskSchema"
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Resource not found"
            ),
        ]
    )]
    public function findById($id): JsonResponse
    {
        try {
            $task = $this->taskService->findById($id);
            if (!$task) {
                return response()->json([
                    'message' => 'Resource not found'
                ], 404);
            }
            return response()->json([
                'data' => new TaskResource($task)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    #[OA\Post(
        path: "/api/v1/tasks",
        summary: "Create a new task",
        security: [
            ['bearerAuth' => []]
        ],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                required: [
                    'title',
                    'block_id',
                    'goal_id',
                    'habit_id',
                ],
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
                        property: 'goal_id',
                        type: 'integer',
                        example: 1
                    ),
                    new OA\Property(
                        property: 'habit_id',
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
                    ),
                ]
            )
        ),
        tags: ["Tasks"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Task created",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(ref: "#/components/schemas/TaskSchema")
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
        ]
    )]
    public function create(CreateTaskRequest $request, OpenAIService $openAIService): JsonResponse
    {

        $task = $this->taskService->create($request->validated());
        return response()->json([
            'data' => new TaskResource($task)
        ], 201);
    }


    #[OA\Delete(
        path: "/api/v1/tasks/{id}",
        summary: "Delete task by ID",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Tasks"],
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
    public function delete(TaskListQueryParamsRequest $request, $id): JsonResponse
    {
        $deleted = $this->taskService->delete($id);
        if (!$deleted) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        return response()->json(['message' => 'Resource deleted']);
    }


    #[OA\Put(
        path: "/api/v1/tasks/{id}",
        summary: "Update task by ID",
        security: [
            ['bearerAuth' => []]
        ],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                required: [],
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
                        property: 'goal_id',
                        type: 'integer',
                        example: 1
                    ),
                    new OA\Property(
                        property: 'habit_id',
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
                    ),
                ]
            )
        ),
        tags: ["Tasks"],
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
                description: "Resource updated",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/TaskSchema"
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
            new OA\Response(
                response: 404,
                description: "Resource not found"
            ),
        ]
    )]
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $updated = $this->taskService->update($request->all(), $id);
            if (!$updated) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
            $task = $this->taskService->findById($id);
            return response()->json([
                'data' => new TaskResource($task)
            ]);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json([
                'message' => 'Bad request'
            ], 400);
        }

    }


    #[OA\Patch(
        path: "/api/v1/tasks/{id}/completed",
        summary: "Mark task as completed or uncompleted",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Tasks"],
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
                description: "Resource updated"
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
            new OA\Response(
                response: 404,
                description: "Resource not found"
            ),
        ]
    )]
    public function makeCompleted($id): JsonResponse
    {
        try {
            $completed = $this->taskService->makeCompleted($id);
            if (!$completed) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
            return response()->json(['message' => 'Resource updated']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Bad request'
            ], 400);
        }
    }


    #[OA\Get(
        path: "/api/v1/tasks/list",
        summary: "List tasks",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Tasks"],
        parameters: [
            new OA\Parameter(
                name: "sort",
                description: "Sort by day count",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "integer")
            ),
            new OA\Parameter(
                name: "date",
                description: "Date",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string", format: "date", example: "2024-01-01")
            ),
            new OA\Parameter(
                name: "type",
                description: "Type",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string", enum: ["independent", "goal", "habit", "block"])
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Tasks found",
                content: [
                    new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                properties: [
                                    new OA\Property(
                                        property: 'tasks',
                                        type: 'array',
                                        items: new OA\Items(ref: "#/components/schemas/TaskSchema")
                                    ),
                                    new OA\Property(
                                        property: 'blocks',
                                        type: 'array',
                                        items: new OA\Items(ref: "#/components/schemas/BlockSchema")
                                    )
                                ],
                                type: 'object'
                            )
                        ]
                    )
                ]
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
        ]
    )]
    public function list(TaskListQueryParamsRequest $request): JsonResponse
    {
        try {
            $data = $this->taskService->list($request->validated());
            return response()->json([
                'data' => [
                    'tasks' => TaskResource::collection($data['tasks']),
                    'blocks' => BlockResource::collection($data['blocks'])
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }


    #[OA\Get(
        path: "/api/v1/tasks/filter",
        summary: "Filter tasks",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Tasks"],
        parameters: [
            new OA\Parameter(
                name: "date",
                description: "Date",
                in: "query",
                required: true,
                schema: new OA\Schema(type: "string", format: "date", example: "2024-01-01")
            ),
            new OA\Parameter(
                name: "type",
                description: "Type",
                in: "query",
                required: true,
                schema: new OA\Schema(type: "string", enum: ["block", "goal", "habit"])
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Tasks found",
                content: [
                    new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(ref: "#/components/schemas/TaskSchema")
                            )
                        ]
                    )
                ]
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
        ]
    )]
    public function filteredTasks(TaskFilterRequest $request): JsonResponse
    {
        try {
            $tasks = $this->taskService->filteredTasks($request->validated());
            return response()->json([
                'data' => TaskResource::collection($tasks)
            ]);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json([
                'message' => 'Bad request'
            ], 400);
        }
    }


    #[OA\Get(
        path: "/api/v1/tasks/history",
        summary: "Get task history",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Tasks"],
        parameters: [
            new OA\Parameter(
                name: "page",
                description: "The number of items to display per page (default 15)",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "integer")
            ),
            new OA\Parameter(
                name: "date",
                description: "Date to filter by",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string", format: "date", example: "2024-01-01")
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Tasks found",
                content: [
                    new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(ref: "#/components/schemas/TaskSchema")
                            ),
                            new OA\Property(
                                property: 'pagination',
                                ref: "#/components/schemas/PaginatorSchema"
                            )
                        ]
                    )
                ]
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
        ]
    )]
    public function getHistory(TaskListQueryParamsRequest $request): JsonResponse
    {
        try {
            $history = $this->taskService->getHistory($request->validated());
            return response()->json([
                'data' => TaskResource::collection($history),
                'pagination' => new PaginatorResource($history)
            ]);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json([
                'message' => 'Bad request'
            ], 400);
        }
    }

    #[OA\Get(
        path: "/api/v1/tasks/overview",
        summary: "Get task overview",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Tasks"],
        parameters: [
            new OA\Parameter(
                name: "page",
                description: "The number of items to display per page (default 15)",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "integer")
            ),
            new OA\Parameter(
                name: "date",
                description: "Date to filter by",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string", format: "date", example: "2024-01-01")
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Tasks found",
                content: [
                    new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(ref: "#/components/schemas/TaskSchema")
                            ),
                            new OA\Property(
                                property: 'pagination',
                                ref: "#/components/schemas/PaginatorSchema"
                            )
                        ]
                    )
                ]
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
        ]
    )]
    public function getOverview(TaskListQueryParamsRequest $request): JsonResponse
    {
        try {
            $history = $this->taskService->getOverview($request->validated());
            return response()->json([
                'data' => TaskResource::collection($history),
                'pagination' => new PaginatorResource($history)
            ]);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json([
                'message' => 'Bad request'
            ], 400);
        }
    }


    #[OA\Get(
        path: "/api/v1/tasks/missed",
        summary: "Get missed tasks",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Tasks"],
        parameters: [
            new OA\Parameter(
                name: "page",
                description: "The number of items to display per page (default 15)",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "integer")
            ),
            new OA\Parameter(
                name: "date",
                description: "Date to filter by",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string", format: "date", example: "2024-01-01")
            ),
            new OA\Parameter(
                name: "today",
                description: "Filter by today",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "boolean")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Tasks found",
                content: [
                    new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(ref: "#/components/schemas/TaskSchema")
                            ),
                            new OA\Property(
                                property: 'pagination',
                                ref: "#/components/schemas/PaginatorSchema"
                            )
                        ]
                    )
                ]
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
        ]
    )]
    public function getMissedTasks(TaskListQueryParamsRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $tasks = $this->taskService->getMissedTasks($validated);
            if (isset($validated['today']) && $validated['today']) {
                return response()->json([
                    'data' => TaskResource::collection($tasks),
                ]);
            }
            return response()->json([
                'data' => TaskResource::collection($tasks),
                'pagination' => new PaginatorResource($tasks)
            ]);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json([
                'message' => 'Bad request'
            ], 400);
        }
    }

    #[OA\Patch(
        path: "/api/v1/tasks/{id}/urgent",
        summary: "Mark task as completed or uncompleted",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Tasks"],
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
                description: "Resource updated"
            ),
            new OA\Response(
                response: 400,
                description: "Bad request"
            ),
            new OA\Response(
                response: 404,
                description: "Resource not found"
            ),
        ]
    )]
    public function makeUrgent($id): JsonResponse
    {
        try {
            $urgent = $this->taskService->makeUrgent($id);
            if (!$urgent) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
            return response()->json(['message' => 'Resource updated']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Bad request'
            ], 400);
        }
    }

}
