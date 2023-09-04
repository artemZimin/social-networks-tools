<?php

declare(strict_types=1);

namespace App\Contracts\Actions;

use App\Dto\VkAccessTokenDto;

interface SaveVkAccessTokenActionContract
{
    public function handle(VkAccessTokenDto $vkAccessTokenDto): array;
}
