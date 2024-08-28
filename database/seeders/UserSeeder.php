<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Leader',
            'email' => 'leader@leader.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Driver',
            'email' => 'driver@driver.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'role_id' => 4,
        ]);
    }
}
