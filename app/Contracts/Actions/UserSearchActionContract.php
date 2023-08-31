<?php

declare(strict_types=1);

namespace App\Contracts\Actions;

use App\Http\Requests\UsersSearchRequest;

interface UserSearchActionContract
{
    /**
     * @param UsersSearchRequest $request
     * @return array
     */
    public function handle(UsersSearchRequest $request): array;
}
