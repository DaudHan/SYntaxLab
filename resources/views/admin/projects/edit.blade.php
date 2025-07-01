<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            Kelola Detail Proyek untuk: <span class="text-green-400">{{ $project->lesson->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Deskripsi / Instruksi Proyek -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Instruksi Proyek</label>
                        <textarea id="description" name="description" rows="10" required class="w-full bg-gray-800/80 border @error('description') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description', $project->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- URL Repositori Starter (Opsional) -->
                    <div>
                        <label for="repository_url" class="block text-sm font-medium text-gray-300 mb-1">URL Repositori Starter (Opsional)</label>
                        <input type="url" id="repository_url" name="repository_url" value="{{ old('repository_url', $project->repository_url) }}"
                               class="w-full bg-gray-800/80 border @error('repository_url') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('repository_url')" class="mt-2" />
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800/60">
                         <a href="{{ route('admin.courses.edit', $project->lesson->module->course_id) }}" class="text-sm text-gray-400 hover:text-white">Kembali ke Manajemen Kursus</a>
                         <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            Simpan Detail Proyek
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
