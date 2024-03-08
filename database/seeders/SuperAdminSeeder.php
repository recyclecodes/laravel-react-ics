<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
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
            'password' => Hash::make('$uperAdmin123456')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Admin User', 
            'email' => 'admin@test.com',
            'password' => Hash::make('@dminUser123456')
        ]);
        $admin->assignRole('Admin');

        // Creating User
        $user = User::create([
            'name' => 'User One', 
            'email' => 'user@test.com',
            'password' => Hash::make('U$er123456')
        ]);
        $user->assignRole('User');
    }
}
