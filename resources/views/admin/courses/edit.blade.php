<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            Manajemen Kursus: <span class="text-green-400">{{ $course->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Form Edit Detail Kursus -->
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                <h3 class="text-lg font-bold text-white mb-4">Detail Kursus</h3>
                <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    {{-- Judul Kursus --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Judul Kursus</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $course->title) }}" required class="w-full bg-gray-800/80 border @error('title') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                         <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- Kategori --}}
                     <div>
                        <label for="category" class="block text-sm font-medium text-gray-300 mb-1">Kategori</label>
                        <input type="text" id="category" name="category" value="{{ old('category', $course->category) }}" required class="w-full bg-gray-800/80 border @error('category') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>
                    
                    {{-- Tingkat Kesulitan & Status --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="difficulty" class="block text-sm font-medium text-gray-300 mb-1">Tingkat Kesulitan</label>
                            <select id="difficulty" name="difficulty" required class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="PEMULA" @selected(old('difficulty', $course->difficulty) == 'PEMULA')>Pemula</option>
                                <option value="MENENGAH" @selected(old('difficulty', $course->difficulty) == 'MENENGAH')>Menengah</option>
                                <option value="MAHIR" @selected(old('difficulty', $course->difficulty) == 'MAHIR')>Mahir</option>
                            </select>
                        </div>
                         {{-- DROPDOWN BARU UNTUK STATUS --}}
                         <div>
                            <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                            <select id="status" name="status" required class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="DRAF" @selected(old('status', $course->status) == 'DRAF')>Draf</option>
                                <option value="DIPUBLIKASIKAN" @selected(old('status', $course->status) == 'DIPUBLIKASIKAN')>Dipublikasikan</option>
                            </select>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Deskripsi</label>
                        <textarea id="description" name="description" rows="5" required class="w-full bg-gray-800/80 border @error('description') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800/60">
                         <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            Perbarui Detail Kursus
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Bagian Manajemen Kurikulum -->
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                <h3 class="text-lg font-bold text-white mb-4">Manajemen Kurikulum</h3>
                
                @if(session('success'))
                    <div class="bg-green-500/10 text-green-400 text-sm p-4 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                
                <!-- Daftar Modul & Pelajaran -->
                <div class="space-y-6">
                    @forelse ($course->modules as $module)
                        <div class="p-4 bg-gray-800/50 rounded-lg">
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold text-white">{{ $module->order_index }}. {{ $module->title }}</h4>
                                <div class="space-x-2">
                                    <a href="{{ route('admin.modules.edit', $module) }}" class="text-gray-400 hover:text-white p-1 text-xs font-medium">Edit Modul</a>
                                    <form method="POST" action="{{ route('admin.modules.destroy', $module) }}" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus modul ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 p-1 text-xs font-medium">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            <ul class="mt-4 ml-4 space-y-2">
                                @forelse ($module->lessons as $lesson)
                                    <li class="text-sm text-gray-400 flex justify-between items-center">
                                        <span>- {{ $lesson->title }} ({{ $lesson->content_type }})</span>
                                        <div class="space-x-2">
                                            <a href="{{ route('admin.lessons.edit', $lesson) }}" class="text-gray-400 hover:text-white p-1 text-xs font-medium">Edit</a>
                                            <form method="POST" action="{{ route('admin.lessons.destroy', $lesson) }}" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pelajaran ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 p-1 text-xs font-medium">Hapus</button>
                                            </form>
                                        </div>
                                    </li>
                                @empty
                                    <li class="text-sm text-gray-500 italic">Belum ada pelajaran di modul ini.</li>
                                @endforelse
                            </ul>
                            <a href="{{ route('admin.lessons.create', $module) }}" class="text-sm text-green-400 hover:text-green-300 mt-4 inline-block font-semibold">+ Tambah Pelajaran</a>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">Belum ada modul di kursus ini.</p>
                    @endforelse
                </div>

                <!-- Form Tambah Modul Baru -->
                <div class="mt-8 pt-6 border-t border-gray-800/60">
                    <h4 class="font-semibold text-white mb-2">Tambah Modul Baru</h4>
                    <form method="POST" action="{{ route('admin.modules.store', $course) }}" class="flex items-center gap-4">
                        @csrf
                        <div class="flex-grow">
                            <input type="text" name="title" placeholder="Judul modul baru..." required
                                   class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
