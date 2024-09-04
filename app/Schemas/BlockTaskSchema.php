<?php

namespace App\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "BlockTaskSchema",
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1
        ),
        new OA\Property(
            property: 'block_id',
            type: 'integer',
            example: 1
        ),
        new OA\Property(
            property: 'title',
            type: 'string',
        ),
        new OA\Property(
            property: 'details',
            type: 'string',
        ),
        new OA\Property(
            property: 'completed',
            type: 'boolean',
        ),
        new OA\Property(
            property: 'urgent',
            type: 'boolean',
        ),
        new OA\Property(
            property: 'created_at',
            type: 'datetime',
        ),
        new OA\Property(
            property: 'updated_at',
            type: 'datetime',
        ),
    ]

)]
class BlockTaskSchema
{
}
