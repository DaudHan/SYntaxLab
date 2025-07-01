<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Pengaturan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-500/10 text-green-400 text-sm p-4 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-10">
                    <!-- Pengaturan Umum -->
                    <div class="premium-card rounded-xl">
                        <div class="p-6 border-b border-gray-800/60">
                            <h3 class="text-lg font-bold text-white">Pengaturan Umum</h3>
                            <p class="text-sm text-gray-400 mt-1">Konfigurasi dasar untuk platform Anda.</p>
                        </div>
                        <div class="p-6 space-y-6">
                             <div>
                                <label for="site_name" class="block text-sm font-medium text-gray-300 mb-1">Nama Situs</label>
                                <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'SyntaxLab') }}" class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>
                    </div>

                    <!-- Notifikasi -->
                    <div class="premium-card rounded-xl">
                         <div class="p-6 border-b border-gray-800/60">
                            <h3 class="text-lg font-bold text-white">Notifikasi</h3>
                            <p class="text-sm text-gray-400 mt-1">Atur notifikasi email yang dikirim ke pengguna.</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-white">Email Selamat Datang</p>
                                    <p class="text-sm text-gray-400">Kirim email saat pengguna baru mendaftar.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="welcome_notification" class="sr-only peer" @checked(old('welcome_notification', $settings['welcome_notification'] ?? '1') === '1')>
                                    <div class="w-11 h-6 bg-gray-600 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                </label>
                            </div>
                             <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-white">Notifikasi Penyelesaian Kursus</p>
                                    <p class="text-sm text-gray-400">Kirim email saat pengguna menyelesaikan sebuah kursus.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="completion_notification" class="sr-only peer" @checked(old('completion_notification', $settings['completion_notification'] ?? '1') === '1')>
                                    <div class="w-11 h-6 bg-gray-600 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <!-- Tombol Simpan -->
                <div class="mt-8 pt-6 border-t border-gray-800/60 flex justify-end">
                    <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-6 rounded-md hover:bg-green-400 transition-all text-sm shadow-lg shadow-green-500/20">Simpan Pengaturan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
