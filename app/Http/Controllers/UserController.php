<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Actions\ShowUserActionContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Show user data.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request, ShowUserActionContract $action): JsonResponse
    {
        return Response::json($action->handle($request));
    }
}
