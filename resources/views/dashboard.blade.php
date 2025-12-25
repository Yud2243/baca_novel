<x-app-layout>
    <div class="py-0 bg-green-50"> <!-- dari py-12 menjadi py-6 -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Rekomendasi -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-green-100">
                <div class="p-6 md:p-8 text-gray-800">

                    <!-- Judul -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-green-800">
                            Rekomendasi
                        </h2>
                        <div class="w-24 h-1 bg-green-600 rounded-full mt-2"></div>
                    </div>

                    @php $user = auth()->user(); @endphp

                    <!-- Fitur Ajukan Jadi Penulis -->
                    @if($user->role === 'user')
                        @if($user->penulis_status === 'none')
                            <a href="{{ route('penulis.apply.create') }}"
                               class="inline-block mb-6 py-2.5 px-5 bg-green-600 text-white rounded-xl text-sm font-semibold
                                      hover:bg-green-700 transition shadow-md">
                                Ajukan Jadi Penulis
                            </a>
                        @elseif($user->penulis_status === 'pending')
                            <div class="mb-6 text-yellow-600 font-semibold bg-yellow-50 px-4 py-3 rounded-xl">
                                Pengajuan Penulis Sedang Diproses Admin
                            </div>
                        @endif
                    @endif

                    <!-- Grid Buku -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($books as $book)
                            <div
                                class="flex bg-white rounded-2xl shadow-md overflow-hidden
                                       border border-green-100
                                       transition duration-300 hover:shadow-xl hover:-translate-y-1">

                                <a href="{{ route('books.show', $book->slug) }}" class="flex-shrink-0">
                                    <img class="w-28 h-40 object-cover"
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
                            <p class="col-span-full text-center text-gray-500">
                                Belum ada buku untuk direkomendasikan.
                            </p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
