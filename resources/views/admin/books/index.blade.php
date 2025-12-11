<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-green-700 leading-tight">
                {{ __('Manajemen Novel') }}
            </h2>

            <div class="flex gap-2 items-center">
                <a href="{{ route('admin.dashboard') }}"  
                   class="py-2 px-4 bg-green-700 text-white rounded-lg text-sm font-medium 
                          hover:bg-green-800">
                    Kembali
                </a>

                <a href="{{ route('admin.books.create') }}" 
                   class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium 
                          hover:bg-green-700">
                    Tambah Buku Baru
                </a>
            </div>
        </div>

        <div class="h-1 bg-green-700 rounded-full mt-3"></div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg border border-green-100">

                @if (session('success'))
                    <div class="p-4 bg-green-50 border-b border-green-200">
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="p-6 text-gray-900">

                    <!-- Tabel -->
                    <table class="min-w-full border border-green-200 rounded-lg overflow-hidden text-sm">
                        <thead class="bg-green-50 border-b border-green-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase">Sampul</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase">Penulis</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-green-100">
                            @forelse ($books as $book)
                                <tr class="hover:bg-green-50 transition">
                                    <td class="px-6 py-4">
                                        @if ($book->cover_path)
                                            <img src="{{ asset('storage/' . $book->cover_path) }}" 
                                                 class="h-16 w-12 object-cover rounded-md shadow-sm">
                                        @else
                                            <div class="h-16 w-12 rounded-md bg-green-100 flex items-center justify-center">
                                                <span class="text-xs text-green-600">No Img</span>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 font-medium">{{ $book->title }}</td>
                                    <td class="px-6 py-4">{{ $book->user->name }}</td>

                                    <!-- STATUS -->
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-white text-xs font-semibold
                                            @if($book->status=='pending') bg-yellow-500
                                            @elseif($book->status=='approved') bg-green-600
                                            @else bg-red-600
                                            @endif">
                                            {{ ucfirst($book->status) }}
                                        </span>

                                        @if($book->status == 'rejected')
                                            <p class="text-xs text-red-700 mt-1">Alasan: {{ $book->rejected_reason }}</p>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 flex gap-2">

                                        <!-- Kelola Bab -->
                                        <a href="{{ route('admin.books.chapters.index', $book) }}" 
                                           class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                            Kelola Bab
                                        </a>

                                        <!-- EDIT -->
                                        <a href="{{ route('admin.books.edit', $book) }}" 
                                           class="px-3 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500 transition">
                                            Edit
                                        </a>

                                        <!-- HAPUS -->
                                        <form action="{{ route('admin.books.destroy', $book) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus buku ini? SEMUA bab akan terhapus!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                                Hapus
                                            </button>
                                        </form>

                                        <!-- APPROVE -->
                                        @if($book->status == 'pending')
                                            <form action="{{ route('admin.books.approve', $book->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" 
                                                    class="px-3 py-1 bg-green-700 text-white rounded hover:bg-green-800">
                                                    Approve
                                                </button>
                                            </form>

                                            <!-- REJECT BUTTON -->
                                            <button onclick="openRejectModal({{ $book->id }})"
                                                class="px-3 py-1 bg-red-700 text-white rounded hover:bg-red-800">
                                                Reject
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                        Belum ada data buku.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- MODAL REJECT -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">

        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-bold mb-2 text-red-700">Alasan Penolakan</h2>

            <form id="rejectForm" method="POST">
                @csrf

                <textarea name="rejected_reason" required rows="4"
                    class="w-full border p-2 rounded"
                    placeholder="Tuliskan alasan penolakan..."></textarea>

                <div class="flex justify-end mt-4 gap-2">
                    <button type="button" onclick="closeRejectModal()"
                        class="px-4 py-1 rounded border">
                        Batal
                    </button>

                    <button class="px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal(bookId) {
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectForm').action =
                `/admin/books/${bookId}/reject`;
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
