<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthWithTokenRequest;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use OpenApi\Attributes as OA;

class SocialiteController extends Controller
{

    #[OA\Get(
        path: "/api/v1/auth/{provider}",
        summary: "Auth with socialite",
        tags: ["Auth"],
        parameters: [
            new OA\Parameter(
                name: "provider",
                description: "The social provider (e.g., google, facebook, apple)",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "string")
            ),
        ],
        responses: [
            new OA\Response(
                response: 302,
                description: "Redirection to social provider for authentication"
            ),
            new OA\Response(
                response: 400,
                description: "Bad Request"
            ),
            new OA\Response(
                response: 422,
                description: "Validation Error",
            ),
        ]
    )]
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }


    #[OA\Get(
        path: "/api/v1/auth/{provider}/callback",
        summary: "Callback from socialite",
        tags: ["Auth"],
        parameters: [
            new OA\Parameter(
                name: "provider",
                description: "The social provider (e.g., google, facebook)",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "string")
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful authentication",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "status",
                            description: "Status of the request",
                            type: "boolean"
                        ),
                        new OA\Property(
                            property: "token",
                            description: "JWT token",
                            type: "string"
                        )
                    ],
                    type: "object"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Bad Request"
            ),
            new OA\Response(
                response: 401,
                description: "Unauthorized"
            ),
            new OA\Response(
                response: 422,
                description: "Validation Error",
            ),
        ]
    )]
    public function handleProviderCallback($provider): JsonResponse
    {
        $user = Socialite::driver($provider)->stateless()->user();
        return $this->createOrFind($user, $provider);
    }

    #[OA\Post(
        path: "/api/v1/auth/token",
        summary: "Authenticate with social provider",
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                required: [
                    'token',
                ],
                properties: [
                    new OA\Property(property: 'token', type: 'string'),
                ],
                type: 'object'
            )
        ),
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful authentication",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "status",
                            description: "Status of the request",
                            type: "boolean"
                        ),
                        new OA\Property(
                            property: "token",
                            description: "JWT token",
                            type: "string"
                        )
                    ],
                    type: "object"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Bad Request"
            ),
            new OA\Response(
                response: 401,
                description: "Unauthorized"
            ),
            new OA\Response(
                response: 422,
                description: "Validation Error",
            ),
        ]
    )]
    public function handleTokenAuth(AuthWithTokenRequest $request, $provider): JsonResponse
    {
        $user = Socialite::driver($provider)->stateless()->userFromToken($request->input('token'));
        return $this->createOrFind($user, $request->input('provider'));
    }


    private function createOrFind($user, $provider): JsonResponse
    {
        try {
            $userCreated = User::query()->firstOrCreate(
                [
                    'email' => $user->getEmail()
                ],
                [
                    'email_verified_at' => now(),
                    'name' => $user->getName(),
                    'status' => true,
                ]
            );

            $userCreated->providers()->updateOrCreate(
                [
                    'provider' => $provider,
                    'provider_id' => $user->getId(),
                ],
                [
                    'avatar' => $user->getAvatar()
                ]
            );
            $token = $userCreated->createToken($user->token ?? $user->getId())->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
            ], 200, ['Access-Token' => $token]);
        } catch (ClientException $exception) {
            Log::error(__METHOD__ . '->' . $exception->getMessage());
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }
    }


}
