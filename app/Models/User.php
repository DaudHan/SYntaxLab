<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'headline',
        'bio',
        'xp_points',
    ];

    /**
     * Atribut yang harus disembunyikan.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi untuk kursus yang diikuti pengguna.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')->withTimestamps();
    }
    
    /**
     * Relasi untuk progres belajar pengguna.
     * INI ADALAH PERBAIKANNYA.
     * Ini menghubungkan User dengan Lesson melalui tabel user_progress.
     */
    public function progress()
    {
        return $this->belongsToMany(Lesson::class, 'user_progress')
                    ->withPivot('status', 'completed_at')
                    ->withTimestamps();
    }
}
