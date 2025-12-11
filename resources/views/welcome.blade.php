<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased">

    <!-- WRAPPER EXACT LIKE BREEZE -->
    <div class="min-h-screen bg-gray-100">

        {{-- NAVIGATION (SAMA PERSIS SEPERTI DI HALAMAN LOGIN) --}}
        @include('layouts.navigation')

        <!-- CONTENT -->
        <main>
            <!-- SECTION: REKOMENDASI -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-green-100">
                        <div class="p-6 md:p-8 text-gray-900">

                            <!-- TITLE -->
                            <div class="mb-6">
                                <h2 class="text-2xl font-semibold text-gray-800">Rekomendasi</h2>
                                <div class="w-24 h-1 bg-green-700 rounded-full mt-2"></div>
                            </div>

                            <!-- GRID -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                                @forelse ($books as $book)
                                    <div class="flex bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-[1.03] border border-gray-100">
                                        <a href="{{ route('books.show', $book->slug) }}" class="flex-shrink-0">
                                            <img class="w-28 h-40 object-cover"
                                                src="{{ asset('storage/' . $book->cover_path) }}"
                                                alt="{{ $book->title }}">
                                        </a>

                                        <div class="p-4 flex flex-col justify-start overflow-hidden">
                                            <a href="{{ route('books.show', $book->slug) }}" 
                                            class="text-lg font-semibold text-gray-900 hover:text-green-700 truncate">
                                                {{ $book->title }}
                                            </a>

                                            <p class="text-sm text-gray-600 mt-1 truncate">{{ $book->author }}</p>

                                            <p class="text-sm text-gray-700 mt-2 line-clamp-2">
                                                {{ Str::limit($book->description, 100) }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="col-span-full text-center text-gray-500">
                                        Belum ada buku untuk ditampilkan.
                                    </p>
                                @endforelse

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </main>

    </div>
</body>
</html>
