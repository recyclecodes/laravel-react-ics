<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_login_with_correct_credentials()
    {
        // Create a user
        $password = 'password';
        $passwordHash = Hash::make($password);
        $user = User::factory()->create(['password' => $passwordHash]);

        // Make POST request to login endpoint
        $response = $this->postJson('/api/login', ['email' => $user->email, 'password' => $password]);

        // Assert response status is 200
        $response->assertStatus(200);

        // Assert response structure and data
        $response->assertJson(
            function (AssertableJson $json) use ($user) {
                $json->where('message', 'User login successful.')
                    ->where('data.name.id', $user->id)
                    ->where('data.name.email', $user->email)
                    ->etc(); 
            }
        );
    }

}
