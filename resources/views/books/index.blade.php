<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4">

        <h1 class="text-3xl font-bold mb-6">Daftar Novel
        </h1>

        <!-- Form Pencarian -->
        

        <!-- Grid Buku -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($books as $book)
                <a href="{{ route('books.show', $book->slug) }}" class="block bg-white shadow rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $book->author }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $books->links() }}
        </div>

    </div>
</x-app-layout>
