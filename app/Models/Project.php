<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Project extends Model
    {
        use HasFactory;

        protected $fillable = [
            'lesson_id',
            'description',
            'repository_url',
        ];

        /**
         * Relasi ke pelajaran induknya.
         */
        public function lesson()
        {
            return $this->belongsTo(Lesson::class);
        }
    }
    