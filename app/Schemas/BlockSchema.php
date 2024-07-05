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
            property: 'type',
            description: 'Type of the block should be one of the following: temporary, permanent, completed',
            type: 'string',
        ),
        new OA\Property(
            property: 'color',
            type: 'string',
        ),
        new OA\Property(
            property: 'tasks',
            ref: TaskSchema::class
        ),
        new OA\Property(
            property: 'start_date',
            type: 'datetime',
            nullable: true
        ),
        new OA\Property(
            property: 'end_date',
            type: 'datetime',
            nullable: true
        ),
        new OA\Property(
            property: 'start_time',
            type: 'string',
            format: 'time',
            example: '12:00:00'
        ),
        new OA\Property(
            property: 'end_time',
            type: 'string',
            format: 'time',
            example: '12:00:00'
        ),
        new OA\Property(
            property: 'created_at',
            type: 'datetime',
        ),
        new OA\Property(
            property: 'updated_at',
            type: 'datetime',
        )
    ]
)]
class BlockSchema
{
}
