<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register new user
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $password = Hash::make($request->input('password'));

        $user = User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password,
        ]);

        event(new Registered($user));

        return Response::json($user->toArray());
    }

    /**
     * User auth
     *
     * @param AuthRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function auth(AuthRequest $request): JsonResponse
    {
        $candidate = User::query()
            ->where('email', $request->input('email'))
            ->first();

        if (
            $candidate === null || !Hash::check(
                $request->input('password'),
                (string)$candidate->getAttribute('password')
            )
        ) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return Response::json([
            'token' => $candidate->createToken($request->getClientIp())->plainTextToken
        ]);
    }
}
