<?php

namespace App\Schemas;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PaginatorSchema",
    properties: [
        new OA\Property(
            property: 'total',
            type: 'integer',
            example: 100
        ),
        new OA\Property(
            property: 'count',
            type: 'integer',
            example: 10
        ),
        new OA\Property(
            property: 'per_page',
            type: 'integer',
            example: 10
        ),
        new OA\Property(
            property: 'current_page',
            type: 'integer',
            example: 1
        ),
        new OA\Property(
            property: 'total_pages',
            type: 'integer',
            example: 10
        ),
        new OA\Property(
            property: 'links',
            properties: [
                new OA\Property(
                    property: 'next',
                    type: 'string',
                    example: 'http://example.com/api/tasks?page=2'
                ),
                new OA\Property(
                    property: 'previous',
                    type: 'string',
                    example: 'https://example.com/api/tasks?page=1'
                )
            ],
            type: 'object'
        )
    ]
)]
class PaginatorSchema
{

}
