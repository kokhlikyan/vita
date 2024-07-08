<?php

namespace App\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "SettingsSchema",
    properties: [
        new OA\Property(
            property: 'goals_color',
            type: 'string',
            example: '#FFFFFF'
        ),
        new OA\Property(
            property: 'habits_color',
            type: 'string',
            example: '#FFFFFF'
        ),
        new OA\Property(
            property: 'blocks_color',
            type: 'string',
            example: '#FFFFFF'
        ),
    ]
)]
class SettingsSchema
{

}
