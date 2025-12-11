<x-app-layout>
    <h1>Edit Chapter: {{ $chapter->title }} (Buku: {{ $book->title }})</h1>

    <form action="{{ route('penulis.chapters.update', [$book->id, $chapter->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="chapter_number" class="form-label">Nomor Chapter</label>
            <input type="number" name="chapter_number" id="chapter_number" class="form-control" value="{{ $chapter->chapter_number }}" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Judul Chapter</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $chapter->title }}" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Isi Chapter</label>
            <textarea name="content" id="content" class="form-control" rows="10" required>{{ $chapter->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('penulis.chapters.index', $book->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</x-app-layout>
