<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Kursus Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <p class="text-gray-400">Daftar semua kursus yang telah dan sedang Anda ikuti.</p>
            </div>

            <!-- Filter (Sekarang Fungsional) -->
            <div class="flex items-center gap-2 mb-8">
                <a href="{{ route('my-courses', ['status' => 'all']) }}" class="{{ ($status ?? 'all') === 'all' ? 'bg-green-500/10 text-green-400 font-semibold' : 'bg-gray-700/30 text-gray-400 hover:bg-gray-700/60 hover:text-white font-medium' }} text-sm px-4 py-2 rounded-md transition-colors">Semua</a>
                <a href="{{ route('my-courses', ['status' => 'in-progress']) }}" class="{{ ($status ?? 'all') === 'in-progress' ? 'bg-green-500/10 text-green-400 font-semibold' : 'bg-gray-700/30 text-gray-400 hover:bg-gray-700/60 hover:text-white font-medium' }} text-sm px-4 py-2 rounded-md transition-colors">Sedang Diikuti</a>
                <a href="{{ route('my-courses', ['status' => 'completed']) }}" class="{{ ($status ?? 'all') === 'completed' ? 'bg-green-500/10 text-green-400 font-semibold' : 'bg-gray-700/30 text-gray-400 hover:bg-gray-700/60 hover:text-white font-medium' }} text-sm px-4 py-2 rounded-md transition-colors">Selesai</a>
            </div>
            
            @if($courses->isEmpty())
                <div class="text-center p-12 premium-card rounded-xl">
                    <h3 class="text-xl font-bold text-white">Tidak Ada Kursus di Kategori Ini</h3>
                    <p class="text-gray-400 mt-2">Coba lihat di filter lain atau telusuri kursus baru.</p>
                    <a href="{{ route('courses.index') }}" class="mt-6 inline-block bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all">
                        Telusuri Kursus
                    </a>
                </div>
            @else
                <!-- Daftar Kursus -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($courses as $course)
                        <div class="premium-card rounded-xl overflow-hidden flex flex-col">
                            <img src="https://placehold.co/400x200/10b981/050807?text={{ urlencode($course->category) }}" class="w-full h-40 object-cover" alt="Thumbnail Kursus">
                            <div class="p-5 flex flex-col flex-1">
                                <p class="text-sm text-green-400 font-medium">{{ $course->category }}</p>
                                <h4 class="font-semibold text-lg text-white mt-1">{{ $course->title }}</h4>
                                
                                @php
                                    $progress = $course->getProgressPercentageFor(Auth::user());
                                @endphp

                                <div class="mt-4 mb-5 flex-1">
                                    <div class="flex items-center justify-between text-sm text-gray-400 mb-1">
                                        <span>Progres</span>
                                        <span>{{ $progress }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-700 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                    </div>
                                </div>

                                @if($course->modules->isNotEmpty() && $course->modules->first()->lessons->isNotEmpty())
                                    <a href="{{ route('courses.lesson', ['course' => $course->slug, 'lesson' => $course->modules->first()->lessons->first()->id]) }}" 
                                       class="w-full text-center bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all text-sm shadow-lg shadow-green-500/20">
                                       Lanjutkan Belajar
                                    </a>
                                @else
                                     <span class="w-full text-center bg-gray-700 text-gray-400 font-semibold py-2 px-5 rounded-md text-sm cursor-not-allowed">
                                       Belum Ada Pelajaran
                                     </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
