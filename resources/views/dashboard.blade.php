<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8"><p class="text-gray-400">Selamat datang kembali, mari lanjutkan progres belajarmu.</p></div>
            
            {{-- Bagian Statistik Pengguna (Sekarang Dinamis) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="premium-card p-5 rounded-xl"><p class="text-sm text-gray-400">Peringkat</p><p class="text-2xl font-bold text-white mt-1">#{{ number_format($rank) }}</p></div>
                <div class="premium-card p-5 rounded-xl"><p class="text-sm text-gray-400">Poin XP</p><p class="text-2xl font-bold text-white mt-1">{{ number_format(Auth::user()->xp_points) }}</p></div>
                <div class="premium-card p-5 rounded-xl"><p class="text-sm text-gray-400">Kursus Selesai</p><p class="text-2xl font-bold text-white mt-1">{{ $completedCoursesCount }}</p></div>
                <div class="premium-card p-5 rounded-xl"><p class="text-sm text-gray-400">Proyek Selesai</p><p class="text-2xl font-bold text-white mt-1">0</p></div> {{-- Data Proyek masih statis --}}
            </div>

            {{-- Bagian Lanjutkan Belajar (Sekarang Dinamis) --}}
            @if($lastProgress)
                <div class="mt-10">
                    <h3 class="text-xl font-bold text-white mb-4">Lanjutkan Belajar</h3>
                    <div class="premium-card p-6 rounded-xl flex flex-col sm:flex-row items-center gap-6">
                        <img src="https://placehold.co/120x80/10b981/050807?text={{ urlencode($lastProgress->module->course->category) }}" class="w-full sm:w-32 h-24 sm:h-auto object-cover rounded-lg" alt="Thumbnail Kursus">
                        <div class="flex-1 w-full">
                            <p class="text-sm text-green-400 font-medium">{{ $lastProgress->module->course->category }}</p>
                            <h4 class="font-semibold text-xl text-white mt-1">{{ $lastProgress->module->course->title }}</h4>
                            <p class="text-xs text-gray-400 mt-1">Pelajaran terakhir: {{ $lastProgress->title }}</p>
                        </div>
                        <a href="{{ route('courses.lesson', ['course' => $lastProgress->module->course->slug, 'lesson' => $lastProgress->id]) }}" class="w-full mt-4 sm:mt-0 sm:w-auto shrink-0 bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all">Lanjutkan</a>
                    </div>
                </div>
            @endif

            {{-- Bagian Rekomendasi (Sekarang Dinamis) --}}
            <div class="mt-10 pb-8">
                <h3 class="text-xl font-bold text-white mb-4">Rekomendasi Untukmu</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($recommendedCourses as $course)
                        <div class="premium-card p-5 rounded-xl flex flex-col">
                            <h4 class="font-bold text-lg text-white">{{ $course->title }}</h4>
                            <p class="text-sm text-gray-400 mt-1 flex-grow">{{ Str::limit($course->description, 100) }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-xs font-semibold text-green-400 bg-green-500/10 px-2 py-1 rounded-full">{{ $course->difficulty }}</span>
                                <a href="{{ route('courses.show', $course->slug) }}" class="text-sm font-semibold text-gray-300 hover:text-white">Lihat Detail &rarr;</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center p-8 text-gray-500 premium-card rounded-xl">
                            <p>Tidak ada rekomendasi saat ini. Anda sudah mengikuti semua kursus yang tersedia!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
