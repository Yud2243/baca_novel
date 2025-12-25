<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penulis Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">{{ __("Selamat datang Penulis") }}</h3>
                    <p class="mt-2 text-gray-600">
                        {{ __("Dari sini, Anda bisa mengelola buku dan bab.") }}
                    </p>
                    <div class="mt-6">
                        <!-- Tombol utama -->
                    <div class="mt-6">
                        <a href="#" 
                           class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors duration-200 shadow-sm">
                            Kelola Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
