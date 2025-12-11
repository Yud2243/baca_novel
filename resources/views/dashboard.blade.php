<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Banner Utama -->
            <!-- (Assuming this is empty or removed as per your snippet) -->

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

                    <!-- Conditional for penulis_status (moved and fixed here) -->
                    
               @php $user = auth()->user(); @endphp

            @if($user->role === 'user')
             @if($user->penulis_status === 'none')
            <a href="{{ route('penulis.apply.create') }}" 
            class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors duration-200 shadow-sm">Ajukan Jadi Penulis</a>
            @elseif($user->penulis_status === 'pending')
            <div class="text-yellow-600 font-semibold">
            Pengajuan Penulis Sedang Diproses Admin
            </div>
        @endif
    @endif

                    
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