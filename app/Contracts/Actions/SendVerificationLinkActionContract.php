<?php

declare(strict_types=1);

namespace App\Contracts\Actions;

use Illuminate\Http\Request;

interface SendVerificationLinkActionContract
{
    /**
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array;
}
