<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Edit Modul') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                <form method="POST" action="{{ route('admin.modules.update', $module) }}">
                    @csrf
                    @method('PUT')

                    <!-- Judul Modul -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Judul Modul</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $module->title) }}" required autofocus
                               class="w-full bg-gray-800/80 border @error('title') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-4 pt-6">
                         <a href="{{ route('admin.courses.edit', $module->course_id) }}" class="text-sm text-gray-400 hover:text-white">Batal</a>
                         <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            Perbarui Modul
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
