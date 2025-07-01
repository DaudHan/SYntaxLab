<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WeeklyXp; // Impor model baru
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LeaderboardController extends Controller
{
    /**
     * Menampilkan halaman papan peringkat dengan filter.
     */
    public function index(Request $request): View
    {
        $filter = $request->query('filter', 'global'); // Default filter adalah 'global'
        $currentUser = Auth::user();

        if ($filter === 'weekly') {
            // Logika untuk peringkat mingguan
            $rankedUsers = WeeklyXp::with('user')
                                   ->orderBy('xp_earned', 'desc')
                                   ->take(100)
                                   ->get()
                                   ->map(function ($weeklyXp) {
                                       // Ubah struktur agar mirip dengan user global
                                       $user = $weeklyXp->user;
                                       $user->xp_points = $weeklyXp->xp_earned; // Gunakan xp mingguan
                                       return $user;
                                   });
            
            $currentUserRank = $rankedUsers->search(fn($user) => $user->id === $currentUser->id);
            // Anda bisa menambahkan logika peringkat mingguan yang lebih detail di sini

        } else {
            // Logika untuk peringkat global (yang sudah ada)
            $rankedUsers = User::orderBy('xp_points', 'desc')
                               ->take(100)
                               ->get();

            $currentUserRank = $rankedUsers->search(fn($user) => $user->id === $currentUser->id);
        }

        if ($currentUserRank === false) {
             // Jika pengguna tidak masuk 100 besar, cari peringkatnya secara manual
             if ($filter === 'weekly') {
                 $currentUser->rank = WeeklyXp::where('xp_earned', '>', $currentUser->weeklyXp->xp_earned ?? 0)->count() + 1;
             } else {
                 $currentUser->rank = User::where('xp_points', '>', $currentUser->xp_points)->count() + 1;
             }
        } else {
            $currentUser->rank = $currentUserRank + 1;
        }

        return view('leaderboard.index', [
            'rankedUsers' => $rankedUsers,
            'currentUser' => $currentUser,
            'filter' => $filter, // Kirim filter ke view
        ]);
    }
}
