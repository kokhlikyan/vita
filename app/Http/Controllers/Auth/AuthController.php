<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailAuthRequest;
use App\Http\Requests\EmailVerifyRequest;
use App\Http\Requests\UpdateUserInfoRequest;
use App\Http\Resources\UserResource;
use App\Schemas\UserSchema;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Random\RandomException;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {

    }


    #[OA\Post(
        path: "/api/v1/auth/email/send",
        summary: "Send verification code to email",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email'],
                properties: [
                    new OA\Property(
                        property: 'email',
                        type: 'string',
                        format: 'email',
                        example: 'user@example.com'
                    ),
                ]
            )
        ),
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Verification code sent successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Verification code sent successfully'
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Failed to send verification code",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Failed to send verification code'
                        ),
                    ]
                )
            ),
        ]
    )]
    public function sendCode(EmailAuthRequest $request): JsonResponse
    {
        $verification = $this->authService->sendCode($request->get('email'));
        if ($verification) {
            return response()->json(['message' => 'Verification code sent successfully']);
        }
        return response()->json(['message' => 'Failed to send verification code'], 400);
    }


    #[OA\Post(
        path: "/api/v1/auth/email/verify",
        summary: "Verify email with code",
           requestBody: new OA\RequestBody(
                required: true,
                content: new OA\JsonContent(
                    required: ['email', 'code'],
                    properties: [
                        new OA\Property(
                            property: 'email',
                            type: 'string',
                            format: 'email',
                            example: 'test@mail.ru'
                        ),
                        new OA\Property(
                            property: 'code',
                            type: 'string',
                            example: '123456'
                        ),
                    ]
                )
            ),
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Verification code is correct",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'is_verified',
                            type: 'boolean',
                            example: true
                        ),
                        new OA\Property(
                            property: 'token',
                            type: 'string',
                            example: 'token'
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Verification code is incorrect",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Verification code is incorrect'
                        ),
                    ]
                )
            ),
        ]
    )]
    public function verifyCode(EmailVerifyRequest $request): JsonResponse
    {
        $user = $this->authService->verifyCode($request->get('email'), $request->get('code'));
        if ($user) {
            $token = $user->createToken($user->email)->plainTextToken;

            return response()->json([
                'is_verified' => $user->first_name && $user->last_name,
                'token' => $token,
            ], 200, ['Access-Token' => $token]);
        }
        return response()->json(['message' => 'Verification code is incorrect'], 400);
    }



    #[OA\Put(
        path: "/api/v1/auth/update",
        summary: "Update user information",
        security: [
            ['Bearer' => []]
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['first_name', 'last_name'],
                properties: [
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
                        property: 'phone',
                        type: 'string',
                        example: '+374 77 777777'
                    ),
                    new OA\Property(
                        property: 'date_of_birth',
                        type: 'string',
                        example: '1990-01-01'
                    )
                ]
            )
        ),
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "User information updated successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: UserSchema::class
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Failed to update user information",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Failed to update user information'
                        ),
                    ]
                )
            ),
        ]
    )]
    public function updateInfo(UpdateUserInfoRequest $request): JsonResponse
    {
        try {
            $user = auth()->user();
            $user->update($request->validated());
            $user->save();
            $user->refresh();
            return response()->json(['data' => new UserResource($user)]);
        }catch (\Exception $exception) {
            Log::error(__METHOD__ . '->' . $exception->getMessage());
            return response()->json(['message' => 'Failed to update user information'], 400);
        }
    }


    #[OA\Get(
        path: "/api/v1/auth/user",
        summary: "Get user information",
        security: [
            ['Bearer' => []]
        ],
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "User information",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            ref: UserSchema::class
                        ),
                    ]
                )
            ),
        ]
    )]
    public function getUser(): JsonResponse
    {
        return response()->json(new UserResource(auth()->user()));
    }


    #[OA\Post(
        path: "/api/v1/auth/logout",
        summary: "Logout user",
        security: [
            ['Bearer' => []]
        ],
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Logged out successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Logged out successfully'
                        ),
                    ]
                )
            ),
        ]
    )]
    public function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

}
