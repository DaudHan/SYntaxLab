<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor dengan data dinamis untuk pengguna.
     */
    public function index(): View
    {
        $user = Auth::user();

        // 1. Ambil Statistik Pengguna
        $rank = User::where('xp_points', '>', $user->xp_points)->count() + 1;
        $completedCoursesCount = $user->courses()->wherePivot('completed_at', '!=', null)->count();

        // 2. Ambil data untuk "Lanjutkan Belajar"
        // Cari pelajaran terakhir yang progresnya diupdate
        $lastProgress = $user->progress()->with('module.course')->latest('user_progress.updated_at')->first();
        
        // 3. Ambil data untuk "Rekomendasi"
        // Ambil ID kursus yang sudah diikuti pengguna
        $enrolledCourseIds = $user->courses()->pluck('courses.id');
        // Ambil 3 kursus terbaru yang belum diikuti pengguna
        $recommendedCourses = Course::whereNotIn('id', $enrolledCourseIds)
                                    ->where('status', 'DIPUBLIKASIKAN')
                                    ->latest()
                                    ->take(3)
                                    ->get();

        return view('dashboard', [
            'rank' => $rank,
            'completedCoursesCount' => $completedCoursesCount,
            'lastProgress' => $lastProgress,
            'recommendedCourses' => $recommendedCourses,
        ]);
    }
}
