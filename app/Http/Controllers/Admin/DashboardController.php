<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\View\View;
    use App\Models\User;
    use App\Models\Course;

    class DashboardController extends Controller
    {
        /**
         * Menampilkan halaman dasbor admin dengan statistik dasar.
         */
        public function index(): View
        {
            // Ambil data statistik untuk ditampilkan di dasbor
            $totalUsers = User::count();
            $totalCourses = Course::count();

            return view('admin.dashboard', [
                'totalUsers' => $totalUsers,
                'totalCourses' => $totalCourses,
            ]);
        }
    }
    