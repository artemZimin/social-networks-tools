<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Dto\VkAccessTokenDto;
use Illuminate\Http\Request;

interface VkAuthServiceContract
{
    public function authUrl(Request $request): string;

    public function authorize(Request $request): VkAccessTokenDto;
}
