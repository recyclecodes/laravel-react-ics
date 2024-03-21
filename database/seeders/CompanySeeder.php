<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $companiesData = [
            ['name' => 'Company One', 'description' => 'Company One Description', 'logo' => NULL],
            ['name' => 'Company Two', 'description' => 'Company Two Description', 'logo' => NULL],
            ['name' => 'Company Three', 'description' => 'Company Three Description', 'logo' => NULL],
        ];

        foreach ($companiesData as $companyData) {
            Company::create($companyData);
        }
    }
}
