<?php

namespace App\Policies;

use App\Enums\TokenAbilities;
use App\Enums\UserRoles;
use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function search(User $user): bool
    {
        return $user->tokenCan(TokenAbilities::USERS_SEARCH->value);
    }

    public function before(User $user)
    {
        return $user->getAttribute('role') === UserRoles::ADMIN->value;
    }
}
