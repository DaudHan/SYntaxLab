<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat pengguna biasa untuk testing
        User::firstOrCreate(
            ['email' => 'user@edusphere.com'],
            [
                'name' => 'User Biasa',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Membuat pengguna Admin
        User::firstOrCreate(
            ['email' => 'admin@edusphere.com'],
            [
                'name' => 'Admin EduSphere',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'ADMIN',
            ]
        );
    }
}
