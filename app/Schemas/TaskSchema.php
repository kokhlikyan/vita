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
        new OA\property(
            property: 'block',
            properties: [
                new OA\Property(
                    property: 'id',
                    type: 'integer',
                ),
                new OA\Property(
                    property: 'name',
                    type: 'string',
                ),
            ],
            type: 'object'
        ),
        new OA\property(
            property: 'goal',
            properties: [
                new OA\Property(
                    property: 'id',
                    type: 'integer',
                ),
                new OA\Property(
                    property: 'name',
                    type: 'string',
                ),
            ],
            type: 'object'
        ),
        new OA\property(
            property: 'habit',
            properties: [
                new OA\Property(
                    property: 'id',
                    type: 'integer',
                ),
                new OA\Property(
                    property: 'name',
                    type: 'string',
                ),
            ],
            type: 'object'
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
            property: 'all_day',
            type: 'boolean',
        ),
        new OA\Property(
            property: 'start_date',
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
    ]

)]
class TaskSchema
{}
