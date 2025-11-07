<x-app-layout>
    <!-- 
      Tidak ada <x-slot name="header">
      Ini akan MENGHILANGKAN bar putih di bawah navbar hijau,
      persis seperti mockup Anda.
    -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- 
              PANEL 1: "NOVEL IKLAN" (Sesuai Mockup)
              Panel terpisah di atas, rounded, dengan bayangan.
            -->
            <div class="mb-8 shadow-lg sm:rounded-lg overflow-hidden">
                <a href="#">
                    <!-- Placeholder untuk "Novel Iklan" Anda -->
                    <img src="https://placehold.co/1200x400/166534/e2e8f0?text=Putri+Untuk+Jagoan&font=lato" 
                         alt="Novel Iklan" 
                         class="w-full h-auto object-cover">
                </a>
            </div>

            <!-- 
              PANEL 2: "REKOMENDASI" (Sesuai Mockup)
              Panel 'bg-white' terpisah di bawahnya.
            -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    
                    <!-- Judul Bagian "Rekomendasi" (Sesuai Mockup) -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                            Rekomendasi
                        </h2>
                        <!-- Garis bawah hijau (Sesuai Mockup) -->
                        <div class="w-24 h-1 bg-green-700 rounded-full mt-2"></div>
                    </div>

                    <!-- 
                      Grid Daftar Buku (DATA DIAMBIL DARI DATABASE)
                      Looping variabel $books yang dikirim dari Controller.
                    -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        @forelse ($books as $book)
                            <!-- Item Buku (Sesuai Mockup) -->
                            <div class="flex bg-gray-50 dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-[1.03]">
                                
                                <!-- 
                                  GAMBAR SAMPUL (PERBAIKAN TYPO)
                                  Kesalahan 'storage/'' ...' DIHAPUS.
                                -->
                                <a href="#" class="flex-shrink-0">
                                    <img class="w-28 h-40 object-cover" 
                                         src="{{ asset('storage/' . $book->cover_path) }}" 
                                         alt="{{ $book->title }}">
                                </a>
                                
                                <!-- Detail Teks (Dari Database) -->
                                <div class="p-4 flex flex-col justify-start overflow-hidden">
                                    <a href="#" class="text-lg font-semibold text-gray-900 dark:text-white hover:text-green-700 truncate">
                                        {{ $book->title }}
                                    </a>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 truncate">
                                        {{ $book->author }}
                                    </p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-2 line-clamp-2">
                                        {{ $book->description }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <!-- 
                              LINK ADMIN (PERBAIKAN TYPO)
                              Kesalahan 'route(''admin...'')' DIHAPUS.
                            -->
                            <p class="col-span-full text-center text-gray-500">
                                Belum ada buku untuk direkomendasikan.
                                <a href="{{ route('admin.books.create') }}" class="text-green-700 hover:underline">Tambah buku baru di Admin Panel?</a>
                            </p>
                        @endforelse

                    </div> <!-- End Grid -->

                </div> <!-- End Padding Konten -->
            </div> <!-- End Panel Putih "Rekomendasi" -->
        </div>
    </div>
</x-app-layout>