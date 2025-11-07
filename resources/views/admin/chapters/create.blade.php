<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Tambah Bab Baru untuk:') }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $book->title }}</p>
            </div>
            <a href="{{ route('admin.books.chapters.index', $book) }}" class="py-2 px-4 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">
                &larr; Kembali ke Daftar Bab
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Form untuk menambah bab baru -->
                    <form method="POST" action="{{ route('admin.books.chapters.store', $book) }}">
                        @csrf <!-- Token Keamanan Laravel -->

                        <!-- Nomor Bab -->
                        <div>
                            <x-input-label for="chapter_number" :value="__('Nomor Bab')" />
                            <x-text-input id="chapter_number" class="block mt-1 w-full" type="number" name="chapter_number" :value="old('chapter_number')" required autofocus />
                            <x-input-error :messages="$errors->get('chapter_number')" class="mt-2" />
                        </div>
                        
                        <!-- Judul Bab -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Judul Bab')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Konten Bab -->
                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Konten Bab')" />
                            <!-- 
                                Ini adalah textarea yang sangat besar untuk isi novel.
                                Anda bisa menggantinya dengan editor WYSIWYG seperti CKEditor nanti.
                            -->
                            <textarea id="content" name="content" rows="20" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>
                        
                        <!-- Tombol Simpan -->
                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Simpan Bab') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>