<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Actions\ShowUserActionContract;
use App\Contracts\Actions\UserSearchActionContract;
use App\Http\Requests\UsersSearchRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Show user data.
     *
     * @param Request $request
     * @param ShowUserActionContract $action
     * @return JsonResponse
     */
    public function show(Request $request, ShowUserActionContract $action): JsonResponse
    {
        return Response::json($action->handle($request));
    }

    /**
     * Search users
     *
     * @param UsersSearchRequest $request
     * @param UserSearchActionContract $action
     * @return JsonResponse
     */
    public function search(UsersSearchRequest $request, UserSearchActionContract $action): JsonResponse
    {
        return Response::json($action->handle($request));
    }
}
