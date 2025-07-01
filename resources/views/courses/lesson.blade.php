<x-app-layout>
    {{-- Header utama sekarang menampilkan judul kursus --}}
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ $course->title }}
        </h2>
    </x-slot>
    
    {{-- Wrapper baru untuk layout dua kolom di bawah header utama --}}
<div class="relative lg:flex lg:h-screen lg:overflow-hidden">
        <main class="flex-1 flex flex-col overflow-y-auto">
            {{-- Header Pelajaran --}}
            <header class="p-4 sm:px-8 h-20 flex items-center justify-between shrink-0 border-b border-gray-800/60 sticky top-0 bg-[#050807]/80 backdrop-blur-lg z-10">
                <div class="flex items-center gap-4">
                    <button id="menu-toggle" class="lg:hidden text-gray-400 hover:text-white w-8 h-8 flex flex-col justify-center items-center space-y-1 z-50">
                        <span class="block w-5 h-0.5 bg-current transform transition duration-300 ease-in-out"></span>
                        <span class="block w-5 h-0.5 bg-current transition duration-300 ease-in-out"></span>
                        <span class="block w-5 h-0.5 bg-current transform transition duration-300 ease-in-out"></span>
                    </button>
                    <div>
                        <a href="{{ route('my-courses') }}" class="text-gray-400 hover:text-white flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                            Kursus Saya
                        </a>
                        <h1 class="text-lg font-bold text-white mt-1">{{ $currentLesson->title }}</h1>
                    </div>
                </div>
                <div class="w-1/3 hidden md:block">
                    <div class="flex items-center justify-between text-sm text-gray-400 mb-1">
                        <span>Progres Kursus</span>
                        <span>{{ $progressPercentage ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $progressPercentage ?? 0 }}%"></div>
                    </div>
                </div>
            </header>

            <div class="p-4 sm:p-8 flex-1">
                <div class="max-w-4xl mx-auto lesson-content">

                    @switch($currentLesson->content_type)
                        @case('TEXT')
                            <article class="prose prose-invert max-w-none prose-p:text-gray-400 prose-headings:text-white">
                                <h1>{{ $currentLesson->title }}</h1>
                                <p>{!! nl2br(e($currentLesson->content)) !!}</p>
                            </article>
                            @break

                        @case('QUIZ')
                            @if($currentLesson->quiz)
                                <h1 class="text-4xl font-black text-white tracking-tight">{{ $currentLesson->quiz->title }}</h1>
                                <p class="text-lg text-gray-400 mt-2">Uji pemahaman Anda pada modul ini.</p>
                                
                                @if(session('quiz_result'))
                                    @php $result = session('quiz_result'); @endphp
                                    <div class="mt-8 p-6 rounded-xl premium-card">
                                        <h3 class="text-2xl font-bold text-white">Hasil Kuis Anda</h3>
                                        <p class="text-4xl font-black mt-4 @if($result['percentage'] >= 70) text-green-400 @else text-red-400 @endif">{{ $result['percentage'] }}%</p>
                                        <p class="text-gray-400 mt-1">Anda menjawab {{ $result['score'] }} dari {{ $result['totalQuestions'] }} pertanyaan dengan benar dan mendapatkan <span class="font-bold text-white">{{ $result['xpGained'] }} XP</span>.</p>
                                    </div>
                                @else
                                    <form class="mt-8 space-y-8" method="POST" action="{{ route('quiz.submit', $currentLesson->quiz) }}">
                                        @csrf
                                        @foreach ($currentLesson->quiz->questions as $question)
                                            <div>
                                                <p class="font-semibold text-white mb-4">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                                                <div class="space-y-3">
                                                    @foreach ($question->answers as $answer)
                                                        <label class="flex items-center border border-gray-700 p-4 rounded-lg cursor-pointer transition-colors hover:bg-gray-800/50">
                                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" required class="bg-gray-900 border-gray-600 text-green-500 focus:ring-green-500">
                                                            <span class="ms-3 text-white">{{ $answer->answer_text }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="pt-6">
                                            <button type="submit" class="w-full bg-green-500 text-black font-semibold py-3 px-6 rounded-md hover:bg-green-400 transition-all text-base shadow-lg shadow-green-500/20">
                                                Kirim Jawaban
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            @else
                                <p class="text-yellow-400">Data kuis untuk pelajaran ini tidak ditemukan.</p>
                            @endif
                            @break

                        @case('PROJECT')
                            @if($currentLesson->project)
                                <h1 class="text-4xl font-black text-white tracking-tight">Proyek: {{ $currentLesson->title }}</h1>
                                <div class="mt-4 text-lg text-gray-400 prose prose-invert max-w-none">
                                    <h2 class="text-white">Instruksi</h2>
                                    {!! nl2br(e($currentLesson->project->description)) !!}
                                </div>
                                <div class="mt-12 pt-8 border-t border-gray-800/60">
                                    <h3 class="text-2xl font-bold text-white">Kumpulkan Proyek Anda</h3>
                                    <p class="text-gray-400 mt-2">Kirimkan link ke repositori dan URL demo dari proyek Anda untuk dinilai.</p>
                                    <form class="mt-6 space-y-6" method="POST" action="{{ route('projects.submit', $currentLesson) }}">
                                        @csrf
                                        <div>
                                            <label for="repo_url" class="block text-sm font-medium text-gray-300 mb-1">URL Repositori (e.g., GitHub)</label>
                                            <input type="url" id="repo_url" name="repository_url" placeholder="https://github.com/..." required class="w-full bg-gray-800/80 border rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                                        </div>
                                        <div>
                                            <label for="demo_url" class="block text-sm font-medium text-gray-300 mb-1">URL Demo (e.g., Vercel, Netlify)</label>
                                            <input type="url" id="demo_url" name="demo_url" placeholder="https://proyek-saya.vercel.app" required class="w-full bg-gray-800/80 border rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                                        </div>
                                        <div class="pt-2">
                                            <button type="submit" class="w-full bg-green-500 text-black font-semibold py-3 px-6 rounded-md hover:bg-green-400 transition-all text-base shadow-lg shadow-green-500/20">
                                                Kirim Proyek untuk Dinilai
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <p class="text-yellow-400">Data proyek untuk pelajaran ini tidak ditemukan.</p>
                            @endif
                            @break
                            
                        @default
                            <p class="text-gray-500">Tipe konten tidak dikenali.</p>
                    @endswitch
                </div>

                {{-- Tombol Navigasi Pelajaran --}}
                <div class="max-w-4xl mx-auto mt-12 pt-6 border-t border-gray-800/60 flex justify-end items-center">
                    <form method="POST" action="{{ route('lessons.complete', $currentLesson) }}">
                        @csrf
                        <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all text-sm flex items-center gap-2">
                            Tandai Selesai & Lanjutkan
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                        </button>
                    </form>
                </div>
            </div>
        </main>
        
        <!-- Sidebar Kurikulum -->
        <aside class="w-80 bg-[#0c1010] flex-col flex shrink-0 border-l border-gray-800/60 lg:flex hidden">
            <div class="flex items-center gap-2 px-6 h-20 shrink-0 border-b border-gray-800/60">
                <h2 class="text-lg font-bold text-white">Kurikulum</h2>
            </div>
            <div class="flex-1 overflow-y-auto p-4">
                 <div class="space-y-4">
                    @foreach ($course->modules as $module)
                        <div>
                            <h3 class="font-bold text-white px-2 mb-2">{{ $module->order_index }}. {{ $module->title }}</h3>
                            <ul class="space-y-1">
                                @foreach ($module->lessons as $lesson)
                                    <li>
                                        <a href="{{ route('courses.lesson', ['course' => $course->slug, 'lesson' => $lesson->id]) }}" 
                                           class="flex items-center gap-3 text-sm p-2 rounded-md transition-colors 
                                           @if($currentLesson->id === $lesson->id) 
                                               bg-green-500/10 text-white font-semibold 
                                           @else 
                                               text-gray-400 hover:bg-gray-700/50 hover:text-white
                                           @endif">
                                            @if($lesson->content_type === 'QUIZ')
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.965 4.904l9.13 6.521a.75.75 0 010 1.15l-9.13 6.521A.75.75 0 015 18.5V1.5a.75.75 0 01.965-.596z" clip-rule="evenodd" /></svg>
                                            @else
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" /></svg>
                                            @endif
                                            <span>{{ $lesson->title }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</x-app-layout>
