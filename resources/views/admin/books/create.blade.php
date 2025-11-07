<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Buku Baru') }}
            </h2>
            <a href="{{ route('admin.books.index') }}" class="py-2 px-4 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Form untuk menambah buku baru -->
                    <!-- 
                        enctype="multipart/form-data" 
                        SANGAT PENTING untuk upload file/gambar 
                    -->
                    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
                        @csrf <!-- Token Keamanan Laravel -->

                        <!-- Judul -->
                        <div>
                            <x-input-label for="title" :value="__('Judul Buku')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Penulis -->
                        <div class="mt-4">
                            <x-input-label for="author" :value="__('Penulis')" />
                            <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author')" required />
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi / Sinopsis')" />
                            <!-- Kita pakai textarea untuk deskripsi -->
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Upload Sampul -->
                        <div class="mt-4">
                            <x-input-label for="cover_path" :value="__('Upload Gambar Sampul')" />
                            <input id="cover_path" name="cover_path" type="file" class="block mt-1 w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100
                                dark:file:bg-indigo-800 dark:file:text-indigo-200 dark:hover:file:bg-indigo-700" required />
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">File: JPG, PNG, WEBP (Maks 2MB).</p>
                            <x-input-error :messages="$errors->get('cover_path')" class="mt-2" />
                        </div>
                        
                        <!-- Tombol Simpan -->
                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Simpan Buku') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>