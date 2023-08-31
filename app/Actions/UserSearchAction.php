<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\Actions\UserSearchActionContract;
use App\Http\Requests\UsersSearchRequest;
use App\Models\User;

class UserSearchAction implements UserSearchActionContract
{
    /**
     * @param UsersSearchRequest $request
     * @return array
     */
    public function handle(UsersSearchRequest $request): array
    {
        $result = User::search($request->input('search'))->get();

        return $result->toArray();
    }
}
