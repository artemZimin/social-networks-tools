<?php

declare(strict_types=1);

namespace App\Services\VK;

use App\Contracts\Services\VkAuthServiceContract;
use App\Dto\VkAccessTokenDto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VkAuthService implements VkAuthServiceContract
{
    /**
     * @param Request $request
     * @return string
     */
    public function authUrl(Request $request): string
    {
        session()->push('userId', $request->user()->id);

        return 'https://oauth.vk.com/authorize?client_id='
            . env('VK_CLIENT_ID')
            . '&redirect_uri='
            . route('vk.code')
            . '&display=page';
    }

    /**
     * @param Request $request
     * @return VkAccessTokenDto
     */
    public function authorize(Request $request): VkAccessTokenDto
    {
        $code = $request->query('code');

        $response = Http::get(
            'https://oauth.vk.com/access_token',
            [
                'client_id' => env('VK_CLIENT_ID'),
                'client_secret' => env('VK_CLIENT_SECRET'),
                'redirect_uri' => route('vk.code'),
                'code' => $code,
            ]
        );

        return VkAccessTokenDto::fromArray($response->json());
    }
}
