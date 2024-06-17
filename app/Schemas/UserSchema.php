<?php

namespace App\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "UserSchema",
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1
        ),
        new OA\Property(
            property: 'first_name',
            type: 'string',
            example: 'John'
        ),
        new OA\Property(
            property: 'last_name',
            type: 'string',
            example: 'Doe'
        ),
        new OA\Property(
            property: 'email',
            type: 'string',
            example: 'test@gmail.com'
        ),
        new OA\Property(
            property: 'email_verified_at',
            type: 'datetime',
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
class UserSchema
{

}
