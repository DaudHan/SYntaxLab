<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Menampilkan halaman analitik dengan data platform.
     */
    public function index(): View
    {
        // Menghitung statistik dasar
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $activeUsers = User::whereDate('updated_at', '>=', now()->subDays(30))->count(); // Contoh pengguna aktif dalam 30 hari

        // Mengambil kursus terpopuler berdasarkan jumlah pendaftar
        $popularCourses = Course::withCount('users') // Menghitung jumlah 'users' untuk setiap kursus
            ->orderBy('users_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.analytics.index', [
            'totalUsers' => $totalUsers,
            'totalCourses' => $totalCourses,
            'activeUsers' => $activeUsers,
            'popularCourses' => $popularCourses,
        ]);
    }
}
