<?php

    namespace App\Http\Controllers;

    use App\Models\Lesson; // Impor Lesson
    use App\Models\ProjectSubmission; // Impor ProjectSubmission
    use Illuminate\Http\Request;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Support\Facades\Auth;

    class ProjectController extends Controller
    {
        /**
         * Menyimpan hasil pengumpulan proyek dari pengguna.
         */
        public function submit(Request $request, Lesson $lesson): RedirectResponse
        {
            $validated = $request->validate([
                'repository_url' => 'required|url',
                'demo_url' => 'required|url',
            ]);

            // Simpan atau perbarui pengumpulan proyek
            ProjectSubmission::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'lesson_id' => $lesson->id,
                ],
                [
                    'repository_url' => $validated['repository_url'],
                    'demo_url' => $validated['demo_url'],
                    'status' => 'PENDING', // Set status kembali ke pending saat re-submit
                ]
            );

            return back()->with('success', 'Proyek Anda berhasil dikirimkan untuk dinilai!');
        }
    }
    