<x-app-layout>
    <div class="p-6 bg-white shadow rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-green-700 dark:text-gray-700 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            
        </div>
        <div class="w-26 h-1 bg-green-700 rounded-full mt-2"></div>
        <div class="py-4">

    <div class="py-5 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">{{ __("Selamat datang di Panel Admin!") }}</h3>
                    <p class="mt-2 text-gray-600">
                        {{ __("Dari sini, Anda bisa mengelola buku dan bab.") }}
                    </p>
                    <div class="mt-6">
                        <!-- Tombol utama -->
                        <a href="{{ route('admin.users.index') }}" 
                           class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors duration-200 shadow-sm">
                            Kelola Pengguna
                        </a>
                    <div class="mt-6">
                        <a href="{{ route('admin.penulis.applicants') }}" 
                           class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors duration-200 shadow-sm">
                            Pengajuan Penulis
                        </a>
                    <div class="mt-6">
                        <a href="{{ route('admin.books.index') }}" 
                           class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors duration-200 shadow-sm">
                            Kelola Buku
                        </a>
                    </div>
                    <div class="mt-6">
                     <a href="{{ route('admin.books.approve') }}" 
                     class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium 
                   hover:bg-green-700 transition-colors duration-200 shadow-sm">
                     Kelola Persetujuan Novel
                      </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
