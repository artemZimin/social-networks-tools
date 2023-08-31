<?php

namespace App\Actions;

use App\Enums\TokenAbilities;
use App\Enums\UserRoles;

class MakeTokenAbilitiesAction
{
    public function handle(string $role): array
    {
        return match ($role) {
            UserRoles::ADMIN->value => TokenAbilities::cases(),
            default => []
        };
    }
}
