<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SyntaxLab') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        
        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
             /* Animasi untuk menu burger */
            #menu-toggle.is-active span:nth-child(1) { transform: translateY(6px) rotate(45deg); }
            #menu-toggle.is-active span:nth-child(2) { opacity: 0; }
            #menu-toggle.is-active span:nth-child(3) { transform: translateY(-6px) rotate(-45deg); }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="main-wrapper relative lg:flex lg:h-screen lg:overflow-hidden">
            <!-- Sidebar -->
            <aside id="sidebar" class="w-64 bg-[#0c1010] flex-col flex shrink-0 fixed inset-y-0 left-0 z-30 lg:relative lg:translate-x-0 -translate-x-full transition-transform duration-300 ease-in-out border-r border-gray-800/60">
                @include('layouts.navigation')
            </aside>
            <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-20 lg:hidden hidden"></div>

            <!-- Area Konten Utama -->
            <div class="flex-1 flex flex-col overflow-y-auto">
                <div class="max-w-7xl mx-auto w-full">
                    @if (isset($header))
                        <header class="p-4 sm:px-8 h-20 flex items-center justify-between shrink-0">
                            <!-- Grup Kiri: Tombol Menu & Judul Halaman -->
                            <div class="flex items-center gap-4">
                                <button id="menu-toggle" class="lg:hidden text-gray-400 hover:text-white w-8 h-8 flex flex-col justify-center items-center space-y-1 z-50">
                                    <span class="block w-5 h-0.5 bg-current transform transition duration-300 ease-in-out"></span>
                                    <span class="block w-5 h-0.5 bg-current transition duration-300 ease-in-out"></span>
                                    <span class="block w-5 h-0.5 bg-current transform transition duration-300 ease-in-out"></span>
                                </button>
                                <div>
                                    {{ $header }}
                                </div>
                            </div>
                           
                            <!-- Grup Kanan: Notifikasi & Tombol Aksi -->
                            <div class="flex items-center gap-2 sm:gap-4">
                                <!-- Tombol Notifikasi (Fungsional Penuh) -->
                                <div x-data="{ open: false }" class="relative">
                                    <button @click="open = !open" class="relative text-gray-400 hover:text-white transition-colors p-2 rounded-full hover:bg-gray-700/50">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                                        @if(Auth::user() && Auth::user()->unreadNotifications->isNotEmpty())
                                            <span class="absolute top-1 right-1 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                                        @endif
                                    </button>
                                    
                                    <!-- Dropdown Notifikasi -->
                                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-[#1c1f24] border border-gray-700 rounded-xl shadow-lg z-20">
                                        <div class="p-4 font-bold text-white border-b border-gray-700">Notifikasi</div>
                                        <div class="py-2 max-h-96 overflow-y-auto">
                                            @if(Auth::user())
                                                @forelse (Auth::user()->notifications->take(10) as $notification)
                                                    @if(isset($notification->data['course_slug']) && isset($notification->data['lesson_id']))
                                                        <a href="{{ route('courses.lesson', ['course' => $notification->data['course_slug'], 'lesson' => $notification->data['lesson_id']]) }}" 
                                                           class="block px-4 py-3 hover:bg-gray-700/50 transition-colors {{ !$notification->read_at ? 'bg-green-500/5' : '' }}">
                                                            <p class="text-white text-sm">{{ $notification->data['message'] }}</p>
                                                            <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                                        </a>
                                                    @else
                                                        <div class="block px-4 py-3 {{ !$notification->read_at ? 'bg-green-500/5' : '' }}">
                                                            <p class="text-white text-sm">{{ $notification->data['message'] }}</p>
                                                            <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                                        </div>
                                                    @endif
                                                @empty
                                                    <p class="text-sm text-gray-500 text-center py-4">Tidak ada notifikasi baru.</p>
                                                @endforelse
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Tombol ini sekarang disembunyikan di layar yang sangat kecil (sm) --}}
                                <a href="{{ route ('courses.index')}}" class="hidden sm:inline-flex bg-green-500 text-black font-semibold py-2 px-4 rounded-md hover:bg-green-400 transition-all text-sm shadow-lg shadow-green-500/20">Telusuri Kursus</a>
                            </div>
                        </header>
                    @endif
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const menuToggle = document.getElementById('menu-toggle');
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                
                function toggleMenu() {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                    menuToggle.classList.toggle('is-active');
                }

                if (menuToggle && sidebar && overlay) {
                    menuToggle.addEventListener('click', (e) => {
                        e.stopPropagation();
                        toggleMenu();
                    });
                    overlay.addEventListener('click', toggleMenu);
                }
            });
        </script>
    </body>
</html>
