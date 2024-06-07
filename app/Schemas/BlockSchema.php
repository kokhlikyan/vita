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
            property: 'name',
            type: 'string',
        ),
        new OA\Property(
            property: 'purpose',
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
            property: 'start_date',
            type: 'string',
            format: 'date',
            example: '05.06.2024',
            nullable: true
        ),
        new OA\Property(
            property: 'end_date',
            type: 'string',
            format: 'date',
            example: '05.06.2024',
            nullable: true
        ),
        new OA\Property(
            property: 'start_time',
            type: 'string',
            format: 'time',
            example: '12:00'
        ),
        new OA\Property(
            property: 'end_time',
            type: 'string',
            format: 'time',
            example: '12:00'
        ),
        new OA\Property(
            property: 'created_at',
            type: 'string',
            format: 'date-time',
            example: '05.06.2024 00:00:00',
        ),
        new OA\Property(
            property: 'updated_at',
            type: 'string',
            format: 'date-time',
            example: '05.06.2024 00:00:00',
        )
    ]
)]
class BlockSchema
{
}
