<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\Actions\UserRegisterActionContract;
use App\Http\Requests\RegisterRequest;
use App\Jobs\ProcessUserRegistered;
use App\Models\User;
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

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password,
        ];

        if (!User::query()->count()) {
            $data['role'] = 'admin';
        }

        $user = User::query()->create($data);

        if ($user instanceof User) {
            ProcessUserRegistered::dispatch($user);
        }

        return $user->toArray();
    }
}
