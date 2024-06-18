<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;

#[
    OA\Info(version: "1.0.0", description: "petshop api", title: "Vita API Documentation"),
    OA\Server(url: 'http://localhost:8000', description: "local server"),
    OA\Server(url: 'https://8009.freelancedeveloper.site', description: "remote server"),
    OA\SecurityScheme( securityScheme: 'bearerAuth', type: "http", name: "Authorization", in: "header", scheme: "bearer"),
]

abstract class Controller
{

}
