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
        Permission::create(['name' => 'create-quiz']);
        Permission::create(['name' => 'edit-quiz']);
        Permission::create(['name' => 'delete-quiz']);
        Permission::create(['name' => 'create-material']);
        Permission::create(['name' => 'edit-material']);
        Permission::create(['name' => 'delete-material']);
        Permission::create(['name' => 'all-student']);
        Permission::create(['name' => 'view-fee-transaction-admin']);
        Permission::create(['name' => 'view-fee-transaction-teacher']);
        Permission::create(['name' => 'create-live-class']);

        $adminRole = Role::create(['name' => 'Admin']);
        $teacherRole = Role::create(['name' => 'Teacher']);
        $adminRole->givePermissionTo([
            'create-teacher',
            'edit-teacher',
            'delete-teacher',
            'create-course',
            'edit-course',
            'delete-course',
            'create-quiz',
            'edit-quiz',
            'delete-quiz',
            'create-material',
            'edit-material',
            'delete-material',
            'view-fee-transaction-admin',
            'all-student'
        ]);
        $teacherRole->givePermissionTo([
            'create-course',
            'edit-course',
            'delete-course',
            'create-material',
            'edit-material',
            'delete-material',
            'view-fee-transaction-teacher'
        ]);
    }
}
