<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - SyntaxLabs</title>
    
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
                    <h1>Kebijakan Privasi</h1>
                    <p class="text-sm text-gray-500">Terakhir diperbarui: 30 Juni 2025</p>
                    
                    <p>Selamat datang di SyntaxLab. Kami menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi Anda. Kebijakan Privasi ini akan menginformasikan Anda tentang bagaimana kami mengelola data pribadi Anda saat Anda mengunjungi situs web kami.</p>

                    <h2>Informasi yang Kami Kumpulkan</h2>
                    <p>Kami dapat mengumpulkan, menggunakan, menyimpan, dan mentransfer berbagai jenis data pribadi tentang Anda sebagai berikut:</p>
                    <ul>
                        <li><strong>Data Identitas:</strong> termasuk nama depan, nama belakang, dan nama pengguna.</li>
                        <li><strong>Data Kontak:</strong> termasuk alamat email.</li>
                        <li><strong>Data Teknis:</strong> termasuk alamat protokol internet (IP), data login Anda, jenis dan versi browser.</li>
                        <li><strong>Data Profil:</strong> termasuk password Anda (terenkripsi), kursus yang Anda ikuti, progres belajar, dan poin XP.</li>
                        <li><strong>Data Penggunaan:</strong> termasuk informasi tentang bagaimana Anda menggunakan situs web kami.</li>
                    </ul>

                    <h2>Bagaimana Kami Menggunakan Informasi Anda</h2>
                    <p>Kami akan menggunakan data pribadi Anda hanya jika diizinkan oleh hukum. Umumnya, kami akan menggunakan data pribadi Anda dalam keadaan berikut:</p>
                    <ul>
                        <li>Untuk menyediakan dan memelihara layanan kami, termasuk untuk memantau penggunaan layanan kami.</li>
                        <li>Untuk mengelola Akun Anda: untuk mengelola pendaftaran Anda sebagai pengguna layanan.</li>
                        <li>Untuk menghubungi Anda: untuk menghubungi Anda melalui email mengenai pembaruan atau komunikasi informatif yang berkaitan dengan fungsionalitas, produk, atau layanan yang dikontrak.</li>
                        <li>Untuk tujuan lain: seperti analisis data, mengidentifikasi tren penggunaan, dan untuk mengevaluasi serta meningkatkan layanan kami.</li>
                    </ul>

                    <h2>Hubungi Kami</h2>
                    <p>Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini, Anda dapat menghubungi kami melalui email di: <a href="mailto:privacy@syntaxlab.com">privacy@syntaxlab.com</a>.</p>
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
                <a href="{{ route('terms.of.service')}}" class="text-gray-400 hover:text-white">Ketentuan</a>
             </div>
        </div>
    </footer>
</div>
</body>
</html>
