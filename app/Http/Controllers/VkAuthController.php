<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Actions\SaveVkAccessTokenActionContract;
use App\Contracts\Services\VkAuthServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class VkAuthController extends Controller
{
    public function __construct(
        private readonly VkAuthServiceContract $vkAuthService
    ) {
    }
    public function index(Request $request)
    {
        return Response::redirectTo($this->vkAuthService->authUrl($request));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function code(Request $request, SaveVkAccessTokenActionContract $action)
    {
        $vkAccessTokenDto = $this->vkAuthService->authorize($request);

        return Response::json($action->handle($vkAccessTokenDto));
    }
}
