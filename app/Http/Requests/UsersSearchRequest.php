<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\TokenAbilities;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UsersSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        if ($user instanceof User) {
            return $user->tokenCan(TokenAbilities::USERS_SEARCH->value);
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['max:50']
        ];
    }
}
