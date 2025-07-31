<x-guest-layout>
    <div class="main-wrapper min-h-screen flex items-center justify-center px-4 py-16">
        <div class="w-full max-w-xl premium-card rounded-xl p-8 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-300 to-emerald-500">
    Verifikasi Email Kamu
</h1>


            <p class="text-base md:text-lg text-gray-300 mb-6 leading-relaxed">
                Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email kamu dengan
                mengklik tautan yang telah kami kirimkan. <br />
                Jika kamu belum menerima email, kami akan mengirimkannya kembali.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 text-sm font-semibold text-emerald-400">
                    Tautan verifikasi baru telah dikirim ke alamat email kamu.
                </div>
            @endif

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="bg-emerald-500 hover:bg-emerald-400 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out">
    Kirim Ulang Email
</x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
    class="text-sm text-emerald-400 hover:text-white underline transition duration-200">
    Keluar
</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
