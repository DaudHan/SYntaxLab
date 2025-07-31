<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
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
        // Statistik dasar
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $activeUsers = User::whereDate('updated_at', '>=', now()->subDays(30))->count();

        // Tingkat Keterlibatan (engagement rate)
        $engagementRate = $totalUsers > 0
            ? round(($activeUsers / $totalUsers) * 100)
            : 0;

        // Kursus terpopuler
        $popularCourses = Course::withCount('users')
            ->orderBy('users_count', 'desc')
            ->take(5)
            ->get();

        // Data pendaftaran pengguna baru (7 hari terakhir)
        $newUsers = User::select(
                DB::raw("DATE(created_at) as date"),
                DB::raw("COUNT(*) as count")
            )
            ->whereDate('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $userChartLabels = [];
        $userChartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $userChartLabels[] = $date;

            $found = $newUsers->firstWhere('date', $date);
            $userChartData[] = $found ? $found->count : 0;
        }

        // Data aktivitas pengguna (7 hari terakhir berdasarkan updated_at)
        $activity = User::select(
                DB::raw("DATE(updated_at) as date"),
                DB::raw("COUNT(*) as count")
            )
            ->whereDate('updated_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $activityLabels = [];
        $activityData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $activityLabels[] = $date;

            $found = $activity->firstWhere('date', $date);
            $activityData[] = $found ? $found->count : 0;
        }

        return view('admin.analytics.index', [
            'totalUsers' => $totalUsers,
            'totalCourses' => $totalCourses,
            'activeUsers' => $activeUsers,
            'engagementRate' => $engagementRate,
            'popularCourses' => $popularCourses,
            'userChartLabels' => $userChartLabels,
            'userChartData' => $userChartData,
            'activityChartLabels' => $activityLabels,
            'activityChartData' => $activityData,
        ]);
    }
}
