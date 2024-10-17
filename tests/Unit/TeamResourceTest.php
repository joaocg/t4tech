<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamResourceTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $headers;

    public function setUp(): void
    {
        parent::setUp();

        // Create a user for authentication
        $this->user = User::factory()->create();

        // Define headers for requests, including the custom X-Authorization
        $this->headers = [
            'X-Authorization' => config('app.X_AUTHORIZATION_KEY'),
        ];
    }

    /** @test */
    public function it_can_list_teams_with_authorized_user()
    {
        // Simulate the logged-in user
        $response = $this->actingAs($this->user)
                        ->getJson('/api/teams', $this->headers);

        $response->assertStatus(200); // Adjust according to your API response
    }

    /** @test */
    public function it_fails_to_list_teams_without_authorization()
    {
        // Simulate the request without the user and the header
        $response = $this->actingAs($this->user)
                        ->getJson('/api/teams');

        $response->assertStatus(401); // Unauthorized or whichever status your API returns
    }

    /** @test */
    public function it_can_create_a_team_with_authorized_user_and_custom_header()
    {
        $teamData = [
            'name' => 'New Team',
            'abbreviation' => 'NTM',
            'city' => 'Atlanta',
            'conference' => 'East',
            'division' => 'Southeast'
        ];

        // Simulate the logged-in user and send post request with the custom header
        $response = $this->actingAs($this->user)
                        ->postJson('/api/teams', $teamData, $this->headers);

        $response->assertStatus(201); // Assuming team creation is successful
    }
}