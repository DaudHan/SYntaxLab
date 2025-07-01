<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan halaman daftar pengguna.
     */
    public function index(): View
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Menampilkan formulir untuk mengedit pengguna.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Memperbarui data pengguna di database.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:USER,ADMIN',
        ]);

        // Perbarui data pengguna
        $user->update($validated);

        // Arahkan kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy(User $user): RedirectResponse
    {
        // Keamanan: Pastikan admin tidak bisa menghapus akunnya sendiri.
        if (Auth::user()->id === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Hapus data pengguna.
        $user->delete();

        // Arahkan kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
