<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'content_type',
        'content',
        'order_index',
    ];

    /**
     * Relasi ke modul induk.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Relasi ke kuis yang terkait pelajaran ini.
     */
    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function project()
        {
            return $this->hasOne(Project::class);
        }
}
