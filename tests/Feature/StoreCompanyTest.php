<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Company;

class StoreCompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store_company(): void
    {
        $company = [
            'name' => 'Empresa de Teste',
            'description' => 'This is a description',
            'logo' => null
        ];

        $response = $this->post('/api/add-company', $company);

        $response->assertStatus(200);
    }
}
