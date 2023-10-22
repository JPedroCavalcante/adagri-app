<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobControllerTest extends TestCase
{
    use WithFaker;

    public function test_store_and_delete_job_in_application(): void
    {
        $response = $this->postJson('/api/auth/login',
            [
                'email' => 'jpc.almeida2@gmail.com',
                'password' => '12345678',
            ]);

        $token = $response->getContent();
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->postJson('/api/jobs/',
            [
                'name' => $this->faker->name,
                'salary' => $this->faker->numberBetween(0, 10000),
                'active' => $this->faker->randomElement([true, false]),
                'type' => $this->faker->randomElement(['clt', 'legal_person', 'freelancer']),
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'id',
                'name',
                'type',
                'active',
                'salary',
                'created_at'
            ]);

        $id = $response->json('id');

        $deleteResponse = $this->withHeader('Authorization', 'Bearer ' . $token)->deleteJson("/api/jobs/" . $id);
        $deleteResponse->assertStatus(200);
    }

    public function test_update_job_in_application()
    {
        $user = Job::factory()->create();
        $response = $this->postJson('/api/auth/login',
            [
                'email' => 'jpc.almeida2@gmail.com',
                'password' => '12345678',
            ]);

        $token = $response->getContent();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->putJson('/api/jobs/' . $user->id,
            [
                'name' => $this->faker->name,
                'salary' => $this->faker->numberBetween(0, 10000),
                'active' => $this->faker->randomElement([true, false]),
                'type' => $this->faker->randomElement(['clt', 'legal_person', 'freelancer']),
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'id',
                'name',
                'type',
                'active',
                'salary',
                'created_at'
            ]);
    }

    public function test_index_jobs()
    {
        $response = $this->postJson('/api/auth/login',
            [
                'email' => 'jpc.almeida2@gmail.com',
                'password' => '12345678',
            ]);

        $token = $response->getContent();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson('/api/jobs/');

        $response->assertStatus(200);
    }

    public function test_attach_job_to_applicant()
    {
        $password = $this->faker->password(8, 12);
        $user = User::factory()->create([
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password,
            'type' => 'applicant',
        ]);

        $job = Job::factory()->create();

        $response = $this->postJson('/api/auth/login',
            [
                'email' => $user->email,
                'password' => $password,
            ]);

        $token = $response->getContent();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->postJson('/api/jobs/' . $job->id . '/attachApplicant');

        $response->assertStatus(200);
    }
}
