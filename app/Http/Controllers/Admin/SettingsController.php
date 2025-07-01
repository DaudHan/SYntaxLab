<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    /**
     * Menampilkan halaman pengaturan.
     */
    public function index(): View
    {
        // Ambil semua pengaturan dan ubah menjadi array key => value
        // agar mudah diakses di view.
        $settings = Setting::pluck('value', 'key');
        
        return view('admin.settings.index', ['settings' => $settings]);
    }

    /**
     * Memperbarui pengaturan di database.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validasi data yang masuk dari formulir
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'welcome_notification' => 'nullable|in:on',
            'completion_notification' => 'nullable|in:on',
        ]);

        // Simpan atau perbarui setiap pengaturan menggunakan metode updateOrCreate.
        // Ini akan membuat baris baru jika kuncinya belum ada, atau memperbaruinya jika sudah ada.
        Setting::updateOrCreate(['key' => 'site_name'], ['value' => $validated['site_name']]);
        
        // Untuk checkbox, kita periksa apakah nilainya ada ('on'), lalu simpan sebagai '1' atau '0'.
        Setting::updateOrCreate(['key' => 'welcome_notification'], ['value' => isset($validated['welcome_notification']) ? '1' : '0']);
        Setting::updateOrCreate(['key' => 'completion_notification'], ['value' => isset($validated['completion_notification']) ? '1' : '0']);

        // Arahkan kembali ke halaman sebelumnya dengan pesan sukses.
        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
