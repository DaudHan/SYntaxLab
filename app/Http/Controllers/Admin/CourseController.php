<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Menampilkan halaman daftar kursus.
     */
    public function index(Request $request): View
{
    $query = Course::query();

    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Ambil kategori untuk filter
    $categories = Course::select('category')->distinct()->pluck('category');

    // Ambil data dengan jumlah siswa (relasi users_count)
    $courses = $query->withCount('users')->latest()->paginate(10);

    return view('admin.courses.index', [
        'courses' => $courses,
        'categories' => $categories,
    ]);
}

    /**
     * Menampilkan formulir untuk membuat kursus baru.
     */
    public function create(): View
    {
        return view('admin.courses.create');
    }

    /**
     * Menyimpan kursus baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:courses',
            'category' => 'required|string|max:100',
            'difficulty' => 'required|in:PEMULA,MENENGAH,MAHIR',
            'description' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir untuk mengedit kursus yang ada.
     * Method ini sudah diperbarui untuk memuat data kurikulum.
     */
    public function edit(Course $course): View
    {
        // Eager load relasi modul dan pelajaran untuk ditampilkan di view
        $course->loadMissing('modules.lessons');

        return view('admin.courses.edit', ['course' => $course]);
    }

    /**
     * Memperbarui kursus yang ada di database.
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('courses')->ignore($course->id)],
            'category' => 'required|string|max:100',
            'difficulty' => 'required|in:PEMULA,MENENGAH,MAHIR',
            'description' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['status'] = $request->input('status', 'DRAF');

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil diperbarui!');
    }

    /**
     * Menghapus kursus dari database.
     */
    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil dihapus!');
    }
}
