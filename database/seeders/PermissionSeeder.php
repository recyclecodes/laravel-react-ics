<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-company',
            'edit-company',
            'view-company',
            'archive-company',
            'create-user',
            'edit-user',
            'view-user',
            'archive-user',
            'create-item',
            'edit-item',
            'view-item',
            'archive-item',
            'create-transaction',
            'view-transaction',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name'=> $permission]);
        }
    }
}
