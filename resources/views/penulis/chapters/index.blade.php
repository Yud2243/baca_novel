<x-app-layout>
    <h1>Chapter Buku: {{ $book->title }}</h1>
    <a href="{{ route('penulis.chapters.create', $book->id) }}" class="btn btn-success">Tambah Chapter Baru</a>
    
    @if($chapters->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chapters as $chapter)
                    <tr>
                        <td>{{ $chapter->chapter_number }}</td>
                        <td>{{ $chapter->title }}</td>
                        <td>{{ ucfirst($chapter->status) }}</td>
                        <td>
                            <a href="{{ route('penulis.chapters.edit', [$book->id, $chapter->id]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('penulis.chapters.destroy', [$book->id, $chapter->id]) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Hapus chapter ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada chapter.</p>
    @endif
</x-app-layout>
