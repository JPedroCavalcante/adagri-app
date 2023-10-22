<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithFaker;

    public function test_store_and_delete_user_in_application(): void
    {
        $response = $this->postJson('/api/auth/login',
            [
                'email' => 'jpc.almeida2@gmail.com',
                'password' => '12345678',
            ]);

        $token = $response->getContent();
        $password = $this->faker->password(8, 12);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->postJson('/api/users/',
            [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => $password,
                'password_confirmation' => $password,
                'type' => $this->faker->randomElement(['admin', 'applicant']),
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'id',
                'name',
                'type',
                'applicant_id',
                'created_at'
            ]);

        $id = $response->json('id');

        $deleteResponse = $this->withHeader('Authorization', 'Bearer ' . $token)->deleteJson("/api/users/" . $id);
        $deleteResponse->assertStatus(200);
    }

    public function test_update_user_in_application()
    {
        $user = User::factory()->create();
        $password = $this->faker->password(8, 12);
        $response = $this->postJson('/api/auth/login',
            [
                'email' => 'jpc.almeida2@gmail.com',
                'password' => '12345678',
            ]);

        $token = $response->getContent();

        $newResponse = $this->withHeader('Authorization', 'Bearer ' . $token)->putJson("/api/users/" . $user->id,
            [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => $password,
                'password_confirmation' => $password,
                'type' => $this->faker->randomElement(['admin', 'applicant']),
            ]);

        $newResponse->assertStatus(200);
        $newResponse->assertJsonStructure(
            [
                'id',
                'name',
                'type',
                'applicant_id',
                'created_at'
            ]);
    }

    public function test_index_users()
    {
        $response = $this->postJson('/api/auth/login',
            [
                'email' => 'jpc.almeida2@gmail.com',
                'password' => '12345678',
            ]);

        $token = $response->getContent();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson('/api/users/');

        $response->assertStatus(200);
    }
}
