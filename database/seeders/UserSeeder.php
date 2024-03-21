<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'SA User',
            'email' => 'superadmin@test.com',
            'password' => Hash::make('$uperAdmin123456'),
            'company_id' => NULL,
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $adminsData = [
            ['name' => 'Admin One', 'email' => 'admin1@test.com', 'password' => Hash::make('U$er123456'), 'company_id' => 1],
            ['name' => 'Admin Two', 'email' => 'admin2@test.com', 'password' => Hash::make('U$er123456'), 'company_id' => 2],
            ['name' => 'Admin Three', 'email' => 'admin3@test.com', 'password' => Hash::make('U$er123456'), 'company_id' => 1],
        ];

        foreach ($adminsData as $adminData) {
            $admin = User::create($adminData);
            $admin->assignRole('Admin');
        }

        // Creating User
        $usersData = [
            ['name' => 'User One', 'email' => 'user1@test.com', 'password' => Hash::make('U$er123456'), 'company_id' => 2],
            ['name' => 'User Two', 'email' => 'user2@test.com', 'password' => Hash::make('U$er123456'), 'company_id' => 2],
            ['name' => 'User Three', 'email' => 'user3@test.com', 'password' => Hash::make('U$er123456'), 'company_id' => 1],
        ];

        foreach ($usersData as $userData) {
            $user = User::create($userData);
            $user->assignRole('User');
        }
    }
}
