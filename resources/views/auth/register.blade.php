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
                <h2 class="text-2xl font-bold text-white text-center">Buat Akun Baru</h2>
                <p class="text-center text-gray-400 mt-2 text-sm">Mulai perjalanan belajarmu bersama kami.</p>

                <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Nama Lengkap') }}</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                               class="w-full bg-gray-800/80 border @error('name') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                               class="w-full bg-gray-800/80 border @error('email') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Password') }}</label>
                        <input type="password" id="password" name="password" required autocomplete="new-password"
                               class="w-full bg-gray-800/80 border @error('password') border-red-500 @else border-gray-700 @enderror rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Konfirmasi Password') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                               class="w-full bg-gray-800/80 border border-gray-700 rounded-md py-2.5 px-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    
                    <div class="flex items-center justify-end mt-4">
                         <a class="underline text-sm text-gray-400 hover:text-gray-200" href="{{ route('login') }}">
                            {{ __('Sudah punya akun?') }}
                        </a>
                        <button type="submit" class="ms-4 bg-green-500 text-black font-semibold py-2 px-5 rounded-md hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            {{ __('Daftar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
