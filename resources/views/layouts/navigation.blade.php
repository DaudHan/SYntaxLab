<!-- Logo -->
<div class="flex items-center gap-2 px-6 h-20 shrink-0">
    <a href="{{ Auth::user()->role === 'ADMIN' ? route('admin.dashboard') : route('dashboard') }}">
        <svg class="w-7 h-7 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
    </a>
    <a href="{{ Auth::user()->role === 'ADMIN' ? route('admin.dashboard') : route('dashboard') }}">
        <h1 class="text-xl font-bold text-white">SyntaxLab</h1>
        @if(Auth::user()->role === 'ADMIN')
            <span class="text-xs text-green-400">Admin</span>
        @endif
    </a>
</div>

<!-- Menu Navigasi Dinamis -->
<nav class="p-4 space-y-2 flex-1 overflow-y-auto">
    @if (Auth::user()->role === 'ADMIN')
        {{-- ======================== --}}
        {{-- === MENU UNTUK ADMIN === --}}
        {{-- ======================== --}}
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-green-500/10 text-white font-semibold' : 'text-gray-400 font-medium' }} flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700/30 transition-colors relative">
            @if(request()->routeIs('admin.dashboard'))
                <div class="absolute inset-y-2 left-0 w-1 bg-green-500 rounded-r-full"></div>
            @endif
            <span>Dashboard Admin</span>
        </a>
        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'bg-green-500/10 text-white font-semibold' : 'text-gray-400 font-medium' }} flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700/30 transition-colors relative">
            @if(request()->routeIs('admin.users.index'))
                <div class="absolute inset-y-2 left-0 w-1 bg-green-500 rounded-r-full"></div>
            @endif
            <span>Kelola Pengguna</span>
        </a>
        <a href="{{ route('admin.courses.index') }}" class="{{ request()->routeIs('admin.courses.index') ? 'bg-green-500/10 text-white font-semibold' : 'text-gray-400 font-medium' }} flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700/30 transition-colors relative">
            @if(request()->routeIs('admin.courses.index'))
                <div class="absolute inset-y-2 left-0 w-1 bg-green-500 rounded-r-full"></div>
            @endif
            <span>Kelola Kursus</span>
        </a>
        <a href="{{ route('admin.projects.submissions.index') }}" class="{{ request()->routeIs('admin.projects.submissions.index') ? 'bg-green-500/10 text-white font-semibold' : 'text-gray-400 font-medium' }} flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700/30 transition-colors relative">
            @if(request()->routeIs('admin.projects.submissions.index'))
                <div class="absolute inset-y-2 left-0 w-1 bg-green-500 rounded-r-full"></div>
            @endif
            <span>Tinjau Proyek</span>
        </a>
        <a href="{{ route('admin.analytics.index') }}" class="{{ request()->routeIs('admin.analytics.index') ? 'bg-green-500/10 text-white font-semibold' : 'text-gray-400 font-medium' }} flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700/30 transition-colors relative">
            @if(request()->routeIs('admin.analytics.index'))
                <div class="absolute inset-y-2 left-0 w-1 bg-green-500 rounded-r-full"></div>
            @endif
            <span>Analitik</span>
        </a>
        <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.index') ? 'bg-green-500/10 text-white font-semibold' : 'text-gray-400 font-medium' }} flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700/30 transition-colors relative">
            @if(request()->routeIs('admin.settings.index'))
                <div class="absolute inset-y-2 left-0 w-1 bg-green-500 rounded-r-full"></div>
            @endif
            <span>Pengaturan</span>
        </a>

    @else
        {{-- ========================= --}}
        {{-- === MENU UNTUK USER === --}}
        {{-- ========================= --}}
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-green-500/10 text-white font-semibold' : 'text-gray-400 font-medium' }} flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700/30 transition-colors relative">
            @if(request()->routeIs('dashboard'))
                <div class="absolute inset-y-2 left-0 w-1 bg-green-500 rounded-r-full"></div>
            @endif
            <span>Dashboard</span>
        </a>
        <a href="{{ route('my-courses') }}" class="{{ request()->routeIs('my-courses') ? 'bg-green-500/10 text-white font-semibold' : 'text-gray-400 font-medium' }} flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700/30 transition-colors relative">
             @if(request()->routeIs('my-courses'))
                <div class="absolute inset-y-2 left-0 w-1 bg-green-500 rounded-r-full"></div>
            @endif
            <span>Kursus Saya</span>
        </a>
        <a href="{{ route('courses.index') }}" class="{{ request()->routeIs('courses.index') ? 'bg-green-500/10 text-white font-semibold' : 'text-gray-400 font-medium' }} flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700/30 transition-colors relative">
             @if(request()->routeIs('courses.index'))
                <div class="absolute inset-y-2 left-0 w-1 bg-green-500 rounded-r-full"></div>
            @endif
            <span>Kursus Baru</span>
        </a>
        <a href="{{ route('leaderboard.index') }}" class="{{ request()->routeIs('leaderboard.index') ? 'bg-green-500/10 text-white font-semibold' : 'text-gray-400 font-medium' }} flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-700/30 transition-colors relative">
             @if(request()->routeIs('leaderboard.index'))
                <div class="absolute inset-y-2 left-0 w-1 bg-green-500 rounded-r-full"></div>
            @endif
            <span>Papan Peringkat</span>
        </a>
    @endif
</nav>

<!-- User Profile & Logout -->
<div class="p-4 border-t border-gray-800/60">
    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'bg-green-500/10' : '' }} flex items-center gap-3 hover:bg-gray-700/30 p-2 rounded-lg transition-colors mb-4">
        <img src="{{ Auth::user()->avatar_url ?? 'https://placehold.co/36x36/050807/a3e635?text=' . substr(Auth::user()->name, 0, 1) }}" alt="Avatar Pengguna" class="w-9 h-9 rounded-full">
        <div class="flex-1">
            <p class="font-semibold text-sm text-white">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-500">
                {{ Auth::user()->role === 'ADMIN' ? 'Super Admin' : 'Lihat Profil' }}
            </p>
        </div>
    </a>
     <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 text-red-400 hover:text-white hover:bg-red-500/10 font-medium px-4 py-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
            <span>Keluar</span>
        </button>
    </form>
</div>
