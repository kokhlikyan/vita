<?php

namespace App\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "TaskSchema",
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
            property: 'description',
            type: 'string',
        ),
        new OA\Property(
            property: 'completed',
            type: 'boolean',
        ),
        new OA\Property(
            property: 'all_day',
            type: 'boolean',
        ),
        new OA\Property(
            property: 'start_date',
            type: 'string',
            format: 'date',
        ),
        new OA\Property(
            property: 'end_date',
            type: 'string',
            format: 'date',
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
            property: 'recurrence',
            ref: RecurrenceSchema::class
        )
    ]

)]
class TaskSchema
{}
