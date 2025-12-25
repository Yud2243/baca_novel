<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-lg text-green-700">
                Novel Saya
            </h2>

            <a href="{{ route('penulis.books.create') }}"
               class="px-3 py-2 bg-green-600 text-white text-sm rounded-lg
                      hover:bg-green-700 transition">
                + Buku
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-3 py-4">

        @if($books->count() > 0)

        <!-- APP LIST -->
        <div class="space-y-2">

            @foreach($books as $book)

            <!-- CARD = LINK DETAIL -->
            <a href="{{ route('penulis.books.show', $book) }}"
               class="block">

                <div
                    class="flex gap-3 p-3 bg-white rounded-xl
                           shadow-sm active:scale-[0.98]
                           hover:bg-green-50
                           transition">

                    <!-- COVER -->
                    <div class="flex-shrink-0">
                        @if($book->cover_path)
                            <img
                                src="{{ asset('storage/' . $book->cover_path) }}"
                                class="w-20 h-28 object-cover rounded-lg"
                                alt="{{ $book->title }}">
                        @else
                            <div
                                class="w-20 h-28 bg-green-100 rounded-lg
                                       flex items-center justify-center
                                       text-xs text-green-700">
                                No Cover
                            </div>
                        @endif
                    </div>

                    <!-- INFO -->
                    <div class="flex flex-col justify-between flex-1">

                        <div>
                            <h3 class="font-semibold text-sm text-gray-800 line-clamp-1">
                                {{ $book->title }}
                            </h3>

                            <p class="text-xs text-gray-500">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                {{ $book->description }}
                            </p>
                        </div>

                        <!-- FOOTER -->
                        <div class="flex items-center justify-between mt-2">

                            <span
                                class="text-[11px] px-2 py-0.5 rounded-full
                                       bg-green-100 text-green-700">
                                {{ ucfirst($book->status) }}
                            </span>

                            <!-- EDIT (STOP PROPAGATION) -->
                            <a href="{{ route('penulis.books.edit', $book) }}"
                               onclick="event.stopPropagation()"
                               class="px-2 py-1 text-xs text-yellow-600
                                      hover:bg-yellow-50 rounded">
                                Edit
                            </a>
                        </div>

                    </div>
                </div>
            </a>

            @endforeach

        </div>

        @else
            <p class="text-center text-gray-500 mt-10 text-sm">
                Belum ada novel
            </p>
        @endif
    </div>
</x-app-layout>
