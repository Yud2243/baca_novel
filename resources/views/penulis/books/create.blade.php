<x-app-layout>
    <h1>Tambah Buku Baru</h1>

    <form action="{{ route('penulis.books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('penulis.books.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</x-app-layout>
