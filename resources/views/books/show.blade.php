<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4 space-y-10">

        {{-- INFO BUKU --}}
        <div class="bg-white shadow rounded-2xl p-6">
            <div class="flex flex-row gap-6 items-start">

                {{-- COVER --}}
                @if($book->cover_path)
                    <img
                        src="{{ asset('storage/' . $book->cover_path) }}"
                        class="w-44 h-64 object-cover rounded-xl shadow flex-shrink-0"
                        alt="Cover {{ $book->title }}"
                    >
                @else
                    <div class="w-44 h-64 bg-green-100 rounded-xl flex items-center justify-center text-green-700 flex-shrink-0">
                        Tidak ada cover
                    </div>
                @endif

                {{-- DETAIL --}}
                <div class="flex-1">
                    <h1 class="text-3xl font-extrabold text-gray-900 leading-tight">
                        {{ $book->title }}
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        oleh <span class="font-semibold text-gray-700">{{ $book->author }}</span>
                    </p>

                    <p class="mt-4 text-gray-700 leading-relaxed">
                        {{ $book->description ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>

            </div>
        </div>

        {{-- DAFTAR BAB --}}
        <div>
            <h2 class="text-2xl font-semibold mb-4">Daftar Bab</h2>

            <div class="bg-white shadow rounded-2xl divide-y">

                @forelse ($book->chapters as $chapter)
                    <a href="{{ route('books.chapter', [$book->slug, $chapter->chapter_number]) }}"
                       class="block px-5 py-4 hover:bg-green-50 transition">

                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">
                                    Bab {{ $chapter->chapter_number }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $chapter->title }}
                                </p>
                            </div>

                            <span class="text-green-600 text-sm font-medium">
                                Baca →
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        Belum ada bab tersedia.
                    </div>
                @endforelse

            </div>
        </div>

    </div>
</x-app-layout>
