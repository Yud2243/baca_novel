<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold text-green-700 mb-6">Edit Buku</h2>

        <form action="{{ route('penulis.books.update', $book->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Judul Buku -->
            <div>
                <label for="title" class="block font-medium text-gray-700 mb-1">Judul Buku</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" 
                    value="{{ $book->title }}" 
                    required
                >
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

            <!-- Tombol -->
            <div class="flex items-center gap-3 pt-4">
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800"
                >
                    Update
                </button>

                <a 
                    href="{{ route('penulis.books.index') }}" 
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
