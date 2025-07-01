<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question; // Impor model Question
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class QuizQuestionController extends Controller
{
    /**
     * Menampilkan halaman untuk mengelola pertanyaan sebuah kuis.
     */
    public function index(Quiz $quiz): View
    {
        // Eager load relasi questions dan answers untuk ditampilkan di view
        $quiz->load('questions.answers');

        return view('admin.quizzes.questions.index', ['quiz' => $quiz]);
    }

    /**
     * Menyimpan pertanyaan baru beserta jawabannya.
     */
    public function store(Request $request, Quiz $quiz): RedirectResponse
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2',
            'answers.*' => 'required|string|max:255',
            'correct_answer' => 'required|integer',
        ]);

        // Gunakan transaksi untuk memastikan semua data tersimpan atau tidak sama sekali
        DB::transaction(function () use ($validated, $quiz) {
            // Buat pertanyaan baru
            $question = $quiz->questions()->create([
                'question_text' => $validated['question_text']
            ]);

            // Simpan setiap jawaban
            foreach ($validated['answers'] as $index => $answerText) {
                $question->answers()->create([
                    'answer_text' => $answerText,
                    'is_correct' => ($index == $validated['correct_answer']),
                ]);
            }
        });

        return back()->with('success', 'Pertanyaan baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir untuk mengedit pertanyaan.
     */
    public function edit(Question $question): View
    {
        $question->load('answers');
        return view('admin.quizzes.questions.edit', ['question' => $question]);
    }

    /**
     * Memperbarui pertanyaan dan jawabannya.
     */
    public function update(Request $request, Question $question): RedirectResponse
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2',
            'answers.*' => 'required|string|max:255',
            'correct_answer' => 'required', // ID dari jawaban yang benar
        ]);

        DB::transaction(function () use ($validated, $question) {
            $question->update(['question_text' => $validated['question_text']]);
            
            // Hapus jawaban lama dan buat yang baru untuk kesederhanaan
            $question->answers()->delete();
            
            foreach ($validated['answers'] as $answerId => $answerText) {
                // Karena kita membuat ulang, kita tidak menggunakan ID lama sebagai kunci
                $isCorrect = ($answerId == $validated['correct_answer']);
                $question->answers()->create([
                    'answer_text' => $answerText,
                    'is_correct' => $isCorrect,
                ]);
            }
        });
        
        return redirect()->route('admin.quizzes.questions.index', $question->quiz_id)->with('success', 'Pertanyaan berhasil diperbarui!');
    }

    /**
     * Menghapus pertanyaan.
     */
    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus!');
    }
}
