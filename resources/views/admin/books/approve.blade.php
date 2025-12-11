<x-app-layout>
    <div class="p-6 bg-white shadow rounded-lg">
        <h2 class="text-xl font-semibold text-green-700 mb-4">Persetujuan Buku</h2>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Judul</th>
                    <th class="p-2 border">Penulis</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td class="p-2 border">{{ $book->title }}</td>
                        <td class="p-2 border">{{ $book->user->name }}</td>
                        <td class="p-2 border flex gap-2">

                            <!-- Approve -->
                            <form action="{{ route('admin.books.approve.action', $book) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="bg-green-600 text-white px-3 py-1 rounded">
                                    Approve
                                </button>
                            </form>

                            <!-- Reject -->
                            <form action="{{ route('admin.books.reject', $book) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="rejected_reason" value="Tidak sesuai ketentuan">
                                <button class="bg-red-600 text-white px-3 py-1 rounded">
                                    Reject
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-2 border text-center" colspan="3">Tidak ada buku pending</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>
