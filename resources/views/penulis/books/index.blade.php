<x-app-layout>
    <h1>Buku Saya</h1>
    <a href="{{ route('penulis.books.create') }}" class="btn btn-success">Tambah Buku Baru</a>

    @if($books->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ ucfirst($book->status) }}</td>
                        <td>
                            <a href="{{ route('penulis.books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('penulis.books.destroy', $book->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Hapus buku ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada buku.</p>
    @endif
</x-app-layout>
