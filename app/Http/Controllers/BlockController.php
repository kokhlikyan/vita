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
    public function findById(BlockQueryParamsRequest $request,int $id): BlockResource | JsonResponse
    {
        $block = $this->blockService->find($id, $request->validated());
        if ($block === null) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        return new BlockResource($block,$request->validated());
    }


    #[OA\Post(
        path: "/api/v1/blocks",
        summary: "Create a new block",
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
                    new OA\Property(property: 'type', description: 'Type of the block should be one of the following: temporary, permanent, completed', type: 'string'),
                    new OA\Property(property: 'color', type: 'string', nullable: true),
                    new OA\Property(property: 'start_date', type: 'string', format: 'date', example: '05.06.2024'),
                    new OA\Property(property: 'end_date', type: 'string', format: 'date', example: '05.06.2024'),
                    new OA\Property(property: 'start_time', type: 'string', format: 'time', example: '12:15'),
                    new OA\Property(property: 'end_time', type: 'string', format: 'time', example: '15:00')
                ],
                type: 'object'
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
        $deleted = $this->blockService->delete($id);
        if (!$deleted) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        return response()->json(['message' => 'Resource deleted']);
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
                    'name',
                    'type',
                ],
                properties: [
                    new OA\Property(property: 'title', type: 'string'),
                    new OA\Property(property: 'details', type: 'string', nullable: true),
                    new OA\Property(property: 'type', description: 'Type of the block should be one of the following: temporary, permanent, completed', type: 'string'),
                    new OA\Property(property: 'color', type: 'string', nullable: true),
                    new OA\Property(property: 'start_date', type: 'string', format: 'date', example: '05.06.2024'),
                    new OA\Property(property: 'end_date', type: 'string', format: 'date', example: '05.06.2024'),
                    new OA\Property(property: 'start_time', type: 'string', format: 'time', example: '12:15'),
                    new OA\Property(property: 'end_time', type: 'string', format: 'time', example: '15:00')
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
        $updated = $this->blockService->update($request->validated(), $id);
        if (!$updated) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        $block = $this->blockService->find($id);
        return response()->json([
            'data' => new BlockResource($block),
        ]);
    }
}
