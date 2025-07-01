<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Edit Pengguna: ') }} <span class="text-green-400">{{ $user->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                    @csrf
                    @method('PUT') {{-- Beritahu Laravel bahwa ini adalah request UPDATE --}}

                    <!-- Nama Pengguna -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full bg-gray-800/80 border @error('name') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full bg-gray-800/80 border @error('email') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Peran (Role) -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-300 mb-1">Peran</label>
                        <select id="role" name="role" required class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="USER" @selected(old('role', $user->role) == 'USER')>Pengguna</option>
                            <option value="ADMIN" @selected(old('role', $user->role) == 'ADMIN')>Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800/60">
                         <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-400 hover:text-white">Batal</a>
                         <button type="submit" class="bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            Perbarui Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
