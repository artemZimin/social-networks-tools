<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
     * @return JsonResponse
     */
    public function verify(EmailVerificationRequest $request): JsonResponse
    {
        $request->fulfill();

        return Response::json([
            'status' => 'ok',
        ]);
    }

    /**
     * Send verification URL
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function send(Request $request): JsonResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return Response::json([
            'message' => 'Verification link sent!',
        ]);
    }
}
