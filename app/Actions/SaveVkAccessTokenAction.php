<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\Actions\SaveVkAccessTokenActionContract;
use App\Dto\VkAccessTokenDto;
use App\Models\User;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SaveVkAccessTokenAction implements SaveVkAccessTokenActionContract
{
    /**
     * @param VkAccessTokenDto $vkAccessTokenDto
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(VkAccessTokenDto $vkAccessTokenDto): array
    {
        try {
            $user = User::query()->find((int)session()->get('userId'));
            $user->vkAccessToken()->delete();
            $user->vkAccessToken()->updateOrCreate($vkAccessTokenDto->toArray());

            return $user->toArray();
        } catch (Exception $e) {
            throw new DomainException('Something went wrong');
        }
    }
}
