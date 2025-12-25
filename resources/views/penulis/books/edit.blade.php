<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-green-800">
            Edit Buku
        </h1>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 py-8">

        <div class="bg-white p-6 rounded-2xl shadow space-y-6">

            {{-- FORM --}}
            <form method="POST"
                  action="{{ route('penulis.books.update', $book) }}"
                  enctype="multipart/form-data"
                  class="space-y-4">

                @csrf
                @method('PUT')

                {{-- JUDUL --}}
                <div>
                    <label class="block font-medium text-gray-700">Judul Buku</label>
                    <input type="text"
                           name="title"
                           value="{{ old('title', $book->title) }}"
                           required
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="block font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description"
                              rows="5"
                              class="w-full border rounded-lg px-3 py-2">{{ old('description', $book->description) }}</textarea>
                </div>

                {{-- COVER --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Ganti Cover (Opsional)
                    </label>

                    @if($book->cover_path)
                        <img src="{{ asset('storage/'.$book->cover_path) }}"
                             class="w-32 h-48 object-cover rounded mb-3">
                    @endif

                    <input type="file"
                           name="cover_path"
                           class="w-full border rounded-lg p-2">
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('penulis.books.show', $book) }}"
                       class="px-4 py-2 border rounded-lg">
                        Batal
                    </a>

                    <button type="submit"
                            class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        💾 Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
