<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'repository_url',
        'demo_url',
        'status',
        'feedback',
    ];

    /**
     * Relasi untuk mengambil data pengguna yang mengirimkan proyek.
     * INI ADALAH PERBAIKANNYA.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi untuk mengambil data pelajaran dari kiriman ini.
     * INI JUGA PERBAIKAN PENTING.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
