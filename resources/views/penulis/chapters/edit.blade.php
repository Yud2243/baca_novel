<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">

        <h1 class="text-2xl font-bold mb-6">
            Edit Chapter — {{ $book->title }}
        </h1>

        <form method="POST"
              action="{{ route('penulis.books.chapters.update', [$book, $chapter]) }}"
              class="space-y-6">

            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1">Judul Chapter</label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $chapter->title) }}"
                       class="w-full border rounded-lg px-4 py-2"
                       required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Isi Chapter</label>
                <textarea name="content"
                          rows="12"
                          class="w-full border rounded-lg px-4 py-2"
                          required>{{ old('content', $chapter->content) }}</textarea>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('penulis.books.show', $book) }}"
                   class="px-4 py-2 bg-gray-200 rounded-lg">
                    ← Kembali
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
