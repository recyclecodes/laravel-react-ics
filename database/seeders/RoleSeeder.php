<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'Super Admin', 'guard_name' => 'api']);
        $admin = Role::create(['name' => 'Admin', 'guard_name' => 'api']);
        $user = Role::create(['name' => 'User', 'guard_name' => 'api']);

        //assigning permissions to super admin

        $superAdmin->givePermissionTo([
            'create-company',
            'edit-company',
            'view-company',
            'archive-company',
            'create-user',
            'edit-user',
            'view-user',
            'archive-user',
        ]);

        //assigning permission to admin

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'view-user',
            'archive-user',
            'view-transaction',
        ]);

        //assigning permission to user

        $user->givePermissionTo([
            'create-item',
            'edit-item',
            'view-item',
            'archive-item',
            'create-transaction',
            'view-transaction',
        ]);
    }
}
