<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\Feature\Traits\HasAuth;
use Tests\TestCase;

class UsersSearchTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use HasAuth;
    public const ENDPOINT = '/api/v1/users/search';

    /**
     * A basic feature test.
     */
    public function test_search_user_by_name(): void
    {
        $token = $this->registerAndAuth([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $response = $this->post(self::ENDPOINT, [
            'search' => 'test'
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
                'role',
            ]
        ]);
    }

    /**
     * A basic feature test.
     */
    public function test_search_user_by_name_51_char(): void
    {
        $token = $this->registerAndAuth([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $response = $this->post(self::ENDPOINT, [
            'search' => Str::random(51),
        ], [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ]);

        $response->assertUnprocessable();

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'search' => []
            ]
        ]);
    }

    /**
     * A basic feature test.
     */
    public function test_search_user_by_name_not_found(): void
    {
        $token = $this->registerAndAuth([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $response = $this->post(self::ENDPOINT, [
            'search' => 'aaaa',
        ], [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ]);

        $response->assertOk();

        $response->assertJson([]);
    }

    /**
     * Search when user not auth
     */
    public function test_search_when_user_not_auth(): void
    {
        $this->registerRequest([
            'name' => 'test',
            'email' => 'test1@test.test',
            'password' => 'testtest',
        ]);

        $token = $this->registerAndAuth([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $response = $this->post(self::ENDPOINT, [
            'search' => 'test'
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertForbidden();
    }
}
