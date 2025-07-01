<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyntaxLab - Platform Belajar Teknologi</title>
    
    {{-- Memuat Aset dari Vite (standar Laravel) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Three.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <style>
        /* Semua gaya kustom Anda tetap di sini agar desain tidak berubah */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #050807;
            color: #d1d5db;
            overflow-x: hidden;
        }
        .main-wrapper::before {
            content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(ellipse at top, rgba(16, 185, 129, 0.1), transparent 60%);
            z-index: -2; pointer-events: none;
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #050807; }
        ::-webkit-scrollbar-thumb { background: #1f2937; border-radius: 8px; }
        .hero-glow { text-shadow: 0 0 25px rgba(16, 185, 129, 0.5); }
        .hero-canvas-container { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; opacity: 0.5; }
        .content-wrapper { position: relative; z-index: 1; }
        .premium-card { background-color: rgba(17, 24, 39, 0.5); border: 1px solid transparent; position: relative; transition: all 0.3s ease; }
        .premium-card::before { content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; border-radius: 0.75rem; border: 1px solid transparent; background: linear-gradient(120deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.05)) border-box; -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0); -webkit-mask-composite: destination-out; mask-composite: exclude; z-index: -1; }
        .premium-card:hover { transform: translateY(-5px); border-color: rgba(16, 185, 129, 0.4); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); }
        .fade-in-up { opacity: 0; transform: translateY(20px); transition: opacity 0.6s cubic-bezier(0.645, 0.045, 0.355, 1), transform 0.6s cubic-bezier(0.645, 0.045, 0.355, 1); transition-delay: var(--delay, 0s); }
        .fade-in-up.is-visible { opacity: 1; transform: translateY(0); }
        #menu-toggle.is-active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
        #menu-toggle.is-active span:nth-child(2) { opacity: 0; }
        #menu-toggle.is-active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }
        #mobile-menu { opacity: 0; transform: translateY(-1rem); pointer-events: none; transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out; }
        #mobile-menu.is-active { opacity: 1; transform: translateY(0); pointer-events: auto; }
    </style>
</head>
<body class="font-sans antialiased">

