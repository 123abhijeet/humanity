<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create-teacher']);
        Permission::create(['name' => 'edit-teacher']);
        Permission::create(['name' => 'delete-teacher']);
        Permission::create(['name' => 'create-course']);
        Permission::create(['name' => 'edit-course']);
        Permission::create(['name' => 'delete-course']);

        $adminRole = Role::create(['name' => 'Admin']);
        $teacherRole = Role::create(['name' => 'Teacher']);
        $adminRole->givePermissionTo([
            'create-teacher',
            'edit-teacher',
            'delete-teacher',
        ]);
        $teacherRole->givePermissionTo([
            'create-course',
            'edit-course',
            'delete-course',
        ]);
    }
}
