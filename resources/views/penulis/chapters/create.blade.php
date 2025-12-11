<x-app-layout>
    <h1>Tambah Chapter Baru: {{ $book->title }}</h1>

    <form action="{{ route('penulis.chapters.store', $book->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="chapter_number" class="form-label">Nomor Chapter</label>
            <input type="number" name="chapter_number" id="chapter_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Judul Chapter</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Isi Chapter</label>
            <textarea name="content" id="content" class="form-control" rows="10" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('penulis.chapters.index', $book->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</x-app-layout>