<div class="main-wrapper">
    <!-- Header -->
    <header class="sticky top-0 z-30 backdrop-blur-lg border-b border-gray-800/60">
        <nav class="max-w-7xl mx-auto px-4 sm:px-8 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2">
                <svg class="w-7 h-7 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
                <h1 class="text-xl font-bold text-white">SyntaxLab</h1>
            </a>
            
            <!-- Navigasi Desktop -->
            <div class="hidden md:flex items-center gap-6">
                <a href="#courses" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Kursus</a>
                <a href="#about" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Tentang</a>
                <a href="#testimonials" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">Testimoni</a>
            </div>

            <!-- Tombol Aksi (Dinamis Berdasarkan Status Login) -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white font-medium hover:text-green-400 transition-colors text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white font-medium hover:text-green-400 transition-colors text-sm">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-green-500 text-black font-semibold py-2 px-4 rounded-md hover:bg-green-400 transition-all text-sm shadow-lg shadow-green-500/20">Mulai Belajar</a>
                @endauth
            </div>

            <!-- Tombol Menu Mobile -->
            <button id="menu-toggle" class="md:hidden text-white w-8 h-8 flex flex-col justify-center items-center space-y-1.5 z-50">
                <span class="block w-6 h-0.5 bg-current transform transition duration-300 ease-in-out"></span>
                <span class="block w-6 h-0.5 bg-current transition duration-300 ease-in-out"></span>
                <span class="block w-6 h-0.5 bg-current transform transition duration-300 ease-in-out"></span>
            </button>
        </nav>

        <!-- Navigasi Mobile (Dinamis) -->
        <div id="mobile-menu" class="md:hidden absolute top-full left-0 w-full bg-gray-900/95 p-6 space-y-4 border-t border-gray-800/60">
            <a href="#courses" class="block text-gray-300 hover:text-white transition-colors">Kursus</a>
            <a href="#about" class="block text-gray-300 hover:text-white transition-colors">Tentang Kami</a>
            <a href="#testimonials" class="block text-gray-300 hover:text-white transition-colors">Testimoni</a>
            <div class="border-t border-gray-800/60 pt-4 mt-4 flex flex-col gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-center bg-green-500 text-black font-semibold py-2 px-4 rounded-md hover:bg-green-400 transition-all text-sm shadow-lg shadow-green-500/20">Dasbor</a>
                @else
                    <a href="{{ route('login') }}" class="text-center text-white font-medium hover:text-green-400 transition-colors py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="text-center bg-green-500 text-black font-semibold py-2 px-4 rounded-md hover:bg-green-400 transition-all text-sm shadow-lg shadow-green-500/20">Mulai Belajar</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="relative h-screen flex items-center justify-center text-center px-4 overflow-hidden">
            <div id="hero-canvas-container" class="hero-canvas-container"></div>
            <div class="content-wrapper">
                <h1 class="text-4xl sm:text-6xl md:text-7xl font-black text-white leading-tight tracking-tight">
                    Kuasai Skill Coding Impianmu<br class="hidden sm:block"> <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-500 hero-glow">Secara Terstruktur</span>
                </h1>
                <p class="max-w-xl mx-auto mt-6 text-base md:text-lg text-gray-400">
                    SyntaxLab menyediakan jalur belajar yang jelas dan proyek dunia nyata untuk membantumu beralih karier menjadi developer profesional.
                </p>
                <div class="mt-10 flex justify-center">
                    <a href="{{ route('register') }}" class="bg-green-500 text-black font-semibold py-3 px-8 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                        Mulai Belajar Sekarang
                    </a>
                </div>
            </div>
        </section>

        <!-- Courses Section -->
        <section id="courses" class="py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-8">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Alur Belajar Unggulan</h2>
                    <p class="text-gray-400 mt-3 max-w-2xl mx-auto">Dirancang oleh pakar industri untuk membawamu dari nol menjadi profesional.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Course Card 1 -->
                    <div class="premium-card p-8 rounded-xl fade-in-up" style="--delay: 0.1s;">
                        <svg class="w-10 h-10 text-green-400 mb-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        <h3 class="text-xl font-bold text-white mb-2">Dasar Web Development</h3>
                        <p class="text-gray-400 text-sm">Mulai perjalanan coding Anda dengan pondasi web: HTML, CSS, dan JavaScript.</p>
                    </div>
                    <!-- Course Card 2 -->
                    <div class="premium-card p-8 rounded-xl fade-in-up" style="--delay: 0.2s;">
                         <svg class="w-10 h-10 text-green-400 mb-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                        <h3 class="text-xl font-bold text-white mb-2">Desain Produk (UI/UX)</h3>
                        <p class="text-gray-400 text-sm">Dari wireframe hingga prototipe interaktif yang siap diuji pengguna.</p>
                    </div>
                    <!-- Course Card 3 -->
                    <div class="premium-card p-8 rounded-xl fade-in-up" style="--delay: 0.3s;">
                         <svg class="w-10 h-10 text-green-400 mb-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10s5 2 5 2a8 8 0 016.343 2.343l-3.687 3.687z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18a6 6 0 100-12 6 6 0 000 12z"></path></svg>
                        <h3 class="text-xl font-bold text-white mb-2">Python & Data Science</h3>
                        <p class="text-gray-400 text-sm">Analisis data, visualisasi, dan bangun model machine learning pertama Anda.</p>
                    </div>
                </div>
            </div>
        </section>

         <!-- Testimonials Section -->
        <section id="testimonials" class="py-24 bg-black/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-8">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Dipercaya oleh Para Profesional</h2>
                    <p class="text-gray-400 mt-3">Kisah sukses dari para lulusan kami.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="premium-card p-8 rounded-xl fade-in-up" style="--delay: 0.1s;">
                        <p class="text-gray-300 mb-6">"Platform terbaik yang pernah saya gunakan. Desainnya modern dan sangat profesional. Saya berhasil mendapatkan pekerjaan impian setelah menyelesaikan kursus UI/UX."</p>
                        <div class="flex items-center">
                            <img src="https://placehold.co/40x40/10b981/ffffff?text=D" alt="Foto profil" class="w-10 h-10 rounded-full">
                            <div class="ml-4">
                                <p class="font-semibold text-white">Dewi Anjani</p>
                                <p class="text-sm text-gray-500">Frontend Developer di TechCorp</p>
                            </div>
                        </div>
                    </div>
                    <div class="premium-card p-8 rounded-xl fade-in-up" style="--delay: 0.2s;">
                        <p class="text-gray-300 mb-6">"Saya tidak punya latar belakang IT, tapi instruktur di sini menjelaskan semuanya dengan sangat baik. Sekarang saya bisa membuat model AI sederhana. Terima kasih SyntaxLab!"</p>
                        <div class="flex items-center">
                            <img src="https://placehold.co/40x40/059669/ffffff?text=R" alt="Foto profil" class="w-10 h-10 rounded-full">
                            <div class="ml-4">
                                <p class="font-semibold text-white">Rian Santoso</p>
                                <p class="text-sm text-gray-500">Mahasiswa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- CTA Section -->
        <section class="py-24">
            <div class="max-w-3xl mx-auto px-4 sm:px-8 text-center fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Ambil Langkah Pertamamu</h2>
                <p class="text-gray-400 mt-4 mx-auto">Masa depan karirmu di bidang teknologi dimulai hari ini. Bergabunglah dengan komunitas kami dan mulailah membangun proyek pertamamu.</p>
                <div class="mt-8">
                    <a href="{{route ('register')}}" class="bg-green-500 text-black font-semibold py-3 px-8 rounded-md hover:bg-green-400 transition-all text-base shadow-lg shadow-green-500/20">
                        Daftar Gratis
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-800/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 flex flex-col sm:flex-row justify-between items-center gap-4">
         <p class="text-sm text-gray-500">&copy; 2025 EduSphere. Semua Hak Cipta Dilindungi.</p>
         <div class="flex gap-6">
            {{-- PERUBAHAN DI SINI --}}
            <a href="{{ route('privacy.policy') }}" class="text-gray-500 hover:text-white transition-colors">Privasi</a>
            <a href="{{ route('terms.of.service')}}" class="text-gray-500 hover:text-white transition-colors">Ketentuan</a>
         </div>
    </div>
