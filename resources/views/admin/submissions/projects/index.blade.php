<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Tinjau Kiriman Proyek') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <p class="text-gray-400">Daftar semua proyek yang dikirimkan oleh siswa untuk dinilai.</p>
            </div>

            <!-- Tabel Kiriman Proyek -->
            <div class="premium-card rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th class="p-4 font-semibold">Siswa</th>
                                <th class="p-4 font-semibold">Pelajaran Proyek</th>
                                <th class="p-4 font-semibold">Tanggal Kirim</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($submissions as $submission)
                                <tr class="border-b border-gray-800/60 hover:bg-gray-800/40">
                                    <td class="p-4 font-medium text-white">{{ $submission->user->name }}</td>
                                    <td class="p-4 text-gray-400">{{ $submission->lesson->title }}</td>
                                    <td class="p-4 text-gray-400">{{ $submission->created_at->format('d M Y, H:i') }}</td>
                                    <td class="p-4">
                                        @php
                                            $statusClass = match($submission->status) {
                                                'APPROVED' => 'bg-green-500/10 text-green-400',
                                                'REVISION' => 'bg-red-500/10 text-red-400',
                                                default => 'bg-yellow-500/10 text-yellow-400',
                                            };
                                        @endphp
                                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $statusClass }}">
                                            {{ $submission->status }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('admin.projects.submissions.show', $submission) }}" class="text-green-400 hover:text-green-300 font-semibold text-sm">
            Tinjau
        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-8 text-gray-400">Tidak ada kiriman proyek yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

             <!-- Pagination -->
            <div class="mt-8">
                {{ $submissions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
