<?php

declare(strict_types=1);

namespace App\Contracts\Actions;

use App\Http\Requests\RegisterRequest;

interface UserRegisterActionContract
{
    /**
     * @param RegisterRequest $request
     * @return array
     */
    public function handle(RegisterRequest $request): array;
}
