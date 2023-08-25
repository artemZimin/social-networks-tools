<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Auth
     */
    public function test_auth(): void
    {
        $response = $this->registerRequest([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $response->assertOk();

        $response = $this->authRequest([
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'token'
        ]);
    }

    /**
     * Wrong password
     */
    public function test_auth_wrong_password(): void
    {
        $response = $this->registerRequest([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $response->assertOk();

        $response = $this->authRequest([
            'email' => 'test@test.test',
            'password' => 'testtest1',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email'
            ]
        ]);
    }

    /**
     * Wrong email
     */
    public function test_auth_wrong_email(): void
    {
        $response = $this->registerRequest([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $response->assertOk();

        $response = $this->authRequest([
            'email' => 'test1@test.test',
            'password' => 'testtest',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email'
            ]
        ]);
    }

    /**
     * Wrong email and password
     */
    public function test_auth_wrong_email_and_password(): void
    {
        $response = $this->registerRequest([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $response->assertOk();

        $response = $this->authRequest([
            'email' => 'test1@test.test',
            'password' => 'testtest1',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email'
            ]
        ]);
    }

    /**
     * email field empty
     */
    public function test_auth_empty_email(): void
    {
        $response = $this->authRequest([
            'password' => 'testtest1',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email'
            ]
        ]);
    }

    /**
     * password field empty
     */
    public function test_auth_empty_password(): void
    {
        $response = $this->authRequest([
            'email' => 'test@test.test',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'password'
            ]
        ]);
    }

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
}
