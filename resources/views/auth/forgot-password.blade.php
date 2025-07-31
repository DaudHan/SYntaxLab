<x-guest-layout>
    <div class="main-wrapper min-h-screen flex items-center justify-center px-4 py-16">
        <div class="w-full max-w-md premium-card rounded-xl p-8">
            <h1 class="text-3xl font-extrabold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-300 to-emerald-500">
                Lupa Password?
            </h1>

            <p class="text-sm text-gray-300 mb-6 leading-relaxed">
                Tidak masalah. Masukkan alamat email kamu dan kami akan mengirimkan tautan untuk mengatur ulang password ke email kamu.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-emerald-400" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email"
                        name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <x-primary-button class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-3 rounded-lg transition shadow-md">
                        {{ __('Kirim Link Reset Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
