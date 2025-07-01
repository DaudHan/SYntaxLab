<div>
    <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Judul Pelajaran</label>
    <input type="text" id="title" name="title" value="{{ old('title', $lesson->title ?? '') }}" required autofocus
           class="w-full bg-gray-800/80 border @error('title') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>

<!-- Tipe Konten -->
<div>
    <label for="content_type" class="block text-sm font-medium text-gray-300 mb-1">Tipe Konten</label>
    <select id="content_type" name="content_type" required class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
        <option value="TEXT" @selected(old('content_type', $lesson->content_type ?? '') == 'TEXT')>Teks/Materi</option>
        <option value="QUIZ" @selected(old('content_type', $lesson->content_type ?? '') == 'QUIZ')>Kuis</option>
        <option value="PROJECT" @selected(old('content_type', $lesson->content_type ?? '') == 'PROJECT')>Proyek</option>
    </select>
</div>

<!-- Isi Konten (jika Teks) -->
<div>
    <label for="content" class="block text-sm font-medium text-gray-300 mb-1">Isi Konten (jika Teks)</label>
    <textarea id="content" name="content" rows="10" class="w-full bg-gray-800/80 border @error('content') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('content', $lesson->content ?? '') }}</textarea>
    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tipe konten adalah Kuis atau Proyek.</p>
</div>

<!-- Tombol Aksi -->
<div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800/60">
     <a href="{{ route('admin.courses.edit', $lesson->module->course_id ?? $module->course_id) }}" class="text-sm text-gray-400 hover:text-white">Batal</a>
     <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
        Simpan Pelajaran
    </button>
</div>