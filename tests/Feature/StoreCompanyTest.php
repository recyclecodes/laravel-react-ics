<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreCompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store_company(): void
    {

        // Passport::actingAs(
        //    $user=User::where('role', 'Super Admin')->orderBy('id', 'desc')->first()
        //    $this->actingAs($user, 'api');
        // );

        $company = [
            'name' => 'Empresa de Teste',
            'description' => 'This is a description',
            'logo' => null
        ];

        $response = $this->post('/api/add-company', $company);

        $response->assertStatus(200);
    }
}
