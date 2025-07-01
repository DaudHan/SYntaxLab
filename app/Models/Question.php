<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question_text',
    ];

    /**
     * Relasi ke kuis induk.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Relasi ke semua pilihan jawaban.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}