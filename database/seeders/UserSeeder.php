<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@pawtopia.com'],
            [
                'name' => 'Admin Pawtopia',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create regular user
        User::firstOrCreate(
            ['email' => 'user@pawtopia.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}
