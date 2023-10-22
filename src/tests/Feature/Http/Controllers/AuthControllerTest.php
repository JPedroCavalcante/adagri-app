<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use WithFaker;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_error_message_without_authentication(): void
    {
        $response = $this->getJson('/api/users');
        $response->assertStatus(401);
    }

    public function test_login_in_application(): void
    {
        $response = $this->postJson('/api/auth/login',
            [
                'email' => 'jpc.almeida2@gmail.com',
                'password' => '12345678',
            ]);

        $response->assertStatus(200);
    }

    public function test_show_user_in_application(): void
    {
        $response = $this->postJson('/api/auth/login',
            [
                'email' => 'jpc.almeida2@gmail.com',
                'password' => '12345678',
            ]);

        $token = $response->getContent();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson('/api/auth/user');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
                'type',
                'applicant_id',
                'created_at',
            ],
        ]);
    }

    public function test_logout_in_application(): void
    {
        $response = $this->postJson('/api/auth/login',
            [
                'email' => 'jpc.almeida2@gmail.com',
                'password' => '12345678',
            ]);

        $token = $response->getContent();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->postJson('/api/auth/logout');

        $response->assertStatus(200);
    }
}
