<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use App\Services\SettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class SettingsController extends Controller
{

    public function __construct(
        private readonly SettingsService $settingsService
    )
    {

    }

    #[OA\Post(
        path: "api/v1/settings",
        security: [
            ["sanctum" => []]
        ],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "goals_color", type: "string"),
                    new OA\Property(property: "habits_color", type: "string"),
                ],
                type: "object"
            )
        ),
        tags: ["Settings"],
        responses: [
            new OA\Response(
                response: "201",
                description: "Settings created successfully.",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string")
                    ]
                )
            ),
            new OA\Response(
                response: "200",
                description: "Settings updated successfully.",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string")
                    ]
                )
            ),
            new OA\Response(
                response: "400",
                description: "An error occurred while creating or updating settings.",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string")
                    ]
                )
            )
        ]
    )]
    public function createOrUpdate(SettingsRequest $request): JsonResponse
    {
        try {
            $settings = $this->settingsService->createOrUpdate($request);

            return response()->json([
                'message' => $settings['message'],
            ], $settings['code']);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . '->' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while creating or updating settings',
            ], 500);
        }

    }
}
