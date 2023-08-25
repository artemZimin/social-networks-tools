<?php

declare(strict_types=1);

namespace App\Contracts\Actions;

use App\Http\Requests\AuthRequest;
use Illuminate\Validation\ValidationException;

interface AuthActionContract
{
    /**
     * @param AuthRequest $request
     * @return array
     * @throws ValidationException
     */
    public function handle(AuthRequest $request): array;
}
