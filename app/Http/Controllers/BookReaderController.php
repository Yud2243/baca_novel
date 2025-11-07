<?php

namespace App\Http\Controllers;

use App\Models\Book; // Import Book
use Illuminate\Http\Request;

class BookReaderController extends Controller
{
    /**
     * Menampilkan Halaman Beranda (Dashboard)
     * Fungsi ini mengambil data "Rekomendasi" dari database.
     */
    public function beranda()
    {
        // 1. Ambil 6 buku terbaru untuk bagian "Rekomendasi"
        $rekomendasiBooks = Book::latest()->take(6)->get();

        // 2. Arahkan ke view 'dashboard' dan kirim datanya
        return view('dashboard', [
            'books' => $rekomendasiBooks
        ]);
    }

    /**
     * Menampilkan Halaman Katalog (Semua Buku)
     */
    public function index()
    {
        $books = Book::latest()->paginate(12);
        return view('books.index', [
            'books' => $books
        ]);
    }

    /**
     * Menampilkan Halaman Detail (Satu Buku)
     */
    public function show(Book $book)
    {
        // Akan kita isi nanti
    }

    /**
     * Menampilkan Halaman Baca (Satu Bab)
     */
    public function showChapter(Book $book, $chapter_number)
    {
        // Akan kita isi nanti
    }
}