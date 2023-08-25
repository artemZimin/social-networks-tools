<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\Actions\SendVerificationLinkActionContract;
use Illuminate\Http\Request;

class SendVerificationLinkAction implements SendVerificationLinkActionContract
{
    /**
     * @param Request $request
     * @return string[]
     */
    public function handle(Request $request): array
    {
        $request->user()->sendEmailVerificationNotification();

        return [
            'message' => 'Verification link sent!',
        ];
    }
}
