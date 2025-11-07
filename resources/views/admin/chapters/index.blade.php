<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Kelola Bab untuk:') }}
                </h2>
                <!-- Tampilkan judul buku yang sedang dikelola -->
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $book->title }}</p>
            </div>
            <div>
                <a href="{{ route('admin.books.index') }}" class="py-2 px-4 bg-gray-600 text-white rounded-lg text-sm font-medium hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 mr-2">
                    &larr; Kembali ke Buku
                </a>
                <a href="{{ route('admin.books.chapters.create', $book) }}" class="py-2 px-4 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-400">
                    + Tambah Bab Baru
                </a>
            </div>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No. Bab</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul Bab</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                
                                @forelse ($chapters as $chapter)
                                    <tr class="dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $chapter->chapter_number }}</div>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600 dark:text-gray-300">{{ $chapter->title }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            
                                            <!-- Tombol Edit Bab -->
                                            <a href="{{ route('admin.books.chapters.edit', [$book, $chapter]) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                                Edit
                                            </a>
                                            
                                            <!-- Tombol Hapus Bab -->
                                            <form action="{{ route('admin.books.chapters.destroy', [$book, $chapter]) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Anda yakin ingin menghapus bab ini?');">
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
                                        <td colspan="3" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                            Belum ada bab untuk buku ini.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>