<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">{{ __("Selamat datang di Panel Admin!") }}</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        {{ __("Dari sini, Anda bisa mengelola buku dan bab.") }}
                    </p>
                    <div class="mt-6">
                        <!-- 
                          TOMBOL INI DIGANTI: 
                          bg-indigo-600 -> bg-green-600 
                          hover:bg-indigo-700 -> hover:bg-green-700
                        -->
                        <a href="{{ route('admin.books.index') }}" 
                           class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-400">
                            Kelola Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>