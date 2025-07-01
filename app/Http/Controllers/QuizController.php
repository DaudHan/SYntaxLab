<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Memproses jawaban kuis yang dikirimkan oleh pengguna.
     */
    public function submit(Request $request, Quiz $quiz): RedirectResponse
    {
        // 1. Validasi input
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer',
        ]);

        $submittedAnswers = $validated['answers'];
        $totalQuestions = $quiz->questions()->count();
        $score = 0;
        $results = [];

        // 2. Iterasi melalui setiap pertanyaan untuk memeriksa jawaban dengan akurat
        foreach ($quiz->questions as $question) {
            $correctAnswer = $question->answers()->where('is_correct', true)->first();

            if (isset($submittedAnswers[$question->id])) {
                $submittedAnswerId = (int) $submittedAnswers[$question->id];
                
                if ($correctAnswer && $submittedAnswerId === $correctAnswer->id) {
                    $score++;
                }

                $results[$question->id] = [
                    'submitted' => $submittedAnswerId,
                    'correct'   => $correctAnswer->id,
                ];
            } else {
                $results[$question->id] = [
                    'submitted' => null,
                    'correct'   => $correctAnswer->id,
                ];
            }
        }

        // 3. Hitung persentase skor
        $percentage = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;

        // 4. Tambahkan XP ke pengguna
        $user = Auth::user();
        $xpGained = $score * 10;
        $user->increment('xp_points', $xpGained);

        // ====================================================================
        // === INI ADALAH PERBAIKANNYA: Muat ulang data sebelum dikirim ===
        // ====================================================================
        // Kita memuat ulang relasi untuk memastikan data pertanyaan dan jawaban
        // tersedia di halaman setelah redirect.
        $quiz->load('questions.answers');

        // 5. Kembalikan ke halaman pelajaran dengan membawa hasil kuis
        return back()->with([
            'quiz_result' => [
                'score' => $score,
                'totalQuestions' => $totalQuestions,
                'percentage' => round($percentage),
                'results' => $results,
                'xpGained' => $xpGained,
            ],
            // Kita juga mengirimkan kembali data kuis yang sudah dimuat ulang
            'reviewed_quiz' => $quiz 
        ]);
    }
}
