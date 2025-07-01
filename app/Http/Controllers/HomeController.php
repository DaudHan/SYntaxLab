<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (landing page).
     */
    public function index(): View
    {
        // Untuk saat ini, kita hanya menampilkan view.
        // Nanti kita bisa mengirim data kursus unggulan ke sini.
        return view('welcome');
    }

    public function privacy(): View
        {
            return view('privacy-policy');
        }

        public function terms(): View
        {
            return view('terms-of-service');
        }
}
