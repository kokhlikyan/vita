<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockQueryParamsRequest;
use App\Http\Requests\CreateBlockRequest;
use App\Http\Requests\UpdateBlockRequest;
use App\Http\Resources\BlockResource;
use App\Services\BlockService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use OpenApi\Attributes as OA;
use App\Schemas\BlockSchema;

class BlockController extends Controller
{
    public function __construct(private BlockService $blockService)
    {
    }

    #[OA\Get(
        path: "/api/v1/blocks",
        summary: "Get all blocks",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Blocks"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Blocks found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(ref: "#/components/schemas/BlockSchema")
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
    public function all(Request $request): AnonymousResourceCollection
    {
        return BlockResource::collection($this->blockService->all());
    }

    #[OA\Get(
        path: "/api/v1/blocks/{id}",
        summary: "Find resource by ID",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Blocks"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "The ID of the resource",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            ),
            new OA\Parameter(
                name: "date",
                description: "The date of the resource",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string", format: "date")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Blocks found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/BlockSchema",
                            type: 'object',
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
    public function findById(BlockQueryParamsRequest $request, int $id): BlockResource|JsonResponse
    {
        $block = $this->blockService->find($id, $request->validated());
        if ($block === null) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        return new BlockResource($block, $request->validated());
    }


    #[OA\Post(
        path: "/api/v1/blocks",
        summary: "Create a new block",
        security: [
            ['bearerAuth' => []]
        ],
        requestBody: new OA\RequestBody(
            content: new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    required: [
                        'title',
                        'start_date',
                    ],
                    properties: [
                        new OA\Property(property: 'title', description: 'The title of the block', type: 'string'),
                        new OA\Property(property: 'details', description: 'Additional details about the block', type: 'string', nullable: true),
                        new OA\Property(property: 'repeat_every', description: 'Repeat every specified interval', type: 'integer', nullable: true),
                        new OA\Property(property: 'repeat_type', description: 'Type of repetition (e.g., day, week)', type: 'string', nullable: true),
                        new OA\Property(property: 'repeat_on', description: 'Days to repeat on (if applicable)', type: 'array', items: new OA\Items(type: 'integer'), nullable: true),
                        new OA\Property(property: 'start_date', description: 'Must be greater than or equal to the now', type: 'string', format: 'date', example: '2024-06-05'),
                        new OA\Property(property: 'end_date', description: 'The end date of the block', type: 'string', format: 'date', example: '2024-06-05', nullable: true),
                        new OA\Property(property: 'from_time', description: 'Start time of the block', type: 'string', format: 'time', example: '12:15'),
                        new OA\Property(property: 'to_time', description: 'End time of the block', type: 'string', format: 'time', example: '15:00'),
                        new OA\Property(property: 'end_on', description: 'You can only provide one of the following: end_on, end_after', type: 'string', format: 'date', example: '2024-06-05', nullable: true),
                        new OA\Property(property: 'end_after', description: 'You can only provide one of the following: end_on, end_after', type: 'integer', example: 5, nullable: true),
                        new OA\Property(property: 'color', description: 'Color associated with the block', type: 'string', nullable: true),
                    ],
                    type: 'object'
                )
            )
        ),
        tags: ["Blocks"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Block created",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/BlockSchema",
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
    public function create(CreateBlockRequest $request): JsonResponse
    {
        try {
            if ($request->filled('end_on') && $request->filled('end_after')) {
                return response()->json(['message' => 'You can only provide one of the following: end_on, end_after'], 422);
            }
            $data = [
                'user_id' => auth()->user()->id,
                ...$request->validated()
            ];
            $block = $this->blockService->create($data);
            return response()->json([
                'data' => new BlockResource($block),
            ], 201);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json(['message' => 'Bad request'], 400);
        }
    }

    #[OA\Delete(
        path: "/api/v1/blocks/{id}",
        summary: "Delete block by ID",
        security: [
            ['bearerAuth' => []]
        ],
        tags: ["Blocks"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "The ID of the resource",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            ),
            new OA\Parameter(
                name: "type",
                description: "Type of the block should be one of the following: all, this, following",
                in: "query",
                required: true,
                schema: new OA\Schema(type: "string")
            ),
            new OA\Parameter(
                name: "date",
                description: "The date of the resource",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string", format: "date")
            ),
            new OA\Parameter(
                name: "end_type",
                description: "Type of the end date should be one of the following: on, after, never",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "string")
            ),
            new OA\Parameter(
                name: "end_after",
                description: "The end after of the resource",
                in: "query",
                required: false,
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
    public function delete(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'type' => 'required|string|in:all,this,following',
                'end_type' => 'required_unless:type,all|string|in:on,after,never',
                'date' => 'required|date',
                'end_after' => 'required_if:end_type,after|integer',
            ], [
                'end_type.in' => 'You can only provide one of the following: on, after',
            ]);
            $deleted = $this->blockService->delete($id, $request->all());
            if (!$deleted) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
            return response()->json(['message' => 'Resource deleted']);
        }Catch (ValidationException $e){
            return response()->json(['message' => $e->getMessage()], 422);
        }
        catch (\Exception $e){
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json(['message' => 'Bad request'], 400);
        }
    }


    #[OA\Put(
        path: "/api/v1/blocks/{id}",
        summary: "Update block by ID",
        security: [
            ['bearerAuth' => []]
        ],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                required: [
                    'type',
                ],
                properties: [
                        new OA\Property(property: 'type', description: 'Type of the block should be one of the following: all, this, following', type: 'string'),
                        new OA\Property(property: 'date', description: 'The date of the resource required if type is following', type: 'string', format: 'date', nullable: true),
                        new OA\Property(property: 'title', description: 'The title of the block', type: 'string'),
                        new OA\Property(property: 'details', description: 'Additional details about the block', type: 'string', nullable: true),
                        new OA\Property(property: 'repeat_every', description: 'Repeat every specified interval', type: 'integer', nullable: true),
                        new OA\Property(property: 'repeat_type', description: 'Type of repetition (e.g., day, week)', type: 'string', nullable: true),
                        new OA\Property(property: 'repeat_on', description: 'Days to repeat on (if applicable)', type: 'array', items: new OA\Items(type: 'integer'), nullable: true),
                        new OA\Property(property: 'start_date', description: 'Must be greater than or equal to the now', type: 'string', format: 'date', example: '2024-06-05'),
                        new OA\Property(property: 'end_date', description: 'The end date of the block', type: 'string', format: 'date', example: '2024-06-05', nullable: true),
                        new OA\Property(property: 'from_time', description: 'Start time of the block', type: 'string', format: 'time', example: '12:15'),
                        new OA\Property(property: 'to_time', description: 'End time of the block', type: 'string', format: 'time', example: '15:00'),
                        new OA\Property(property: 'end_on', description: 'You can only provide one of the following: end_on, end_after', type: 'string', format: 'date', example: '2024-06-05', nullable: true),
                        new OA\Property(property: 'end_after', description: 'You can only provide one of the following: end_on, end_after', type: 'integer', example: 5, nullable: true),
                        new OA\Property(property: 'color', description: 'Color associated with the block', type: 'string', nullable: true),
                ],
                type: 'object'
            )
        ),
        tags: ["Blocks"],
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
                description: "Block updated",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: "#/components/schemas/BlockSchema",
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
                response: 404,
                description: "Resource not found"
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )

        ]
    )]
    public function update(UpdateBlockRequest $request, $id): JsonResponse
    {
        if (empty($request->validated())) {
            return response()->json(['message' => 'Bad request'], 400);
        }
        $block = $this->blockService->find($id);
        if (!$block) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        $block = $this->blockService->update($request->validated(), $id);
        return response()->json([
            'data' => new BlockResource($block),
        ]);
    }

    public function filteredByDate(Request $request, $date): JsonResponse
    {
        $blocks = $this->blockService->filteredByDate($date, $request->input('sort', 1));
        if (empty($blocks)) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        return response()->json([
            'data' => BlockResource::collection($blocks),
        ]);
    }
}
