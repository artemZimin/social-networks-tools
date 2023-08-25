<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\Actions\EmailVerifyActionContract;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerifyAction implements EmailVerifyActionContract
{
    /**
     * @param EmailVerificationRequest $request
     * @return string[]
     */
    public function handle(EmailVerificationRequest $request): array
    {
        $request->fulfill();

        return [
            'status' => 'ok',
        ];
    }
}
