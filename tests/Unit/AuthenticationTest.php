<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_register_a_user()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->postJson('/api/register', $data, [
            'X-Authorization' => config('app.X_AUTHORIZATION_KEY'),
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    /** @test */
    public function it_can_login_a_user()
    {
        // Create a user first
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password')
        ]);

        // Attempt to log in with correct credentials
        $response = $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'password'
        ], [
            'X-Authorization' => config('app.X_AUTHORIZATION_KEY'),
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token']);
    }

    /** @test */
    public function it_fails_to_login_with_invalid_credentials()
    {
        // Attempt to log in with invalid credentials
        $response = $this->postJson('/api/login', [
            'email' => 'wrong@example.com',
            'password' => 'invalidpassword'
        ], [
            'X-Authorization' => config('app.X_AUTHORIZATION_KEY'),
        ]);

        $response->assertStatus(401); // Unauthorized
    }
}