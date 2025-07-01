<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            Tinjau Proyek: <span class="text-green-400">{{ $submission->lesson->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kolom Kiri - Detail & Form Penilaian -->
                <div class="lg:col-span-2">
                    <div class="premium-card p-6 sm:p-8 rounded-xl">
                        <h3 class="text-lg font-bold text-white">Detail Kiriman</h3>
                        <div class="mt-4 space-y-4 text-sm">
                            <p><span class="text-gray-400 w-24 inline-block">Siswa</span>: <span class="font-semibold text-white">{{ $submission->user->name }}</span></p>
                            <p><span class="text-gray-400 w-24 inline-block">Kursus</span>: <span class="font-semibold text-white">{{ $submission->lesson->module->course->title }}</span></p>
                            <p><span class="text-gray-400 w-24 inline-block">Pelajaran</span>: <span class="font-semibold text-white">{{ $submission->lesson->title }}</span></p>
                            <p><span class="text-gray-400 w-24 inline-block">Dikirim</span>: <span class="font-semibold text-white">{{ $submission->created_at->format('d M Y, H:i') }}</span></p>
                            <div class="flex items-start"><span class="text-gray-400 w-24 inline-block shrink-0">Repo URL</span>: <a href="{{ $submission->repository_url }}" target="_blank" class="font-semibold text-green-400 hover:text-green-300 break-all">{{ $submission->repository_url }}</a></div>
                            <div class="flex items-start"><span class="text-gray-400 w-24 inline-block shrink-0">Demo URL</span>: <a href="{{ $submission->demo_url }}" target="_blank" class="font-semibold text-green-400 hover:text-green-300 break-all">{{ $submission->demo_url }}</a></div>
                        </div>

                        <!-- Form Penilaian -->
                        <form method="POST" action="{{ route('admin.projects.submissions.update', $submission) }}" class="mt-8 pt-6 border-t border-gray-800/60 space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <h3 class="text-lg font-bold text-white">Formulir Penilaian</h3>
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status Penilaian</label>
                                <select id="status" name="status" required class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="APPROVED" @selected(old('status', $submission->status) == 'APPROVED')>Disetujui (Approved)</option>
                                    <option value="REVISION" @selected(old('status', $submission->status) == 'REVISION')>Minta Revisi (Revision)</option>
                                </select>
                            </div>

                            <div>
                                <label for="feedback" class="block text-sm font-medium text-gray-300 mb-1">Umpan Balik / Feedback (Opsional)</label>
                                <textarea id="feedback" name="feedback" rows="5" class="w-full bg-gray-800/80 border rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('feedback', $submission->feedback) }}</textarea>
                            </div>

                            <div class="flex items-center justify-end gap-4">
                                 <a href="{{ route('admin.projects.submissions.index') }}" class="text-sm text-gray-400 hover:text-white">Kembali</a>
                                 <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                                    Simpan Penilaian
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Kolom Kanan - Instruksi Proyek -->
                <div class="lg:col-span-1">
                    <div class="premium-card p-6 rounded-xl sticky top-24">
                        <h3 class="text-lg font-bold text-white">Instruksi Proyek</h3>
                        <div class="mt-4 text-sm text-gray-400 prose prose-invert max-w-none">
                            {!! nl2br(e($submission->lesson->project->description)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
