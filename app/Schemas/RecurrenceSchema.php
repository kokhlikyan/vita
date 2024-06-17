<?php

namespace App\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "RecurrenceSchema",
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1
        ),
        new OA\Property(
            property: 'task_id',
            type: 'integer',
        ),
        new OA\Property(
            property: 'recurrence_type',
            type: 'string',
            example: 'daily, weekly, monthly'
        ),
        new OA\Property(
            property: 'interval',
            type: 'integer',
        ),
        new OA\Property(
            property: 'day_of_week',
            type: 'integer',
        ),
        new OA\Property(
            property: 'day_of_month',
            type: 'integer',
        ),
        new OA\Property(
            property: 'month_of_year',
            type: 'string',
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
        )
    ]
)]
class RecurrenceSchema
{
}
