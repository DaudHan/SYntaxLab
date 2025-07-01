<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder lain secara berurutan.
        // Penting untuk memanggil UserSeeder terlebih dahulu.
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}