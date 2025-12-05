<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookController extends Controller
{
    // Daftar semua buku milik penulis ini
    public function index()
    {
        $books = Auth::user()->books; // hanya buku milik penulis
        return view('penulis.books.index', compact('books'));
    }

    // Form tambah buku baru
    public function create()
    {
        return view('penulis.books.create');
    }

    // Simpan buku baru ke database
    public function store(Request $request)
    {
        $book = Auth::user()->books()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'status' => 'pending', // harus divalidasi admin
        ]);
        return redirect()->route('penulis.books.index');
    }

    // Form edit buku
    public function edit(Book $book)
    {
        if ($book->user_id !== Auth::id()) abort(403);
        return view('penulis.books.edit', compact('book'));
    }

    // Update buku
    public function update(Request $request, Book $book)
    {
        if ($book->user_id !== Auth::id()) abort(403);
        $book->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'status' => 'pending', // harus divalidasi ulang
        ]);
        return redirect()->route('penulis.books.index');
    }

    // Hapus buku
    public function destroy(Book $book)
    {
        if ($book->user_id !== Auth::id()) abort(403);
        $book->delete();
        return redirect()->route('penulis.books.index');
    }
}
