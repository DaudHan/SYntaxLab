<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Kelola Kursus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tombol Tambah Kursus -->
            <div class="flex justify-end mb-6">
                 <a href="{{ route('admin.courses.create') }}" class="w-full md:w-auto bg-green-500 text-black font-semibold py-2.5 px-4 rounded-md hover:bg-green-400 transition-all text-sm shadow-lg shadow-green-500/20 flex items-center gap-2 justify-center">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Tambah Kursus
                </a>
            </div>
            
            <!-- Pesan Sukses -->
            @if(session('success'))
                <div class="bg-green-500/10 text-green-400 text-sm p-4 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulir Pencarian & Filter -->
            <form method="GET" action="{{ route('admin.courses.index') }}">
                <div class="flex flex-col md:flex-row items-center gap-4 mb-6">
                    <div class="relative w-full md:flex-1">
                        <input type="text" name="search" placeholder="Cari kursus..." value="{{ request('search') }}" class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 pl-10 pr-4 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                    </div>
                    <select name="category" class="w-full md:w-auto bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" @selected(request('category') == $category)>{{ $category }}</option>
                        @endforeach
                    </select>
                    <select name="status" class="w-full md:w-auto bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Semua Status</option>
                        <option value="DIPUBLIKASIKAN" @selected(request('status') == 'DIPUBLIKASIKAN')>Dipublikasikan</option>
                        <option value="DRAF" @selected(request('status') == 'DRAF')>Draf</option>
                    </select>
                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="w-full md:w-auto bg-green-500 text-black font-semibold py-2.5 px-4 rounded-md hover:bg-green-400 transition-all text-sm">Filter</button>
                        <a href="{{ route('admin.courses.index') }}" class="w-full md:w-auto bg-gray-700 text-white text-center font-semibold py-2.5 px-4 rounded-md hover:bg-gray-600 transition-all text-sm">Reset</a>
                    </div>
                </div>
            </form>

            <!-- Tabel Kursus -->
            <div class="premium-card rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th class="p-4 font-semibold">Judul Kursus</th>
                                <th class="p-4 font-semibold">Kategori</th>
                                <th class="p-4 font-semibold">Siswa</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses as $course)
                                <tr class="border-b border-gray-800/60 hover:bg-gray-800/40">
                                    <td class="p-4 font-medium text-white">{{ $course->title }}</td>
                                    <td class="p-4 text-gray-400">{{ $course->category }}</td>
                                    <td class="p-4 text-gray-400">{{ $course->users_count }}</td>
                                    <td class="p-4">
                                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $course->status === 'DIPUBLIKASIKAN' ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-400' }}">
                                            {{ $course->status }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center space-x-2">
                                        <a href="{{ route('admin.courses.edit', $course) }}" class="inline-block text-gray-400 hover:text-white p-1" title="Edit Kursus">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kursus ini? Tindakan ini tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 p-1" title="Hapus Kursus">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-8 text-gray-400">Tidak ada kursus yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

             <!-- Pagination -->
            <div class="mt-8">
                {{ $courses->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
