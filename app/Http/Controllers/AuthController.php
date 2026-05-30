<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{

#[OA\Post(
    path: "/api/v1/login",
    summary: "Login User",
    tags: ["Authentication"]
)]
#[OA\RequestBody(
    required: true,
    content: new OA\JsonContent(
        required: ["email", "password"],
        properties: [
            new OA\Property(
                property: "email",
                type: "string",
                example: "admin@gmail.com"
            ),
            new OA\Property(
                property: "password",
                type: "string",
                example: "password123"
            )
        ]
    )
)]
#[OA\Response(
    response: 200,
    description: "Login Success"
)]
    public function login(Request $request)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);

        try {

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

        } catch (JWTException $e) {

            return response()->json([
                'message' => 'Could not create token'
            ], 500);

        }

        return response()->json([
            'token' => $token,
            'user' => auth()->user()
        ]);
    }

#[OA\Get(
    path: "/api/v1/profile",
    summary: "Get Current User Profile",
    tags: ["Authentication"]
)]
#[OA\Response(
    response: 200,
    description: "User Profile"
)]

    public function profile()
    {
        return response()->json(
            auth()->user()
        );
    }

#[OA\Post(
    path: "/api/v1/logout",
    summary: "Logout User",
    tags: ["Authentication"]
)]
#[OA\Response(
    response: 200,
    description: "Logout Success"
)]
    public function logout()
    {
        JWTAuth::invalidate(
            JWTAuth::getToken()
        );

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}