<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-green-700 dark:text-gray-700 leading-tight">
                {{ __('Manajemen Novel') }}
            </h2>
            <div class="w-26 h-1 bg-green-700 rounded-full mt-2"></div>

            <a href="{{ route('admin.books.create') }}" 
               class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-400">
                Tambah Buku Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Container utama — TANPA background hijau -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg">

                @if (session('success'))
                    <div class="p-4 bg-green-100 dark:bg-green-800 border-b border-green-800 dark:border-green-700">
                        <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="p-6 text-green-800 dark:text-gray-100">

                    <!-- BACKGROUND HIJAU HANYA DI PADA BAGIAN TABEL -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-black bg-green-700 dark:bg-green-700 dark:hover:bg-green-600">
                        <table class="min-w-full divide-y divide-green-700 dark:divide-gray-900 text-sm">
                            <thead class="dark:bg-green-900">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 dark:text-gray-300 uppercase tracking-wider">Sampul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 dark:text-gray-300 uppercase tracking-wider">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 dark:text-gray-300 uppercase tracking-wider">Penulis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-green-800 dark:divide-gray-700">
                                
                                @forelse ($books as $book)
                                    <tr class="hover:bg-green-600/40 dark:hover:bg-green-700/40">
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
                                            <div class="text-sm font-medium text-white dark:text-white">{{ $book->title }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-300 dark:text-gray-300">{{ $book->author }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                            <a href="{{ route('admin.books.chapters.index', $book) }}" 
                                               class="text-green-300 hover:text-green-100 dark:text-green-200 dark:hover:text-green-100">
                                                Kelola Bab
                                            </a>

                                            <a href="{{ route('admin.books.edit', $book) }}" 
                                               class="ml-4 text-yellow-400 hover:text-yellow-200 dark:text-yellow-300 dark:hover:text-yellow-100">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" 
                                                  class="inline-block ml-4"
                                                  onsubmit="return confirm('Anda yakin ingin menghapus buku ini? SEMUA BAB akan ikut terhapus!');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-400 hover:text-red-200 dark:text-red-300 dark:hover:text-red-100">
                                                    Hapus
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-gray-200 dark:text-gray-400">
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
