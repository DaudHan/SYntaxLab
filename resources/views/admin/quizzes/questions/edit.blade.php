<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            Edit Pertanyaan Kuis
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                 <form method="POST" action="{{ route('admin.quizzes.questions.update', $question) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="question_text" class="block text-sm font-medium text-gray-300 mb-1">Teks Pertanyaan</label>
                        <textarea id="question_text" name="question_text" rows="3" required class="w-full bg-gray-800/80 border rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('question_text', $question->question_text) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Pilihan Jawaban (Pilih satu sebagai jawaban benar)</label>
                        <div class="space-y-4">
                            @foreach($question->answers as $answer)
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="correct_answer" value="{{ $answer->id }}" @checked($answer->is_correct) required class="bg-gray-900 border-gray-600 text-green-500 focus:ring-green-500">
                                    <input type="text" name="answers[{{ $answer->id }}]" value="{{ old('answers.'.$answer->id, $answer->answer_text) }}" required class="w-full bg-gray-800/80 border rounded-md py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800/60">
                         <a href="{{ route('admin.quizzes.questions.index', $question->quiz_id) }}" class="text-sm text-gray-400 hover:text-white">Batal</a>
                         <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
