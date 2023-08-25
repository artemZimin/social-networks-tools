<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Register
     */
    public function test_register(): void
    {
        $response = $this->registerRequest([
            'password' => '123456',
            'email' => 'test@test.test',
            'name' => 'test',
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'name',
            'email',
            'updated_at',
            'created_at',
            'id',
        ]);
    }

    /**
     * Name field empty
     */
    public function test_name_field_empty()
    {
        $response = $this->registerRequest([
            'password' => '123456',
            'email' => 'test1@test.test',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'name',
            ]
        ]);
    }

    /**
     * name field 1 char
     */
    public function test_name_field_1_char()
    {
        $response = $this->registerRequest([
            'password' => '123456',
            'email' => 'test1@test.test',
            'name' => 'a'
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'name',
            ]
        ]);
    }

    /**
     * name field 51 char
     */
    public function test_name_field_51_char()
    {
        $response = $this->registerRequest([
            'password' => '123456',
            'email' => 'test1@test.test',
            'name' => Str::random(51),
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'name',
            ]
        ]);
    }

    /**
     * email field used
     */
    public function test_email_used()
    {
        $data = [
            'password' => '123456',
            'email' => 'test@test.test',
            'name' => 'test',
        ];

        $this->registerRequest($data);

        $response = $this->registerRequest($data);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
            ]
        ]);
    }

    /**
     * email field empty
     */
    public function test_email_empty()
    {
        $response = $this->registerRequest([
            'password' => '123456',
            'name' => 'test',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
            ]
        ]);
    }

    /**
     * email field not valid format
     */
    public function test_email_not_valid_format()
    {
        $response = $this->registerRequest([
            'password' => '123456',
            'email' => 'wadwawsdsad',
            'name' => 'test',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
            ]
        ]);
    }

    /**
     * email field 71 char
     */
    public function test_email_71_char()
    {
        $response = $this->registerRequest([
            'password' => '123456',
            'email' => Str::random(71),
            'name' => 'test',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
            ]
        ]);
    }

    /**
     * password field empty
     */
    public function test_password_empty()
    {
        $response = $this->registerRequest([
            'email' => 'test@test.test',
            'name' => 'test',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'password',
            ]
        ]);
    }

    /**
     * password field empty
     */
    public function test_password_5_char()
    {
        $response = $this->registerRequest([
            'email' => 'test@test.test',
            'password' => Str::random(5),
            'name' => 'test',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'password',
            ]
        ]);
    }

    /**
     * password field 101 char
     */
    public function test_password_101_char()
    {
        $response = $this->registerRequest([
            'email' => 'test@test.test',
            'password' => Str::random(101),
            'name' => 'test',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'password',
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
}
