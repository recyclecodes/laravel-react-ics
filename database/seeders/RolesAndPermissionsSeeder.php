<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);

        // Create permissions
        // Permission::create(['name' => 'edit articles']);
        // Permission::create(['name' => 'publish articles']);
        // Permission::create(['name' => 'delete articles']);

        // // Assign permissions to roles
        // Role::findByName('Super Admin')->givePermissionTo(['edit articles', 'publish articles', 'delete articles']);
        // Role::findByName('Admin')->givePermissionTo(['edit articles', 'publish articles']);
        // Role::findByName('User')->givePermissionTo('edit articles');
    }
}
