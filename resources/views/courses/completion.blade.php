<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            Kursus Selesai!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
             <div class="premium-card rounded-xl p-8 sm:p-12 text-center">
                <div class="w-24 h-24 mx-auto bg-green-500/10 rounded-full flex items-center justify-center border-2 border-green-500/30 mb-6">
                    <svg class="w-12 h-12 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>

                <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Selamat!</h1>
                <p class="text-gray-400 mt-2">Anda telah berhasil menyelesaikan kursus:</p>
                <p class="text-lg font-semibold text-white mt-1">"{{ $course->title }}"</p>
                
                <p class="text-green-400 font-semibold mt-6">Anda mendapatkan +1000 XP!</p>

                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                     <a href="{{ route('my-courses') }}" class="w-full sm:w-auto bg-gray-700 text-white font-semibold py-2.5 px-6 rounded-md hover:bg-gray-600 transition-all text-sm flex items-center justify-center gap-2">
                        Kembali ke Kursus Saya
                    </a>
                    <a href="{{ route('courses.index') }}" class="w-full sm:w-auto bg-green-500 text-black font-semibold py-2.5 px-6 rounded-md hover:bg-green-400 transition-all text-sm shadow-lg shadow-green-500/20 flex items-center justify-center gap-2">
                        Jelajahi Kursus Lain
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
