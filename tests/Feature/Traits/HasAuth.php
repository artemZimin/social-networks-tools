<?php

declare(strict_types=1);

namespace Tests\Feature\Traits;

use Illuminate\Testing\TestResponse;

trait HasAuth
{
    /**
     * Send register request
     *
     * @param array $data
     * @return TestResponse
     */
    private function registerRequest(array $data): TestResponse
    {
        return $this->post(route('register'), $data, [
            'Accept' => 'application/json'
        ]);
    }

    /**
     * Send auth request
     *
     * @param array $data
     * @return TestResponse
     */
    private function authRequest(array $data): TestResponse
    {
        return $this->post(route('auth'), $data, [
            'Accept' => 'application/json'
        ]);
    }

    /**
     * Register, auth and get token
     *
     * @param array $data user data
     * @return string user token
     */
    private function registerAndAuth(array $data): string
    {
        $response = $this->registerRequest($data);

        $response = $this->authRequest([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return json_decode($response->getContent())->token;
    }
}
