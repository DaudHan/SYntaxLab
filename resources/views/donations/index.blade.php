<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            {{ __('Dukung SyntaxLab!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <p class="text-gray-400">Bantu kami terus menyediakan konten pembelajaran berkualitas untuk semua.</p>
            </div>

            <div class="premium-card rounded-xl overflow-hidden shadow-lg p-6 md:p-8">
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-white mb-4">Donasi Anda Berarti</h3>
                    <p class="text-gray-400 mb-6 max-w-2xl mx-auto">
                        Setiap kontribusi, sekecil apapun, akan sangat membantu kami dalam mengembangkan platform ini,
                        memperbarui kursus, dan menciptakan fitur-fitur baru. Terima kasih atas dukungan Anda!
                    </p>

                    <div class="mt-8 mb-10">
                        <h4 class="text-2xl font-semibold text-white mb-5">Donasi via QRIS</h4>
                        <p class="text-gray-400 mb-6">
                            Scan QR Code di bawah ini menggunakan aplikasi pembayaran favorit Anda (GoPay, OVO, Dana, LinkAja, Mobile Banking, dll.).
                        </p>

                        {{--
                            PENTING:
                            Pastikan Anda sudah mengunggah gambar QRIS Anda ke `storage/app/public/`
                            dan menjalankan perintah `php artisan storage:link` dari terminal proyek Anda.
                            Nama file gambar di sini adalah 'qris_image.png', sesuaikan jika nama file Anda berbeda.
                            Kelas `w-64 h-64` akan diterapkan pada perangkat seluler kecil (default),
                            sementara `sm:w-80 sm:h-80` akan meningkatkan ukurannya pada breakpoint 'sm' ke atas.
                            Ini memastikan QRIS cukup besar untuk dipindai di sebagian besar perangkat.
                        --}}
                        <div class="bg-gray-800/80 p-4 rounded-xl inline-block border border-gray-700 shadow-xl">
                            <img src="{{ asset('/qris_image.jpg') }}" alt="QRIS Code for Donation" class="mx-auto w-64 h-64 sm:w-80 sm:h-80 object-contain rounded-lg">
                        </div>
                        <p class="mt-4 text-sm text-gray-500">
                            Pastikan untuk memverifikasi nama penerima setelah memindai.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
