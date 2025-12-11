<x-app-layout>
    <div class="max-w-3xl mx-auto p-4"> 
    <div class="p-6 bg-white shadow rounded-lg">

        <!-- Judul & Garis -->
        <h1 class="text-2xl font-bold text-green-700 mb-2">Tambah Buku Baru</h1>
        <div class="w-24 h-1 bg-green-700 rounded-full mb-6"></div>

        <!-- Tombol Kembali -->
        <div class="flex justify-end mb-6">
            <a href="{{ route('penulis.books.index') }}" 
               class="py-2 px-4 bg-green-700 text-white rounded-lg text-sm font-medium hover:bg-green-800 transition">
                Kembali ke Daftar
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('penulis.books.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Judul -->
            <div>
                <x-input-label for="title" :value="__('Judul Buku')" class="text-green-700" />
                <x-text-input 
                    id="title" 
                    name="title" 
                    type="text" 
                    :value="old('title')" 
                    required 
                    autofocus
                    class="block w-full border border-green-300 rounded-md shadow-sm text-gray-900
                           focus:border-green-500 focus:ring focus:ring-green-200 hover:border-green-400" 
                />
                <x-input-error :messages="$errors->get('title')" class="mt-1 text-red-600" />
            </div>

            <!-- Penulis -->
            <div>
                <x-input-label for="author" :value="__('Nama Penulis')" class="text-green-700" />
                <x-text-input 
                    id="author" 
                    name="author" 
                    type="text" 
                    :value="old('author', Auth::user()->name)" 
                    required
                    class="block w-full border border-green-300 rounded-md shadow-sm text-gray-900
                           focus:border-green-500 focus:ring focus:ring-green-200 hover:border-green-400" 
                />
                <x-input-error :messages="$errors->get('author')" class="mt-1 text-red-600" />
            </div>

            <!-- Deskripsi -->
            <div>
                <x-input-label for="description" :value="__('Deskripsi / Sinopsis')" class="text-green-700" />
                <textarea 
                    id="description" 
                    name="description" 
                    rows="5"
                    class="block w-full border border-green-300 rounded-md shadow-sm text-gray-900
                           focus:border-green-500 focus:ring focus:ring-green-200 hover:border-green-400"
                >{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1 text-red-600" />
            </div>

            <!-- Upload Sampul -->
            <div>
                <x-input-label for="cover_path" :value="__('Upload Gambar Sampul')" class="text-green-700" />
                <input 
                    id="cover_path" 
                    name="cover_path" 
                    type="file"
                    class="block w-full text-sm text-gray-700
                           border border-green-300 rounded-md
                           file:py-2 file:px-4 file:bg-green-100 file:text-green-700 file:rounded-md hover:file:bg-green-200
                           focus:border-green-500 focus:ring focus:ring-green-200"
                />
                <p class="mt-1 text-sm text-gray-700">Format: JPG, PNG, WEBP — Maks 2MB.</p>
                <x-input-error :messages="$errors->get('cover_path')" class="mt-1 text-red-600" />
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end">
                <button type="submit"
                    class="py-2 px-5 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    Simpan Buku
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
