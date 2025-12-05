<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">

        <h1 class="text-3xl font-bold mb-2">
            {{ $book->title }}
        </h1>

        <h2 class="text-xl font-semibold mb-6">
            Bab {{ $chapter->chapter_number }} — {{ $chapter->title }}
        </h2>

        <div class="bg-white shadow rounded-lg p-6 leading-relaxed text-lg whitespace-pre-line">
            {!! nl2br(e($chapter->content)) !!}
        </div>

        <div class="flex justify-between mt-8">

            @if ($chapter->chapter_number > 1)
                <a href="{{ route('books.chapter.show', [$book->slug, $chapter->chapter_number - 1]) }}"
                   class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    ← Bab Sebelumnya
                </a>
            @else
                <span></span>
            @endif

            @if ($chapter->chapter_number < $book->chapters->count())
                <a href="{{ route('books.chapter.show', [$book->slug, $chapter->chapter_number + 1]) }}"
                   class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Bab Selanjutnya →
                </a>
            @endif

        </div>

    </div>
</x-app-layout>