</footer>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Toggle
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', () => {
                    menuToggle.classList.toggle('is-active');
                    mobileMenu.classList.toggle('is-active');
                });
            }

            // Scroll Animation
            const animatedElements = document.querySelectorAll('.fade-in-up');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            animatedElements.forEach(el => observer.observe(el));
        });

        // Three.js Animation Setup
        let scene, camera, renderer, shape;
        const container = document.getElementById('hero-canvas-container');

        function init() {
            if (!container) return;
            
            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
            camera.position.z = 15;

            renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
            renderer.setSize(container.clientWidth, container.clientHeight);
            renderer.setPixelRatio(window.devicePixelRatio);
            container.appendChild(renderer.domElement);

            // Abstract Wireframe Shape
            const geometry = new THREE.IcosahedronGeometry(6, 2); // Radius, detail
            const material = new THREE.MeshStandardMaterial({
                color: 0x10b981,
                metalness: 0.1,
                roughness: 0.8,
                wireframe: true,
                wireframeLinewidth: 2,
            });
            shape = new THREE.Mesh(geometry, material);
            scene.add(shape);

            // Lighting
            const ambientLight = new THREE.AmbientLight(0x10b981, 0.2);
            scene.add(ambientLight);
            const pointLight = new THREE.PointLight(0x34d399, 2, 100);
            pointLight.position.set(10, 10, 10);
            scene.add(pointLight);

            window.addEventListener('resize', onWindowResize, false);
            document.addEventListener('mousemove', onMouseMove, false);

            animate();
        }

        function onWindowResize() {
            if (!container) return;
            camera.aspect = container.clientWidth / container.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(container.clientWidth, container.clientHeight);
        }
        
        let mouseX = 0;
        let mouseY = 0;
        function onMouseMove(event) {
            mouseX = (event.clientX / window.innerWidth - 0.5) * 2;
            mouseY = -(event.clientY / window.innerHeight - 0.5) * 2;
        }

        const clock = new THREE.Clock();
        function animate() {
            if (!shape) return;
            requestAnimationFrame(animate);
            
            const elapsedTime = clock.getElapsedTime();
            shape.rotation.y = elapsedTime * 0.1;
            shape.rotation.x = elapsedTime * 0.05;

            // Mouse interaction on the shape's rotation
            shape.rotation.y += mouseX * 0.1;
            shape.rotation.x += mouseY * 0.1;
            
            renderer.render(scene, camera);
        }

        window.onload = init;
    </script>
</body>
</html>
