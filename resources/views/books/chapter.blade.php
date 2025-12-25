<x-app-layout>
    <div class="min-h-screen bg-white py-10">

        {{-- READER CONTAINER --}}
        <div class="w-full max-w-full mx-auto px-4 sm:px-6 md:px-10">

            {{-- INFO BAB --}}
            <div class="mb-8 text-center select-none">
                <p class="text-xs tracking-widest text-gray-500 uppercase mb-2">
                    {{ $book->title }}
                </p>

                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900">
                    Bab {{ $chapter->chapter_number }}
                </h1>

                <p class="text-lg sm:text-xl text-gray-700 mt-1 italic">
                    {{ $chapter->title }}
                </p>
            </div>

            {{-- ISI NOVEL --}}
            <article
                class="w-full bg-white px-2 sm:px-4 md:px-6 py-6 sm:py-8 md:py-12
                       text-gray-900 text-[18px] sm:text-[20px] md:text-[22px]
                       leading-relaxed sm:leading-loose md:leading-loose font-serif
                       [&>br]:block [&>br]:my-4
                       selection:bg-yellow-200 selection:text-black">

                {!! nl2br(e($chapter->content)) !!}

            </article>

            {{-- NAVIGATION --}}
            <div class="mt-12 flex flex-col sm:flex-row justify-between items-center gap-3 sm:gap-0 text-sm">

                {{-- PREV --}}
                @if ($chapter->chapter_number > 1)
                    <a href="{{ route('books.chapter.show', [$book->slug, $chapter->chapter_number - 1]) }}"
                       class="px-4 py-3 rounded-full
                              bg-gray-200 hover:bg-gray-300
                              text-gray-700 transition text-center w-full sm:w-auto">
                        ← Bab Sebelumnya
                    </a>
                @else
                    <span></span>
                @endif

                {{-- NEXT --}}
                @if ($chapter->chapter_number < $book->chapters->count())
                    <a href="{{ route('books.chapter.show', [$book->slug, $chapter->chapter_number + 1]) }}"
                       class="px-4 py-3 rounded-full
                              bg-gray-800 text-white
                              hover:bg-black transition text-center w-full sm:w-auto">
                        Bab Selanjutnya →
                    </a>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
