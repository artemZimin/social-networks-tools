<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\Actions\UserRegisterActionContract;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserRegisterAction implements UserRegisterActionContract
{
    /**
     * @param RegisterRequest $request
     * @return array
     */
    public function handle(RegisterRequest $request): array
    {
        $password = Hash::make($request->input('password'));

        $user = User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password,
        ]);

        event(new Registered($user));

        return $user->toArray();
    }
}
