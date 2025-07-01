<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 p-4">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="flex justify-center items-center gap-2 mb-8">
                <a href="/">
                    <svg class="w-9 h-9 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
                </a>
            </div>

            <div class="premium-card rounded-xl p-8">
                <h2 class="text-2xl font-bold text-white text-center">Selamat Datang Kembali</h2>
                <p class="text-center text-gray-400 mt-2 text-sm">Masuk untuk melanjutkan perjalanan belajarmu.</p>
                
                <x-auth-session-status class="my-4 text-green-400 text-sm text-center" :status="session('status')" />

                <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                        <input type="email" id="email" name="email" :value="old('email')" required autofocus
                               class="w-full bg-gray-800/80 border @error('email') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Input Password -->
                    <div class="mt-4">
                        <div class="flex justify-between items-center mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-medium text-green-400 hover:text-green-300">
                                    {{ __('Lupa Password?') }}
                                </a>
                            @endif
                        </div>
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                               class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-600 bg-gray-900 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                            <span class="ms-2 text-sm text-gray-400">{{ __('Ingat saya') }}</span>
                        </label>
                    </div>

                    <!-- Tombol Masuk -->
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-green-500 text-black font-semibold py-3 px-6 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            {{ __('Masuk') }}
                        </button>
                    </div>
                </form>
            </div>
             <!-- Link Daftar -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-400">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-semibold text-green-400 hover:text-green-300">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
