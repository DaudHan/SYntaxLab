<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data kursus, modul, dan pelajaran dalam satu array
        $coursesData = [
            [
                'title' => 'React: Dari Dasar Hingga Mahir',
                'category' => 'Frontend',
                'difficulty' => 'PEMULA',
                'description' => 'Pelajari library frontend paling populer di dunia untuk membangun antarmuka web yang cepat, dinamis, dan modern.',
                'modules' => [
                    [
                        'title' => 'Pengenalan React',
                        'lessons' => [
                            ['title' => 'Apa itu React?', 'content_type' => 'TEXT', 'content' => 'React adalah library JavaScript untuk membangun antarmuka pengguna...'],
                            ['title' => 'Memahami JSX', 'content_type' => 'TEXT', 'content' => 'JSX adalah ekstensi sintaks untuk JavaScript...'],
                            // PELAJARAN BARU DENGAN TIPE KUIS
                            ['title' => 'Kuis: Fondasi React', 'content_type' => 'QUIZ', 'content' => null], 
                        ],
                    ],
                    [
                        'title' => 'Komponen dan Props',
                        'lessons' => [
                            ['title' => 'Membuat Komponen Fungsional', 'content_type' => 'TEXT', 'content' => 'Komponen fungsional adalah cara modern untuk menulis komponen di React...'],
                        ],
                    ],
                ],
            ],
            // ... (data kursus lain) ...
        ];

        foreach ($coursesData as $courseData) {
            $course = Course::create([
                'title' => $courseData['title'],
                'slug' => Str::slug($courseData['title']),
                'category' => $courseData['category'],
                'difficulty' => $courseData['difficulty'],
                'description' => $courseData['description'],
                'status' => 'DIPUBLIKASIKAN',
            ]);

            foreach ($courseData['modules'] as $moduleIndex => $moduleData) {
                $module = $course->modules()->create([
                    'title' => $moduleData['title'],
                    'order_index' => $moduleIndex + 1,
                ]);

                foreach ($moduleData['lessons'] as $lessonIndex => $lessonData) {
                    $lesson = $module->lessons()->create([
                        'title' => $lessonData['title'],
                        'content' => $lessonData['content'],
                        'content_type' => $lessonData['content_type'],
                        'order_index' => $lessonIndex + 1,
                    ]);

                    // JIKA PELAJARAN ADALAH KUIS, BUAT DATA KUIS
                    if ($lesson->content_type === 'QUIZ') {
                        $quiz = $lesson->quiz()->create(['title' => 'Uji Pemahaman: ' . $module->title]);
                        
                        $question1 = $quiz->questions()->create(['question_text' => 'Apa kepanjangan dari JSX?']);
                        $question1->answers()->createMany([
                            ['answer_text' => 'JavaScript XML', 'is_correct' => true],
                            ['answer_text' => 'JavaScript X-Markup', 'is_correct' => false],
                            ['answer_text' => 'Java Syntax Extension', 'is_correct' => false],
                        ]);

                        $question2 = $quiz->questions()->create(['question_text' => 'Manakah cara yang benar untuk menerapkan class CSS di JSX?']);
                        $question2->answers()->createMany([
                            ['answer_text' => 'class="container"', 'is_correct' => false],
                            ['answer_text' => 'className="container"', 'is_correct' => true],
                            ['answer_text' => 'css_class="container"', 'is_correct' => false],
                        ]);
                    }
                }
            }
            $user = User::where('email', 'user@syntaxlab.com')->first();
            if ($user) {
                $user->courses()->attach($course->id);
            }
        }
    }
}
