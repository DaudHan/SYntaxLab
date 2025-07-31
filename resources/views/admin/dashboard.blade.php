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
                   <p class="text-2xl font-bold text-white mt-1">{{ $newUsersLast30Days }}</p>

                </div>
                <div class="premium-card p-5 rounded-xl">
                    <p class="text-sm text-gray-400">Tingkat Keterlibatan</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $engagementRate }}%</p>

                </div>
            </div>

            <div class="mt-10">
                <h3 class="text-xl font-bold text-white mb-4">Aktivitas Terbaru</h3>
                <div class="premium-card p-6 rounded-xl overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-800/50">
            <tr>
                <th class="p-4 font-semibold">Nama</th>
                <th class="p-4 font-semibold">Email</th>
                <th class="p-4 font-semibold">Terakhir Aktif</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentActiveUsers as $user)
                <tr class="border-b border-gray-800/60 hover:bg-gray-800/40">
                    <td class="p-4 font-medium text-white">{{ $user->name }}</td>
                    <td class="p-4 text-gray-400">{{ $user->email }}</td>
                    <td class="p-4 text-gray-400">{{ $user->updated_at->diffForHumans() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center p-8 text-gray-400">Tidak ada aktivitas pengguna terbaru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

            </div>

        </div>
    </div>
</x-app-layout>
