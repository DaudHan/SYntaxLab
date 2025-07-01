<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <p class="text-gray-400">Selamat datang di pusat kendali SyntaxLab.</p>
            </div>
            
            {{-- Bagian Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="premium-card p-5 rounded-xl">
                    <p class="text-sm text-gray-400">Total Pengguna</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $totalUsers }}</p>
                </div>
                <div class="premium-card p-5 rounded-xl">
                    <p class="text-sm text-gray-400">Total Kursus</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $totalCourses }}</p>
                </div>
                <div class="premium-card p-5 rounded-xl">
                    <p class="text-sm text-gray-400">Pendaftaran Baru (30 hari)</p>
                    <p class="text-2xl font-bold text-white mt-1">150</p> {{-- Data statis untuk saat ini --}}
                </div>
                <div class="premium-card p-5 rounded-xl">
                    <p class="text-sm text-gray-400">Tingkat Keterlibatan</p>
                    <p class="text-2xl font-bold text-white mt-1">85%</p> {{-- Data statis untuk saat ini --}}
                </div>
            </div>

            <div class="mt-10">
                <h3 class="text-xl font-bold text-white mb-4">Aktivitas Terbaru</h3>
                <div class="premium-card p-6 rounded-xl">
                    <p class="text-gray-400">Tabel aktivitas pengguna atau kursus terbaru akan ditampilkan di sini.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
