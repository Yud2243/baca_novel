<x-app-layout>
    <h1>Edit Buku</h1>

    <form action="{{ route('penulis.books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('penulis.books.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</x-app-layout>
