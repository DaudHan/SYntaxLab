<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'user@edusphere.com')->first();

        if ($user) {
            DB::table('notifications')->insert([
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'App\Notifications\WelcomeNotification', // Tipe notifikasi (bisa disesuaikan)
                    'notifiable_type' => 'App\Models\User',
                    'notifiable_id' => $user->id,
                    'data' => json_encode(['message' => 'Selamat datang di SyntaxLab! Mari mulai perjalanan belajarmu.']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'App\Notifications\NewCourseNotification',
                    'notifiable_type' => 'App\Models\User',
                    'notifiable_id' => $user->id,
                    'data' => json_encode(['message' => 'Kursus baru "Advanced CSS Animations" telah tersedia!']),
                    'created_at' => now()->subDay(),
                    'updated_at' => now()->subDay(),
                ],
            ]);
        }
    }
}