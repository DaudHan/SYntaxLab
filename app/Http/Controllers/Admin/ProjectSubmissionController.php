<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectSubmission;
use App\Notifications\ProjectReviewed;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProjectSubmissionController extends Controller
{
    /**
     * Menampilkan daftar semua kiriman proyek.
     */
    public function index(): View
    {
        $submissions = ProjectSubmission::with(['user', 'lesson'])
                                        ->latest()
                                        ->paginate(10);

        return view('admin.submissions.projects.index', [
            'submissions' => $submissions,
        ]);
    }

    /**
     * Menampilkan halaman detail untuk meninjau satu kiriman proyek.
     */
    public function show(ProjectSubmission $submission): View
    {
        // Eager load relasi untuk ditampilkan di view
        $submission->load(['user', 'lesson.module.course']);

        return view('admin.submissions.projects.show', [
            'submission' => $submission,
        ]);
    }

    /**
     * Memperbarui status dan memberikan umpan balik pada kiriman proyek.
     */
    public function update(Request $request, ProjectSubmission $submission): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:APPROVED,REVISION',
            'feedback' => 'nullable|string',
        ]);

        $submission->update($validated);
        
        // 2. KIRIM NOTIFIKASI KE PENGGUNA
        // Kita ambil pengguna dari relasi yang sudah ada di submission
        $userToNotify = $submission->user;
        $userToNotify->notify(new ProjectReviewed($submission));

        return redirect()->route('admin.projects.submissions.index')->with('success', 'Penilaian proyek berhasil disimpan!');
    }
}
