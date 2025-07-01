<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Analitik Platform') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <p class="text-gray-400">Wawasan mendalam tentang performa dan pertumbuhan SyntaxLab.</p>
            </div>

            <!-- Statistik Utama -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="premium-card p-5 rounded-xl"><p class="text-sm text-gray-400">Total Pengguna</p><p class="text-2xl font-bold text-white mt-1">{{ $totalUsers }}</p></div>
                <div class="premium-card p-5 rounded-xl"><p class="text-sm text-gray-400">Pengguna Aktif (30 Hari)</p><p class="text-2xl font-bold text-white mt-1">{{ $activeUsers }}</p></div>
                <div class="premium-card p-5 rounded-xl"><p class="text-sm text-gray-400">Total Kursus</p><p class="text-2xl font-bold text-white mt-1">{{ $totalCourses }}</p></div>
                <div class="premium-card p-5 rounded-xl"><p class="text-sm text-gray-400">Tingkat Keterlibatan</p><p class="text-2xl font-bold text-white mt-1">85%</p></div>
            </div>

            <!-- Grafik -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-10">
                <div class="premium-card rounded-xl p-6">
                    <h3 class="font-bold text-white mb-4">Pendaftaran Pengguna Baru</h3>
                    <div class="h-64 bg-gray-800/50 rounded-md flex items-center justify-center">
                        <p class="text-gray-500 text-sm">[Placeholder untuk Grafik Pendaftaran]</p>
                    </div>
                </div>
                 <div class="premium-card rounded-xl p-6">
                    <h3 class="font-bold text-white mb-4">Aktivitas Pengguna</h3>
                    <div class="h-64 bg-gray-800/50 rounded-md flex items-center justify-center">
                        <p class="text-gray-500 text-sm">[Placeholder untuk Grafik Aktivitas]</p>
                    </div>
                </div>
            </div>

            <!-- Tabel Kursus Terpopuler -->
            <div class="mt-10">
                <h3 class="text-xl font-bold text-white mb-4">Kursus Terpopuler</h3>
                <div class="premium-card rounded-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-800/50">
                                <tr>
                                    <th class="p-4 font-semibold">Judul Kursus</th>
                                    <th class="p-4 font-semibold">Kategori</th>
                                    <th class="p-4 font-semibold">Jumlah Siswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($popularCourses as $course)
                                    <tr class="border-b border-gray-800/60 hover:bg-gray-800/40">
                                        <td class="p-4 font-medium text-white">{{ $course->title }}</td>
                                        <td class="p-4 text-gray-400">{{ $course->category }}</td>
                                        <td class="p-4 text-gray-400">{{ $course->users_count }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center p-8 text-gray-400">Tidak ada data kursus.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
