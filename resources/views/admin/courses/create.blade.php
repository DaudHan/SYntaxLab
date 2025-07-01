<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Tambah Kursus Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                <form method="POST" action="{{ route('admin.courses.store') }}" class="space-y-6">
                    @csrf

                    <!-- Judul Kursus -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Judul Kursus</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required autofocus
                               class="w-full bg-gray-800/80 border @error('title') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-300 mb-1">Kategori</label>
                        <input type="text" id="category" name="category" value="{{ old('category') }}" required
                               class="w-full bg-gray-800/80 border @error('category') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- Tingkat Kesulitan -->
                    <div>
                        <label for="difficulty" class="block text-sm font-medium text-gray-300 mb-1">Tingkat Kesulitan</label>
                        <select id="difficulty" name="difficulty" required class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="PEMULA" @selected(old('difficulty') == 'PEMULA')>Pemula</option>
                            <option value="MENENGAH" @selected(old('difficulty') == 'MENENGAH')>Menengah</option>
                            <option value="MAHIR" @selected(old('difficulty') == 'MAHIR')>Mahir</option>
                        </select>
                        <x-input-error :messages="$errors->get('difficulty')" class="mt-2" />
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Deskripsi</label>
                        <textarea id="description" name="description" rows="5" required class="w-full bg-gray-800/80 border @error('description') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800/60">
                         <a href="{{ route('admin.courses.index') }}" class="text-sm text-gray-400 hover:text-white">Batal</a>
                         <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            Simpan Kursus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
