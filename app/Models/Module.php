<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'order_index',
    ];

    /**
     * Relasi ke kursus induk.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relasi ke semua pelajaran dalam modul ini.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order_index');
    }
}
