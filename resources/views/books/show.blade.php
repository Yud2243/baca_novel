<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">

        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex flex-col md:flex-row gap-6">
                
                <!-- Cover -->
                <img src="{{ asset('storage/' . $book->cover) }}" 
                     class="w-40 h-56 object-cover rounded-lg shadow">

                <div>
                    <h1 class="text-3xl font-bold">{{ $book->title }}</h1>
                    <p class="text-gray-600 mb-2">Oleh {{ $book->author }}</p>
                    <p class="mt-4 text-gray-700">{{ $book->description }}</p>
                </div>

            </div>
        </div>

        <h2 class="text-2xl font-semibold mt-10 mb-4">Daftar Bab</h2>

        <div class="bg-white shadow rounded-lg divide-y">
            @foreach ($chapters as $chapter)
                <a href="{{ route('books.chapter', [$book->slug, $chapter->chapter_number]) }}" 
                   class="block px-4 py-3 hover:bg-gray-100">
                    Bab {{ $chapter->chapter_number }} — {{ $chapter->title }}
                </a>
            @endforeach
        </div>

    </div>
</x-app-layout>
