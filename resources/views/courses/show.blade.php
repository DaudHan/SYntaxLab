<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Detail Kursus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kolom Kiri - Konten Utama -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Informasi Utama -->
                    <div>
                        <p class="text-sm text-green-400 font-medium">{{ $course->category }}</p>
                        <h1 class="text-4xl font-black text-white tracking-tight mt-1">{{ $course->title }}</h1>
                        <p class="text-lg text-gray-400 mt-2">{{ $course->description }}</p>
                    </div>

                    <!-- Kurikulum Kursus -->
                    <div class="premium-card p-6 rounded-xl">
                        <h3 class="text-xl font-bold text-white mb-4">Kurikulum Kursus</h3>
                        <div class="space-y-4">
                            @foreach ($course->modules as $module)
                                <div>
                                    <h4 class="font-semibold text-white text-lg mb-2">{{ $module->order_index }}. {{ $module->title }}</h4>
                                    <ul class="space-y-2 ml-4">
                                        @foreach($module->lessons as $lesson)
                                            <li class="flex items-center gap-3 text-gray-400">
                                                @if($lesson->content_type === 'QUIZ')
                                                    <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.965 4.904l9.13 6.521a.75.75 0 010 1.15l-9.13 6.521A.75.75 0 015 18.5V1.5a.75.75 0 01.965-.596z" clip-rule="evenodd" /></svg>
                                                @else
                                                    <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" /></svg>
                                                @endif
                                                <span>{{ $lesson->title }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan - Info & Aksi -->
                <div class="lg:col-span-1">
                    <div class="premium-card p-6 rounded-xl sticky top-24">
                        <img src="https://placehold.co/400x200/10b981/050807?text={{ urlencode($course->category) }}" class="w-full h-40 object-cover rounded-lg mb-6" alt="Thumbnail Kursus">
                        <h3 class="text-xl font-bold text-white">Detail Kursus</h3>
                        <ul class="text-sm space-y-3 mt-4 text-gray-300">
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95a15.65 15.65 0 00-1.38-3.56A8.03 8.03 0 0118.92 8zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56A7.987 7.987 0 015.08 16zm2.95-8H5.08a7.987 7.987 0 014.33-3.56C8.81 5.55 8.35 6.75 8.03 8h2.95zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 01-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"></path></svg> Tingkat {{ $course->difficulty }}</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> Akses Penuh Selamanya</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-9.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path d="M12 14l9-5-9-5-9 5 9 5z" stroke-linecap="round" stroke-linejoin="round"></path></svg> Sertifikat Kelulusan</li>
                        </ul>
                        <div class="mt-6">
                            {{-- LOGIKA BARU UNTUK TOMBOL --}}
                            @if ($isEnrolled)
                                {{-- Jika pengguna sudah terdaftar, tampilkan tombol untuk melanjutkan --}}
                                @if($course->modules->isNotEmpty() && $course->modules->first()->lessons->isNotEmpty())
                                    <a href="{{ route('courses.lesson', ['course' => $course->slug, 'lesson' => $course->modules->first()->lessons->first()->id]) }}" class="w-full block text-center bg-gray-700 text-white font-semibold py-3 px-5 rounded-md hover:bg-gray-600 transition-all text-base">
                                        Lanjutkan Belajar
                                    </a>
                                @endif
                            @else
                                {{-- Jika belum, tampilkan tombol untuk mendaftar --}}
                                <form method="POST" action="{{ route('courses.enroll', $course) }}">
                                    @csrf
                                    <button type="submit" class="w-full block text-center bg-green-500 text-black font-semibold py-3 px-5 rounded-md hover:bg-green-400 transition-all text-base shadow-lg shadow-green-500/20">
                                        Daftar Kursus Ini
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
