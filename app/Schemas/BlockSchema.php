<?php

namespace App\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "BlockSchema",
    properties: [
        new OA\Property(
            property: 'id',
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
            property: 'start_date',
            type: 'date',
        ),
        new OA\Property(
            property: 'from_time',
            type: 'string',
            example: '09:00:00'
        ),
        new OA\Property(
            property: 'to_time',
            type: 'string',
            example: '12:00:00'
        ),
        new OA\Property(
            property: 'end_date',
            type: 'string',
            format: 'date',
        ),
        new OA\Property(
            property: 'color',
            type: 'string',
        ),
        new OA\Property(
            property: 'created_at',
            type: 'datetime',
        ),
        new OA\Property(
            property: 'updated_at',
            type: 'datetime',
        ),
        new OA\Property(
            property: 'tasks',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/BlockTaskSchema'
            ),
        )
    ]
)]
class BlockSchema
{
}
