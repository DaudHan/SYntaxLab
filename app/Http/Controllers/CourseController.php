<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CourseController extends Controller
{
    /**
     * Menampilkan daftar semua kursus yang tersedia.
     */
    public function index(Request $request): View
    {
        $query = Course::where('status', 'DIPUBLIKASIKAN');
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $courses = $query->with('modules.lessons')->latest()->paginate(9);
        $categories = Course::select('category')->distinct()->pluck('category');
        $difficulties = ['PEMULA', 'MENENGAH', 'MAHIR'];

        return view('courses.index', compact('courses', 'categories', 'difficulties'));
    }

    /**
     * Menampilkan daftar kursus yang diikuti oleh pengguna.
     */
    public function myCourses(Request $request): View
    {
        $user = Auth::user();
        $status = $request->query('status', 'all');
        $query = $user->courses()->with('modules.lessons');

        if ($status === 'in-progress') {
            $query->wherePivotNull('completed_at');
        } elseif ($status === 'completed') {
            $query->wherePivotNotNull('completed_at');
        }
        $courses = $query->get();

        return view('courses.my-courses', compact('courses', 'status'));
    }

    /**
     * Menampilkan halaman detail untuk satu kursus.
     */
    public function show(Course $course): View
    {
        $course->loadMissing('modules.lessons');
        $isEnrolled = Auth::user()->courses()->where('course_id', $course->id)->exists();
        return view('courses.show', compact('course', 'isEnrolled'));
    }

    /**
     * Mendaftarkan pengguna ke sebuah kursus.
     */
    public function enroll(Request $request, Course $course): RedirectResponse
    {
        Auth::user()->courses()->syncWithoutDetaching($course->id);
        $firstLesson = $course->modules()->orderBy('order_index')->first()?->lessons()->orderBy('order_index')->first();
        if ($firstLesson) {
            return redirect()->route('courses.lesson', ['course' => $course->slug, 'lesson' => $firstLesson->id]);
        }
        return redirect()->route('my-courses');
    }

    /**
     * Menampilkan satu halaman pelajaran spesifik. (LOGIKA BARU YANG DIPERBAIKI)
     */
    public function showLesson(Course $course, Lesson $lesson): View
    {
        // Muat kurikulum untuk sidebar
        $course->loadMissing('modules.lessons');

        // ====================================================================
        // === INI ADALAH PERBAIKANNYA: Muat ulang pelajaran dengan relasi ===
        // ====================================================================
        // Kita memuat ulang instance pelajaran ini secara eksplisit bersama
        // dengan relasi quiz dan project untuk memastikan datanya ada.
        $currentLesson = Lesson::with(['quiz.questions.answers', 'project'])
                               ->findOrFail($lesson->id);

        // Hitung progres
        $progressPercentage = $course->getProgressPercentageFor(Auth::user());

        // Kirim data yang sudah dimuat ulang ke view
        return view('courses.lesson', [
            'course' => $course,
            'currentLesson' => $currentLesson, // Menggunakan variabel yang baru dimuat
            'progressPercentage' => $progressPercentage,
        ]);
    }

    /**
     * Menandai pelajaran sebagai selesai.
     */
    public function completeLesson(Request $request, Lesson $lesson): RedirectResponse
    {
        $user = Auth::user();
        $course = $lesson->module->course;

        $user->progress()->syncWithoutDetaching([$lesson->id => ['status' => 'SELESAI', 'completed_at' => now()]]);

        // --- LOGIKA BARU UNTUK MENCARI PELAJARAN BERIKUTNYA ---
        $nextLesson = Lesson::where('module_id', $lesson->module_id)
                              ->where('order_index', '>', $lesson->order_index)
                              ->orderBy('order_index', 'asc')
                              ->first();

        if (!$nextLesson) {
            $nextModule = Module::where('course_id', $course->id)
                                  ->where('order_index', '>', $lesson->module->order_index)
                                  ->orderBy('order_index', 'asc')
                                  ->first();
            if ($nextModule) {
                $nextLesson = $nextModule->lessons()->orderBy('order_index', 'asc')->first();
            }
        }

        $totalLessonsCount = $course->lessons()->count();
        $completedLessonsCount = $user->progress()->whereIn('lesson_id', $course->lessons->pluck('lessons.id'))->count();

        if ($totalLessonsCount > 0 && $completedLessonsCount >= $totalLessonsCount) {
            $user->courses()->updateExistingPivot($course->id, ['completed_at' => now()]);
        }

        if ($nextLesson) {
            return redirect()->route('courses.lesson', [
                'course' => $course->slug,
                'lesson' => $nextLesson->id,
            ]);
        }
        
        return redirect()->route('courses.completion', $course->slug);
    }
    
    /**
     * Menampilkan halaman penyelesaian kursus.
     */
    public function showCompletion(Course $course): View
    {
        $user = Auth::user();
        $xpForCompletion = 1000;
        $user->increment('xp_points', $xpForCompletion);
        return view('courses.completion', ['course' => $course]);
    }
}
