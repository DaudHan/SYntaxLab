<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            Kelola Pertanyaan untuk Kuis: <span class="text-green-400">{{ $quiz->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

             <!-- Daftar Pertanyaan yang Ada -->
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                <h3 class="text-lg font-bold text-white mb-4">Daftar Pertanyaan</h3>
                <div class="space-y-4">
                    @forelse($quiz->questions as $question)
                        <div class="p-4 bg-gray-800/50 rounded-lg">
                            <div class="flex justify-between items-center">
                                <p class="text-white font-semibold">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                                <div class="space-x-2">
                                    <a href="{{ route('admin.quizzes.questions.edit', $question) }}" class="text-gray-400 hover:text-white p-1 text-xs font-medium">Edit</a>
                                    <form method="POST" action="{{ route('admin.quizzes.questions.destroy', $question) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 p-1 text-xs font-medium">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            <ul class="mt-2 ml-4 text-sm">
                                @foreach($question->answers as $answer)
                                    <li class="{{ $answer->is_correct ? 'text-green-400 font-bold' : 'text-gray-400' }}">
                                        - {{ $answer->answer_text }} {{ $answer->is_correct ? '(Jawaban Benar)' : '' }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">Belum ada pertanyaan di kuis ini.</p>
                    @endforelse
                </div>
            </div>

            <!-- Form Tambah Pertanyaan Baru -->
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                 <h3 class="text-lg font-bold text-white mb-4">Tambah Pertanyaan Baru</h3>
                 @if(session('success'))
                    <div class="bg-green-500/10 text-green-400 text-sm p-4 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                 <form method="POST" action="{{ route('admin.quizzes.questions.store', $quiz) }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="question_text" class="block text-sm font-medium text-gray-300 mb-1">Teks Pertanyaan</label>
                        <textarea id="question_text" name="question_text" rows="3" required class="w-full bg-gray-800/80 border rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('question_text') }}</textarea>
                        <x-input-error :messages="$errors->get('question_text')" class="mt-2" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Pilihan Jawaban (Pilih satu sebagai jawaban benar)</label>
                        <div class="space-y-4">
                            @for($i = 0; $i < 4; $i++)
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="correct_answer" value="{{ $i }}" required class="bg-gray-900 border-gray-600 text-green-500 focus:ring-green-500">
                                    <input type="text" name="answers[]" placeholder="Teks jawaban {{ $i + 1 }}" required class="w-full bg-gray-800/80 border rounded-md py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                            @endfor
                        </div>
                         <x-input-error :messages="$errors->get('answers')" class="mt-2" />
                         <x-input-error :messages="$errors->get('correct_answer')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800/60">
                         <a href="{{ route('admin.courses.edit', $quiz->lesson->module->course_id) }}" class="text-sm text-gray-400 hover:text-white">Kembali ke Manajemen Kursus</a>
                         <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            Simpan Pertanyaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
