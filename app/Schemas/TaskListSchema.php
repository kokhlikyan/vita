<?php

namespace App\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "TaskListSchema",
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
            type: 'string',
            example: '2024-01-01 00:00:00'
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
class TaskListSchema
{}
