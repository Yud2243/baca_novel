<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-green-700">
            Tambah Chapter — {{ $book->title }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow">
        <form method="POST" action="{{ route('penulis.books.chapters.store', $book) }}">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold">Judul Chapter</label>
                <input type="text"
                       name="title"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Isi Chapter</label>
                <textarea name="content"
                          rows="10"
                          class="w-full border rounded-lg px-3 py-2"
                          required></textarea>
            </div>

            <div class="flex gap-3">
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg">
                    Simpan
                </button>

                <a href="{{ route('penulis.books.show', $book) }}"
                   class="px-4 py-2 bg-gray-300 rounded-lg">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
