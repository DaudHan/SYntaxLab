<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon; // Tambahkan ini untuk manipulasi tanggal

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor admin dengan statistik dasar.
     */
    public function index(): View
{
    $totalUsers = User::count();
    $totalCourses = Course::count();
    $newUsersLast30Days = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
    $activeUsersLast30Days = User::where('updated_at', '>=', Carbon::now()->subDays(30))->count();

    $engagementRate = $totalUsers > 0
        ? round(($activeUsersLast30Days / $totalUsers) * 100)
        : 0;

    // Ambil 10 pengguna yang terakhir aktif
    $recentActiveUsers = User::orderByDesc('updated_at')->take(10)->get();

    return view('admin.dashboard', [
        'totalUsers' => $totalUsers,
        'totalCourses' => $totalCourses,
        'newUsersLast30Days' => $newUsersLast30Days,
        'engagementRate' => $engagementRate,
        'recentActiveUsers' => $recentActiveUsers, // kirim ke blade
    ]);
}
}
