<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\Traits\HasAuth;
use Tests\TestCase;

class ShowUserTest extends TestCase
{
    use DatabaseMigrations;
    use HasAuth;

    /**
     * user show with authorize
     */
    public function test_user_show_with_authorize(): void
    {
        $response = $this->registerRequest([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $response = $this->authRequest([
            'email' => 'test@test.test',
            'password' => 'testtest',
        ]);

        $token = json_decode($response->getContent())->token;

        $response = $this->get('/api/v1/user', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'email_verified_at',
            'created_at',
            'updated_at',
        ]);
    }

    /**
     * user show without authorize
     */
    public function test_user_show_without_authorize(): void
    {

        $response = $this->get('/api/v1/user', [
            'Accept' => 'application/json'
        ]);

        $response->assertUnauthorized();
    }
}
