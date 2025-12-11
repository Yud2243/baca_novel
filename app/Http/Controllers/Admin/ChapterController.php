<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book; // Import Book
use App\Models\Chapter; // Import Chapter
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Menampilkan daftar bab untuk BUKU TERTENTU.
     */
    public function index(Book $book)
    {
        // Kita ambil bab-bab HANYA untuk buku ini
        // 'chapters' adalah nama relasi di Model Book
        $chapters = $book->chapters; 

        return view('admin.chapters.index', [
            'book' => $book,
            'chapters' => $chapters,
        ]);
    }

    /**
     * Menampilkan form untuk menambah bab baru.
     */
    public function create(Book $book)
    {
        // Kita perlu $book agar tahu bab ini untuk buku apa
        return view('admin.chapters.create', ['book' => $book]);
    }

    /**
     * Menyimpan bab baru ke database.
     */
    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'chapter_number' => 'required|integer|min:1',
            'content' => 'required|string',
        ]);

        // 'chapters()' adalah relasi. Ini otomatis mengisi 'book_id'
        $book->chapters()->create($validated);

        return redirect()->route('admin.books.chapters.index', $book)
                         ->with('success', 'Bab baru berhasil ditambahkan!');
    }

    /**
     * (Tidak dipakai, redirect ke index)
     */
    public function show(Book $book, Chapter $chapter)
    {
        return redirect()->route('admin.books.chapters.index', $book);
    }

    /**
     * Menampilkan form untuk mengedit bab.
     */
    public function edit(Book $book, Chapter $chapter)
    {
        // Pastikan bab itu milik buku itu (meski route binding sdh handle)
        if ($chapter->book_id !== $book->id) {
            abort(404);
        }

        return view('admin.chapters.edit', [
            'book' => $book,
            'chapter' => $chapter,
        ]);
    }

    /**
     * Meng-update bab di database.
     */
    public function update(Request $request, Book $book, Chapter $chapter)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'chapter_number' => 'required|integer|min:1',
            'content' => 'required|string',
        ]);

        $chapter->update($validated);

        return redirect()->route('admin.books.chapters.index', $book)
                         ->with('success', 'Data bab berhasil diperbarui!');
    }

    /**
     * Menghapus bab dari database.
     */
    public function destroy(Book $book, Chapter $chapter)
    {
        $chapter->delete();

        return redirect()->route('admin.books.chapters.index', $book)
                         ->with('success', 'Bab berhasil dihapus!');
    }
}