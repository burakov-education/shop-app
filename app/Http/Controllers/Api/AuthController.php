<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\RegistrationRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Registration
     *
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function registration(RegistrationRequest $request): JsonResponse
    {
        User::query()->create($request->validated());

        return response()->json([
            'success' => true,
        ], 201);
    }

    /**
     * Auth
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function auth(AuthRequest $request): JsonResponse
    {
        if (auth()->attempt($request->validated())) {
            /** @var User|Authenticatable $user */
            $user = auth()->user();

            return response()->json([
                'token' => $user->createToken('api')->plainTextToken,
            ]);
        }

        return response()->json([
            'message' => 'Invalid data',
            'errors' => [
                'email' => ['Invalid data'],
            ],
        ], 422);
    }
}
