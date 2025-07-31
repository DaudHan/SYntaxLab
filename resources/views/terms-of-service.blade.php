<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketentuan Layanan - SyntaxLab</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased">
<div class="main-wrapper">
    <!-- Header -->
    <header class="sticky top-0 z-30 backdrop-blur-lg border-b border-gray-800/60">
        <nav class="max-w-7xl mx-auto px-4 sm:px-8 h-20 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <svg class="w-7 h-7 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
                <h1 class="text-xl font-bold text-white">SyntaxLab</h1>
            </a>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white font-medium hover:text-green-400 transition-colors text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white font-medium hover:text-green-400 transition-colors text-sm">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-green-500 text-black font-semibold py-2 px-4 rounded-md hover:bg-green-400 transition-all text-sm shadow-lg shadow-green-500/20">Daftar Gratis</a>
                    @endif
                @endauth
            </div>
        </nav>
    </header>

    <!-- Konten Utama -->
    <main class="py-16 sm:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card rounded-xl p-8 sm:p-12">
                <div class="prose prose-invert max-w-none prose-p:text-gray-400 prose-headings:text-white prose-a:text-green-400 hover:prose-a:text-green-300">
                    <h1>Ketentuan Layanan</h1>
                    <p class="text-sm text-gray-500">Terakhir diperbarui: 30 Juni 2025</p>
                    
                    <p>Selamat datang di SyntaxLab. Ketentuan Layanan ini mengatur penggunaan Anda atas situs web kami yang berlokasi di SyntaxLab.com dan layanan apa pun yang terkait.</p>

                    <h2>1. Akun Pengguna</h2>
                    <p>Saat Anda membuat akun dengan kami, Anda harus memberikan informasi yang akurat, lengkap, dan terkini setiap saat. Kegagalan untuk melakukannya merupakan pelanggaran terhadap Ketentuan, yang dapat mengakibatkan penghentian segera akun Anda di layanan kami. Anda bertanggung jawab untuk menjaga kerahasiaan kata sandi Anda.</p>
                    
                    <h2>2. Konten</h2>
                    <p>Layanan kami memungkinkan Anda untuk memposting, menautkan, menyimpan, membagikan, dan menyediakan informasi, teks, grafik, video, atau materi lainnya ("Konten"). Anda bertanggung jawab atas Konten yang Anda posting di Layanan, termasuk legalitas, keandalan, dan kepantasannya.</p>

                    <h2>3. Penghentian</h2>
                    <p>Kami dapat menghentikan atau menangguhkan akun Anda segera, tanpa pemberitahuan atau kewajiban sebelumnya, untuk alasan apa pun, termasuk tanpa batasan jika Anda melanggar Ketentuan.</p>

                    <h2>4. Perubahan pada Layanan</h2>
                    <p>Kami berhak untuk menarik atau mengubah Layanan kami, dan materi apa pun yang kami sediakan melalui Layanan, atas kebijakan kami sendiri tanpa pemberitahuan. Kami tidak akan bertanggung jawab jika karena alasan apa pun semua atau sebagian dari Layanan tidak tersedia kapan saja atau untuk periode apa pun.</p>

                    <h2>Hubungi Kami</h2>
                    <p>Jika Anda memiliki pertanyaan tentang Ketentuan ini, Anda dapat menghubungi kami melalui email di: <a href="mailto:terms@syntaxlab.com">terms@syntaxlab.com</a>.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-800/60 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 flex flex-col sm:flex-row justify-between items-center gap-4">
             <p class="text-sm text-gray-500">&copy; 2025 SyntaxLab. Semua Hak Cipta Dilindungi.</p>
             <div class="flex gap-6">
                <a href="{{ route('privacy.policy') }}" class="text-gray-400 hover:text-white">Privasi</a>
                <a href="{{ route('terms.of.service') }}" class="text-gray-400 hover:text-white">Ketentuan</a>
             </div>
        </div>
    </footer>
</div>
</body>
</html>
