<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Actions\EmailVerifyActionContract;
use App\Contracts\Actions\SendVerificationLinkActionContract;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EmailVerificationController extends Controller
{
    /**
     * Email verification
     *
     * @param EmailVerificationRequest $request
     * @param EmailVerifyActionContract $action
     * @return JsonResponse
     */
    public function verify(EmailVerificationRequest $request, EmailVerifyActionContract $action): JsonResponse
    {
        $response = $action->handle($request);

        return Response::json($response);
    }

    /**
     * Send verification URL
     *
     * @param Request $request
     * @param SendVerificationLinkActionContract $action
     * @return JsonResponse
     */
    public function send(Request $request, SendVerificationLinkActionContract $action): JsonResponse
    {
        $response = $action->handle($request);

        return Response::json($response);
    }
}
