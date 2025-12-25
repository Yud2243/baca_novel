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
    $rekomendasiBooks = Book::where('status', 'approved')
        ->latest()
        ->take(6)
        ->get();

    return view('dashboard', [
        'books' => $rekomendasiBooks,
    ]);
}



    /**
     * 📚 Halaman Daftar Semua Buku (Katalog)
     */
  public function index(Request $request)
{
    $query = Book::query()
        ->where('status', 'approved');

    // 🔍 SEARCH
    if ($request->filled('q')) {
        $search = $request->q;

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%");
        });
    }

    // PAGINATION (WAJIB supaya links() jalan)
    $books = $query->latest()->paginate(9)->withQueryString();

    return view('books.index', compact('books'));
}





    /**
     * 📖 Halaman Detail Buku
     * Menampilkan informasi buku & daftar bab-nya.
     */
   public function show(Book $book)
{
    abort_if($book->status !== 'approved', 404);

    $book->load('chapters');

    return view('books.show', compact('book'));
}


    /**
     * 📘 Halaman Baca Bab
     * Menampilkan isi satu bab berdasarkan nomor urut.
     */
   public function showChapter(Book $book, $chapter_number)
{
    abort_if($book->status !== 'approved', 404);

    $chapter = $book->chapters()
                    ->where('chapter_number', $chapter_number)
                    ->firstOrFail();

    return view('books.chapter', compact('book', 'chapter'));
}


}
