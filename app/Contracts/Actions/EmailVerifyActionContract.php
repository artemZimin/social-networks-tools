<?php

declare(strict_types=1);

namespace App\Contracts\Actions;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

interface EmailVerifyActionContract
{
    /**
     * @param EmailVerificationRequest $request
     * @return string[]
     */
    public function handle(EmailVerificationRequest $request): array;
}
