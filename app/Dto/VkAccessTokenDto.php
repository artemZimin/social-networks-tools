<?php

declare(strict_types=1);

namespace App\Dto;

use http\Exception\InvalidArgumentException;
use Illuminate\Contracts\Support\Arrayable;

class VkAccessTokenDto implements Arrayable
{
    /**
     * @param string $accessToken
     * @param int $expiresIn
     * @param int $userId
     */
    public function __construct(
        private readonly string $accessToken,
        private readonly int    $expiresIn,
        private readonly int    $userId
    ) {
    }

    /**
     * @param array $accessToken
     * @return self
     */
    public static function fromArray(array $accessToken): self
    {
        if (
            empty($accessToken['access_token']) ||
            empty($accessToken['expires_in']) ||
            empty($accessToken['user_id'])
        ) {
            throw new InvalidArgumentException('Wrong VK access token.');
        }

        return new self(
            (string)$accessToken['access_token'],
            (int)$accessToken['expires_in'],
            (int)$accessToken['user_id']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'access_token' => $this->getAccessToken(),
            'expires_in' => $this->getExpiresIn(),
            'user_id' => $this->getUserId(),
        ];
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
