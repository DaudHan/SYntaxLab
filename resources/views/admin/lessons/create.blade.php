<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white tracking-tight">
            Tambah Pelajaran Baru ke Modul: <span class="text-green-400">{{ $module->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="premium-card p-6 sm:p-8 rounded-xl">
                <form method="POST" action="{{ route('admin.lessons.store', $module) }}" class="space-y-6">
                    @csrf
                    @include('admin.lessons.partials.form-fields')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>