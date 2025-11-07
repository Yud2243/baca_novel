<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class BookReaderController extends Controller
{
    /**
     * 🏠 Halaman Beranda (Dashboard Pembaca)
     * Menampilkan beberapa buku rekomendasi.
     */
    public function beranda()
{
    // Ambil 6 buku terbaru
    $rekomendasiBooks = \App\Models\Book::latest()->take(6)->get();

    // Kirim ke view 'dashboard'
    return view('dashboard', [
        'books' => $rekomendasiBooks,
    ]);
}


    /**
     * 📚 Halaman Daftar Semua Buku (Katalog)
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // Jika ada pencarian
        if ($request->has('q') && $request->q !== '') {
            $query->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('author', 'like', '%' . $request->q . '%');
        }

        $books = $query->latest()->paginate(12);

        return view('books.index', [
            'books' => $books,
        ]);
    }

    /**
     * 📖 Halaman Detail Buku
     * Menampilkan informasi buku & daftar bab-nya.
     */
    public function show(Book $book)
    {
        // Ambil daftar bab dari relasi jika sudah dibuat
        $chapters = $book->chapters()->orderBy('chapter_number')->get();

        return view('books.show', [
            'book' => $book,
            'chapters' => $chapters,
        ]);
    }

    /**
     * 📘 Halaman Baca Bab
     * Menampilkan isi satu bab berdasarkan nomor urut.
     */
    public function showChapter(Book $book, $chapter_number)
    {
        // Ambil bab berdasarkan nomor urut
        $chapter = $book->chapters()
                        ->where('chapter_number', $chapter_number)
                        ->firstOrFail();

        return view('books.chapter', [
            'book' => $book,
            'chapter' => $chapter,
        ]);
    }
}
