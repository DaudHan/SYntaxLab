<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Telusuri Kursus Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <p class="text-gray-400">Temukan pengetahuan dan skill baru untuk meningkatkan karirmu.</p>
            </div>

            <!-- Search & Filter -->
            <div class="flex flex-col md:flex-row items-center gap-4 mb-8">
                <div class="relative w-full md:flex-1">
                    <input type="text" placeholder="Cari kursus, contoh: 'React' atau 'Python'" class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 pl-10 pr-4 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                </div>
            </div>
            
            @if($courses->isEmpty())
                <div class="text-center p-12 premium-card rounded-xl">
                    <h3 class="text-xl font-bold text-white">Oops! Tidak Ada Kursus</h3>
                    <p class="text-gray-400 mt-2">Saat ini belum ada kursus yang tersedia. Silakan cek kembali nanti.</p>
                </div>
            @else
                <!-- Daftar Kursus -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($courses as $course)
                        <div class="premium-card rounded-xl overflow-hidden flex flex-col">
                            <img src="https://placehold.co/400x200/10b981/050807?text={{ urlencode($course->category) }}" class="w-full h-40 object-cover" alt="Thumbnail Kursus">
                            <div class="p-5 flex flex-col flex-1">
                                <div class="flex justify-between items-center mb-2">
                                    <p class="text-sm text-green-400 font-medium">{{ $course->category }}</p>
                                    <p class="text-xs font-semibold text-gray-400 bg-gray-700/60 px-2 py-1 rounded-full">{{ $course->difficulty }}</p>
                                </div>
                                <h4 class="font-semibold text-lg text-white">{{ $course->title }}</h4>
                                <p class="text-gray-400 text-sm mt-2 flex-1">{{ Str::limit($course->description, 100) }}</p>
                                
                                @if($course->modules->isNotEmpty() && $course->modules->first()->lessons->isNotEmpty())
                                    <a href="{{ route('courses.show', $course->slug) }}" 
   class="w-full mt-5 text-center bg-gray-700 text-white font-semibold py-2 px-5 rounded-md hover:bg-green-500 hover:text-black transition-all text-sm">
   Lihat Detail
</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                 <!-- Pagination -->
                <div class="mt-10">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
