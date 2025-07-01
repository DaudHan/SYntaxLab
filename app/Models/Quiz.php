<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
    ];

    /**
     * Relasi ke pelajaran induk.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Relasi ke semua pertanyaan dalam kuis ini.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}