<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Papan Peringkat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <p class="text-gray-400">Lihat posisimu di antara para pembelajar hebat lainnya.</p>
            </div>
            
            <!-- Filter (Sekarang Fungsional) -->
            <div class="flex items-center gap-2 mb-8">
                <a href="{{ route('leaderboard.index', ['filter' => 'global']) }}" class="{{ $filter === 'global' ? 'bg-green-500/10 text-green-400 font-semibold' : 'bg-gray-700/30 text-gray-400 hover:bg-gray-700/60 hover:text-white font-medium' }} text-sm px-4 py-2 rounded-md transition-colors">Global</a>
                <a href="{{ route('leaderboard.index', ['filter' => 'weekly']) }}" class="{{ $filter === 'weekly' ? 'bg-green-500/10 text-green-400 font-semibold' : 'bg-gray-700/30 text-gray-400 hover:bg-gray-700/60 hover:text-white font-medium' }} text-sm px-4 py-2 rounded-md transition-colors">Mingguan</a>
            </div>

            <!-- Tabel Papan Peringkat -->
            <div class="premium-card rounded-xl p-6">
                <div class="space-y-2">
                    @forelse ($rankedUsers as $index => $user)
                        @php $rank = $index + 1; @endphp
                        
                        <div class="flex items-center p-4 rounded-lg
                            @if($user->id === $currentUser->id) 
                                bg-green-500/10 border border-green-500/50 
                            @else 
                                hover:bg-gray-800/50 
                            @endif">
                            
                            {{-- Peringkat & Lencana --}}
                            <div class="w-12 text-center">
                                @if($rank === 1)
                                    <span class="text-2xl">🥇</span>
                                @elseif($rank === 2)
                                    <span class="text-2xl">🥈</span>
                                @elseif($rank === 3)
                                    <span class="text-2xl">🥉</span>
                                @else
                                    <span class="font-bold text-lg text-gray-400">#{{ $rank }}</span>
                                @endif
                            </div>

                            {{-- Info Pengguna --}}
                            <img src="{{ $user->avatar_url ?? 'https://placehold.co/40x40/050807/a3e635?text=' . substr($user->name, 0, 1) }}" alt="Avatar Pengguna" class="w-10 h-10 rounded-full mx-4">
                            <span class="font-semibold text-white flex-1">{{ $user->name }}</span>

                            {{-- Poin XP --}}
                            <span class="font-bold text-green-400">{{ number_format($user->xp_points, 0, ',', '.') }} XP</span>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Papan peringkat kosong untuk periode ini.</p>
                    @endforelse
                </div>
            </div>

            {{-- Menampilkan peringkat pengguna jika tidak masuk 100 besar --}}
            @if($currentUser->rank > 100)
            <div class="mt-8 text-center p-4 premium-card rounded-xl">
                 <p class="text-gray-400">Peringkat Anda saat ini: <span class="font-bold text-white">#{{ $currentUser->rank }}</span> dengan <span class="font-bold text-white">{{ number_format($filter === 'weekly' ? ($currentUser->weeklyXp->xp_earned ?? 0) : $currentUser->xp_points, 0, ',', '.') }} XP</span>. Teruslah belajar!</p>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
