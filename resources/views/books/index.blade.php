<x-app-layout>
    <div class="max-w-6xl mx-auto py-2 px-4">

        <h1 class="text-3xl font-bold mb-6">Daftar Novel</h1>

        <!-- Grid Buku -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($books as $book)
                <div
                    class="flex bg-white rounded-2xl shadow-md overflow-hidden
                           border border-green-100
                           transition duration-300 hover:shadow-xl hover:-translate-y-1">

                    <a href="{{ route('books.show', $book->slug) }}" class="flex-shrink-0">
                        <img
                            class="w-28 h-40 object-cover"
                            src="{{ asset('storage/' . $book->cover_path) }}"
                            alt="{{ $book->title }}">
                    </a>

                    <div class="p-4 flex flex-col gap-1 overflow-hidden">
                        <a href="{{ route('books.show', $book->slug) }}"
                           class="text-lg font-semibold text-gray-900 hover:text-green-700 truncate">
                            {{ $book->title }}
                        </a>

                        <p class="text-sm text-green-700 font-medium truncate">
                            {{ $book->author }}
                        </p>

                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                            {{ Str::limit($book->description, 100) }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">
                    Belum ada buku.
                </p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $books->links() }}
        </div>

    </div>
</x-app-layout>
