<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     RoleAndPermissionSeeder::class,
        // ]);
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Naveen Goenka',
            'email' => 'goenkanaveen09@gmail.com',
            'password' => Hash::make('11111111'),
            'status' => '1',
        ]);
        $user->assignRole('Admin');

        // $user = User::find(1);
        // $user = User::find(2);
        // $user->assignRole('Teacher');

    }
}
