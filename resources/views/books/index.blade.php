<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 dark:text-gray-200 leading-tight">
            {{ __('Katalog Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Grid untuk menampilkan buku -->
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                        
                        <!-- Loop (ulangi) untuk setiap buku -->
                        @forelse ($books as $book)
                            <a href="{{ route('books.show', $book) }}" class="block group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105">
                                
                                <!-- 
                                  INI YANG DIUBAH:
                                  h-72 (Tinggi statis) -> aspect-[2/3] (Rasio 2:3)
                                -->
                                <img src="{{ asset('storage/' . $book->cover_path) }}" 
                                     alt="{{ $book->title }}" 
                                     class="w-full object-cover aspect-[2/3]">
                                
                                <!-- Judul (muncul di bawah) -->
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black via-black/70 to-transparent">
                                    <h3 class="text-md font-semibold text-white truncate group-hover:whitespace-normal group-hover:line-clamp-2">{{ $book->title }}</h3>
                                    <p class="text-sm text-gray-300">{{ $book->author }}</p>
                                </div>
                            </a>
                        @empty
                            <!-- Jika tidak ada buku sama sekali -->
                            <p class="col-span-full text-center text-gray-500">
                                Belum ada buku di katalog ini.
                            </p>
                        @endforelse

                    </div>

                    <!-- Link Paginasi (Halaman 1, 2, 3...) -->
                    <div class="mt-8">
                        {{ $books->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>