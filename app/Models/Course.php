<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'slug', 'description', 'category', 'difficulty', 'status' ];

    /**
     * Relasi untuk mengambil semua modul dalam kursus ini.
     */
    public function modules()
    {
        return $this->hasMany(Module::class)->orderBy('order_index');
    }

    /**
     * Relasi untuk mengambil semua pengguna yang terdaftar di kursus ini.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }

    /**
     * Relasi untuk mengambil semua pelajaran dalam kursus ini melalui modul.
     */
    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Module::class);
    }

    /**
     * Menghitung persentase progres untuk pengguna tertentu di kursus ini.
     */
    public function getProgressPercentageFor(User $user): int
    {
        $totalLessonsCount = $this->lessons()->count();

        if ($totalLessonsCount === 0) {
            return 0;
        }

        // Hitung berapa banyak pelajaran dari kursus ini yang sudah diselesaikan oleh pengguna.
        // PERBAIKAN DI SINI: Sebutkan nama tabel secara eksplisit -> 'lessons.id'
        $completedLessonsCount = $user->progress()
            ->whereIn('lesson_id', $this->lessons()->pluck('lessons.id'))
            ->count();

        return round(($completedLessonsCount / $totalLessonsCount) * 100);
    }
}
