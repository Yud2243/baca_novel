<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-green-700 dark:text-green-300 leading-tight">
                {{ __('Tambah Buku Baru') }}
            </h2>
            <a href="{{ route('admin.books.index') }}" 
               class="py-2 px-4 bg-green-700 text-white rounded-lg text-sm font-medium hover:bg-green-800 
                      dark:bg-green-600 dark:hover:bg-green-500">
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-green-700 dark:text-gray-100">
                    
                    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
                        @csrf 

                        <!-- Judul -->
                        <div>
                            <x-input-label for="title" :value="__('Judul Buku')" />

                            <x-text-input id="title"
                                class="block mt-1 w-full
                                border-green-500 text-gray-900
                                !focus:border-green-600 !focus:ring-green-600
                                hover:border-green-600
                                dark:border-green-500 dark:bg-gray-900 dark:text-gray-200
                                dark:!focus:border-green-400 dark:!focus:ring-green-400
                                dark:hover:border-green-400"
                                type="text" name="title" :value="old('title')" required autofocus />

                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Penulis -->
                        <div class="mt-4">
                            <x-input-label for="author" :value="__('Penulis')" />

                            <x-text-input id="author"
                                class="block mt-1 w-full
                                border-green-500 text-gray-900
                                !focus:border-green-600 !focus:ring-green-600
                                hover:border-green-600
                                dark:border-green-500 dark:bg-gray-900 dark:text-gray-200
                                dark:!focus:border-green-400 dark:!focus:ring-green-400
                                dark:hover:border-green-400"
                                type="text" name="author" :value="old('author')" required />

                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi / Sinopsis')" />

                            <textarea id="description" name="description" rows="5"
                                class="block mt-1 w-full
                                border-green-500 rounded-md shadow-sm text-gray-900
                                !focus:border-green-600 !focus:ring-green-600
                                hover:border-green-600
                                dark:border-green-500 dark:bg-gray-900 dark:text-gray-200
                                dark:!focus:border-green-400 dark:!focus:ring-green-400
                                dark:hover:border-green-400">{{ old('description') }}</textarea>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Upload Sampul -->
                        <div class="mt-4">
                            <x-input-label for="cover_path" :value="__('Upload Gambar Sampul')" />

                            <input id="cover_path" name="cover_path" type="file"
                                class="block mt-1 w-full text-sm text-gray-600
                                border-green-500
                                hover:border-green-600
                                !focus:border-green-600
                                
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0 file:text-sm file:font-semibold
                                file:bg-green-100 file:text-green-700 hover:file:bg-green-200
                                
                                dark:border-green-500 dark:hover:border-green-400 dark:!focus:border-green-400
                                dark:file:bg-green-800 dark:file:text-green-200 dark:hover:file:bg-green-700"
                                required />

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                File: JPG, PNG, WEBP (Maks 2MB).
                            </p>

                            <x-input-error :messages="$errors->get('cover_path')" class="mt-2" />
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="flex items-center justify-end mt-6">
                            <button class="py-2 px-5 bg-green-600 text-white rounded-md hover:bg-green-700 
                                dark:bg-green-500 dark:hover:bg-green-400">
                                Simpan Buku
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
