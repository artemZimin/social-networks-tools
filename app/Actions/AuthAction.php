<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\Actions\AuthActionContract;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthAction implements AuthActionContract
{
    /**
     * @param AuthRequest $request
     * @return array
     * @throws ValidationException
     */
    public function handle(AuthRequest $request): array
    {
        $candidate = User::query()
            ->where('email', $request->input('email'))
            ->first();

        if (
            $candidate === null || !Hash::check(
                $request->input('password'),
                (string)$candidate->getAttribute('password')
            )
        ) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $role = (string)$candidate->getAttribute('role');

        $makeTokenAbilities = new MakeTokenAbilitiesAction();

        $abilities = $makeTokenAbilities->handle($role);

        return [
            'token' => $candidate->createToken($request->getClientIp(), $abilities)->plainTextToken,
        ];
    }
}
