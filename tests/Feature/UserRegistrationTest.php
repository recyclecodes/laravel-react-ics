<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_registration(): void
    {
        // Prepare request data
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'Q!a123456&^@#@',
            'password_confirmation' => 'Q!a123456&^@#@'
        ];

        // Make POST request to register endpoint
        $response = $this->post('/api/register', $data);

        // Assert response status is 200
        $response->assertStatus(200);

        // Assert response structure
        $response->assertJsonStructure([
            'data' => [
                'token',
                'name'
            ],
            'message'
        ]);

        // Assert user exists in the database
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);

        // Assert user has 'User' role
        $user = User::where('email', 'john@example.com')->first();
        $this->assertTrue($user->hasRole('User'));
    }

}
