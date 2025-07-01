<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            Edit Pelajaran: <span class="text-green-400">{{ $lesson->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                @if(session('success'))
                    <div class="bg-green-500/10 text-green-400 text-sm p-4 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.lessons.update', $lesson) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Judul Pelajaran -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Judul Pelajaran</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $lesson->title) }}" required class="w-full bg-gray-800/80 border rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Tipe Konten -->
                    <div>
                        <label for="content_type" class="block text-sm font-medium text-gray-300 mb-1">Tipe Konten</label>
                        <select id="content_type" name="content_type" required class="w-full bg-gray-800/80 border rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="TEXT" @selected(old('content_type', $lesson->content_type) == 'TEXT')>Teks/Materi</option>
                            <option value="QUIZ" @selected(old('content_type', $lesson->content_type) == 'QUIZ')>Kuis</option>
                            <option value="PROJECT" @selected(old('content_type', $lesson->content_type) == 'PROJECT')>Proyek</option>
                        </select>
                    </div>

                    {{-- Menampilkan input dinamis berdasarkan Tipe Konten --}}
                    @if($lesson->content_type === 'TEXT')
                        <!-- Isi Konten (jika Teks) -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-300 mb-1">Isi Konten Materi</label>
                            <textarea id="content" name="content" rows="10" class="w-full bg-gray-800/80 border rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('content', $lesson->content) }}</textarea>
                        </div>
                    @elseif ($lesson->content_type === 'QUIZ')
                        <!-- Pengelola Kuis -->
                        <div class="p-4 border border-gray-700 rounded-lg">
                            <h4 class="font-semibold text-white">Pengelola Kuis</h4>
                            <p class="text-sm text-gray-400 mt-1">Pelajaran ini adalah sebuah kuis. Anda bisa mengelola pertanyaan dan jawabannya di sini.</p>
                             @if($lesson->quiz)
                                <a href="{{ route('admin.quizzes.questions.index', $lesson->quiz) }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-500 transition-all text-sm">
                                    Kelola Pertanyaan Kuis
                                </a>
                             @else
                                <p class="text-sm text-yellow-400 mt-2">Simpan perubahan untuk membuat kuis baru.</p>
                             @endif
                        </div>
                    @elseif ($lesson->content_type === 'PROJECT')
                         <!-- Pengelola Proyek -->
                         <div class="p-4 border border-gray-700 rounded-lg">
                            <h4 class="font-semibold text-white">Pengelola Proyek</h4>
                            <p class="text-sm text-gray-400 mt-1">Pelajaran ini adalah sebuah proyek. Anda bisa mengelola instruksi dan detailnya di sini.</p>
                             @if($lesson->project)
                                <a href="{{ route('admin.projects.edit', $lesson->project) }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-500 transition-all text-sm">
                                    Kelola Detail Proyek
                                </a>
                             @else
                                <p class="text-sm text-yellow-400 mt-2">Simpan perubahan untuk membuat proyek baru.</p>
                             @endif
                        </div>
                    @endif
                    
                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800/60">
                         <a href="{{ route('admin.courses.edit', $lesson->module->course_id) }}" class="text-sm text-gray-400 hover:text-white">Batal</a>
                         <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
