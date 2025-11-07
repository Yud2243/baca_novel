<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Banner Utama -->
            <div class="mb-8 shadow-lg sm:rounded-lg overflow-hidden bg-white">
                <a href="#">
                    <img src="https://placehold.co/1200x400/166534/e2e8f0?text=Putri+Untuk+Jagoan&font=lato"
                         alt="Novel Iklan"
                         class="w-full h-auto object-cover">
                </a>
            </div>

            <!-- Rekomendasi -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">

                    <!-- Judul -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">
                            Rekomendasi
                        </h2>
                        <div class="w-24 h-1 bg-green-700 rounded-full mt-2"></div>
                    </div>

                    <!-- Grid Buku -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($books as $book)
                            <div class="flex bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-[1.03] border border-gray-100">
                                <a href="{{ route('books.show', $book->slug) }}" class="flex-shrink-0">
                                    <img class="w-28 h-40 object-cover"
                                         src="{{ asset('storage/' . $book->cover_path) }}"
                                         alt="{{ $book->title }}">
                                </a>

                                <div class="p-4 flex flex-col justify-start overflow-hidden">
                                    <a href="{{ route('books.show', $book->slug) }}" class="text-lg font-semibold text-gray-900 hover:text-green-700 truncate">
                                        {{ $book->title }}
                                    </a>
                                    <p class="text-sm text-gray-600 mt-1 truncate">
                                        {{ $book->author }}
                                    </p>
                                    <p class="text-sm text-gray-700 mt-2 line-clamp-2">
                                        {{ Str::limit($book->description, 100) }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">
                                Belum ada buku untuk direkomendasikan.
                                @if(auth()->user()->is_admin ?? false)
                                    <a href="{{ route('admin.books.create') }}" class="text-green-700 hover:underline">
                                        Tambah buku baru di Admin Panel?
                                    </a>
                                @endif
                            </p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
