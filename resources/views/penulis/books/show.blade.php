<x-app-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h1 class="text-lg font-bold text-green-800 leading-tight">
                {{ $book->title }}
            </h1>
            <p class="text-xs text-gray-500">
                {{ $book->author }}
            </p>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-3 py-3 space-y-4">

        {{-- HERO (DIPAKAI DI SEMUA DEVICE) --}}
        <div class="bg-white rounded-2xl shadow-sm p-4 space-y-3">

            <div class="flex justify-center">
                @if($book->cover_path)
                    <img
                        src="{{ asset('storage/' . $book->cover_path) }}"
                        class="w-28 h-40 object-cover rounded-xl shadow"
                        alt="Cover {{ $book->title }}">
                @else
                    <div
                        class="w-28 h-40 bg-green-100 rounded-xl
                               flex items-center justify-center
                               text-xs text-green-700">
                        No Cover
                    </div>
                @endif
            </div>

            <p class="text-sm text-gray-700 leading-relaxed line-clamp-4">
                {{ $book->description ?? 'Tidak ada deskripsi.' }}
            </p>
        </div>

        {{-- HEADER CHAPTER --}}
        <div class="flex items-center justify-between px-1">
            <h2 class="text-sm font-semibold text-gray-800">
                Chapter
            </h2>
        </div>

        {{-- LIST CHAPTER --}}
        <div class="bg-white rounded-xl shadow-sm divide-y">

            @forelse($book->chapters as $chapter)
            <div class="flex items-center justify-between p-4">

                {{-- TAP AREA --}}
                <a href="{{ route('books.chapter', [$book->slug, $chapter->chapter_number]) }}"
                   class="flex-1 active:bg-green-50 transition rounded-lg p-1">
                    <p class="text-sm font-semibold text-gray-800">
                        Chapter {{ $chapter->chapter_number }}
                    </p>
                    <p class="text-xs text-gray-500 line-clamp-1">
                        {{ $chapter->title }}
                    </p>
                </a>

                {{-- MORE (SEMUA DEVICE) --}}
                @auth
                @if($book->ownedBy(auth()->user()))
                    <button
                        onclick="openAction('{{ $chapter->id }}')"
                        class="text-gray-400 text-lg px-1.5">
                        ⋮
                    </button>
                @endif
                @endauth

            </div>

            {{-- ACTION SHEET (SEMUA DEVICE) --}}
            @auth
            @if($book->ownedBy(auth()->user()))
            <div id="action-{{ $chapter->id }}"
                 class="hidden fixed inset-0 bg-black/40 z-50 flex items-end">

                <div class="bg-white w-full rounded-t-2xl p-4 space-y-3">

                    <div class="h-1 w-12 bg-gray-300 rounded-full mx-auto mb-2"></div>

                    <a href="{{ route('penulis.books.chapters.edit', [$book, $chapter]) }}"
                       class="block w-full text-center
                              py-2.5 text-sm
                              bg-yellow-500 text-white rounded-lg">
                        Edit Chapter
                    </a>

                    <form method="POST"
                          action="{{ route('penulis.books.chapters.destroy', [$book, $chapter]) }}"
                          onsubmit="return confirm('Yakin hapus chapter ini?')">
                        @csrf
                        @method('DELETE')
                        <button
                            class="w-full py-2.5 text-sm
                                   bg-red-600 text-white rounded-lg">
                            Hapus Chapter
                        </button>
                    </form>

                    <button
                        onclick="closeAction('{{ $chapter->id }}')"
                        class="w-full py-2 text-sm text-gray-500">
                        Batal
                    </button>

                </div>
            </div>
            @endif
            @endauth

            @empty
            <div class="p-4 text-center text-xs text-gray-500">
                Belum ada chapter
            </div>
            @endforelse

        </div>
    </div>

    {{-- FAB TAMBAH CHAPTER (SEMUA DEVICE) --}}
    @auth
    @if($book->ownedBy(auth()->user()))
    <div class="fixed bottom-5 right-5 z-40">
        <a href="{{ route('penulis.books.chapters.create', $book) }}"
           class="w-12 h-12 bg-green-600 text-white
                  rounded-full flex items-center justify-center
                  text-xl shadow-lg
                  active:scale-95 transition">
            +
        </a>
    </div>
    @endif
    @endauth

    {{-- SCRIPT --}}
    <script>
        function openAction(id) {
            document.getElementById('action-' + id).classList.remove('hidden');
        }
        function closeAction(id) {
            document.getElementById('action-' + id).classList.add('hidden');
        }
    </script>

</x-app-layout>
