<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tombol Tambah Pengguna -->
            <div class="flex justify-end mb-6">
                 <a href="#" class="w-full md:w-auto bg-green-500 text-black font-semibold py-2.5 px-4 rounded-md hover:bg-green-400 transition-all text-sm shadow-lg shadow-green-500/20 flex items-center gap-2 justify-center">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Tambah Pengguna
                </a>
            </div>

            {{-- Menampilkan pesan sukses atau error setelah aksi --}}
            @if(session('success'))
                <div class="bg-green-500/10 text-green-400 text-sm p-4 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500/10 text-red-400 text-sm p-4 rounded-xl mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tabel Pengguna -->
            <div class="premium-card rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th class="p-4 font-semibold">Nama</th>
                                <th class="p-4 font-semibold">Email</th>
                                <th class="p-4 font-semibold">Peran</th>
                                <th class="p-4 font-semibold">Tanggal Bergabung</th>
                                <th class="p-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b border-gray-800/60 hover:bg-gray-800/40">
                                    <td class="p-4 flex items-center gap-3">
                                        <img src="{{ $user->avatar_url ?? 'https://placehold.co/32x32/0c1010/a3e635?text=' . substr($user->name, 0, 1) }}" class="w-8 h-8 rounded-full">
                                        <span class="font-medium text-white">{{ $user->name }}</span>
                                    </td>
                                    <td class="p-4 text-gray-400">{{ $user->email }}</td>
                                    <td class="p-4">
                                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $user->role === 'ADMIN' ? 'bg-green-500/10 text-green-400' : 'bg-gray-500/10 text-gray-300' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="p-4 text-center space-x-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="inline-block text-gray-400 hover:text-white p-1" title="Edit Pengguna">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                        </a>
                                        
                                        {{-- Fungsikan tombol hapus dengan form --}}
                                        @if(Auth::user()->id !== $user->id) {{-- Sembunyikan tombol hapus untuk diri sendiri --}}
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 p-1" title="Hapus Pengguna">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-8 text-gray-400">Tidak ada pengguna yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

             <!-- Pagination -->
            <div class="mt-8">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
