<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Actions\AuthActionContract;
use App\Contracts\Actions\UserRegisterActionContract;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register new user
     *
     * @param RegisterRequest $request
     * @param UserRegisterActionContract $action
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, UserRegisterActionContract $action): JsonResponse
    {
        $user = $action->handle($request);

        return Response::json($user);
    }

    /**
     * Auth user
     *
     * @param AuthRequest $request
     * @param AuthActionContract $action
     * @return JsonResponse
     * @throws ValidationException
     */
    public function auth(AuthRequest $request, AuthActionContract $action): JsonResponse
    {
        $response = $action->handle($request);

        return Response::json($response);
    }
}
