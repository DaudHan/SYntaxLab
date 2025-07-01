<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LessonController extends Controller
{
    /**
     * Menampilkan formulir untuk membuat pelajaran baru.
     */
    public function create(Module $module): View
    {
        return view('admin.lessons.create', ['module' => $module]);
    }

    /**
     * Menyimpan pelajaran baru ke database.
     */
    public function store(Request $request, Module $module): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_type' => 'required|in:TEXT,QUIZ,PROJECT',
            'content' => 'nullable|string',
        ]);

        $order = $module->lessons()->max('order_index') + 1;
        $validated['order_index'] = $order;

        $lesson = $module->lessons()->create($validated);

        // =======================================================
        // ==== INI ADALAH PERBAIKANNYA (BAGIAN 1) ====
        // =======================================================
        if ($lesson->content_type === 'QUIZ') {
            $lesson->quiz()->create([
                'title' => 'Kuis untuk: ' . $lesson->title,
            ]);
        } elseif ($lesson->content_type === 'PROJECT') {
            $lesson->project()->create([
                'description' => 'Instruksi untuk proyek ' . $lesson->title,
            ]);
        }

        return redirect()->route('admin.courses.edit', $module->course_id)->with('success', 'Pelajaran baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir untuk mengedit pelajaran.
     */
    public function edit(Lesson $lesson): View
    {
        $lesson->loadMissing(['quiz', 'project']);
        return view('admin.lessons.edit', ['lesson' => $lesson]);
    }

    /**
     * Memperbarui pelajaran yang ada.
     */
    public function update(Request $request, Lesson $lesson): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_type' => 'required|in:TEXT,QUIZ,PROJECT',
            'content' => 'nullable|string',
        ]);

        $lesson->update($validated);
        
        // =======================================================
        // ==== INI ADALAH PERBAIKANNYA (BAGIAN 2) ====
        // =======================================================
        if ($lesson->content_type === 'QUIZ' && !$lesson->quiz) {
            $lesson->quiz()->create(['title' => 'Kuis untuk: ' . $lesson->title]);
        } elseif ($lesson->content_type === 'PROJECT' && !$lesson->project) {
            $lesson->project()->create(['description' => 'Instruksi untuk proyek ' . $lesson->title]);
        }
        
        // (Opsional) Jika tipe diubah DARI kuis/proyek, hapus data lama
        if ($lesson->content_type !== 'QUIZ' && $lesson->quiz) {
            $lesson->quiz->delete();
        }
        if ($lesson->content_type !== 'PROJECT' && $lesson->project) {
            $lesson->project->delete();
        }

        return redirect()->route('admin.courses.edit', $lesson->module->course_id)->with('success', 'Pelajaran berhasil diperbarui!');
    }

    /**
     * Menghapus pelajaran dari database.
     */
    public function destroy(Lesson $lesson): RedirectResponse
    {
        $courseId = $lesson->module->course_id;
        $lesson->delete();
        return redirect()->route('admin.courses.edit', $courseId)->with('success', 'Pelajaran berhasil dihapus!');
    }
}
