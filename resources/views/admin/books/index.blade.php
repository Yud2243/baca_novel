<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manajemen Buku') }}
            </h2>
            
            <!-- 
              TOMBOL INI DIGANTI: 
              bg-indigo-600 -> bg-green-600 
              hover:bg-indigo-700 -> hover:bg-green-700
            -->
            <a href="{{ route('admin.books.create') }}" class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-400">
                + Tambah Buku Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                @if (session('success'))
                    <div class="p-4 bg-green-100 dark:bg-green-800 border-b border-green-200 dark:border-green-700">
                        <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-750">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Sampul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Penulis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                
                                @forelse ($books as $book)
                                    <tr class="dark:hover:bg-gray-700">
                                        <td class="px-6 py-4">
                                            @if ($book->cover_path)
                                                <img src="{{ asset('storage/' . $book->cover_path) }}" 
                                                     alt="{{ $book->title }}" 
                                                     class="h-16 w-12 object-cover rounded-md shadow-lg">
                                            @else
                                                <div class="h-16 w-12 rounded-md bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                    <span class="text-xs text-gray-500">No Img</span>
                                                </div>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $book->title }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600 dark:text-gray-300">{{ $book->author }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            
                                            <a href="{{ route('admin.books.chapters.index', $book) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-200">
                                                Kelola Bab
                                            </a>

                                            <!-- 
                                              LINK INI DIGANTI:
                                              text-indigo-600 -> text-yellow-600 (Kuning)
                                            -->
                                            <a href="{{ route('admin.books.edit', $book) }}" class="ml-4 text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-200">
                                                Edit
                                            </a>
                                            
                                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Anda yakin ingin menghapus buku ini? SEMUA BAB akan ikut terhapus!');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">
                                                    Hapus
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                            Belum ada data buku.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>