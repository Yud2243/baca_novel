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
        $validated = $request->validate([
            'title'       => 'required',
            'author'      => 'required',
            'description' => 'nullable',
            'cover_path'  => 'nullable', // kalau pakai upload nanti tinggal diubah
        ]);

        Auth::user()->books()->create([
            'title'       => $validated['title'],
            'author'      => $validated['author'],
            'description' => $validated['description'] ?? null,
            'cover_path'  => $validated['cover_path'] ?? null,
            'slug'        => Str::slug($validated['title']),
            'status'      => 'pending', // menunggu validasi admin
        ]);

        return redirect()->route('penulis.books.index')
                         ->with('success', 'Buku berhasil dibuat dan menunggu validasi admin.');
    }

    public function edit($id)
{
    $book = Book::findOrFail($id);
    if ($book->user_id !== Auth::id()) abort(403);
    return view('penulis.books.edit', compact('book'));
}

public function update(Request $request, $id)
{
    $book = Book::findOrFail($id);
    if ($book->user_id !== Auth::id()) abort(403);
    // validasi & update...
}

public function destroy($id)
{
    $book = Book::findOrFail($id);
    if ($book->user_id !== Auth::id()) abort(403);
    $book->delete();
    return redirect()->route('penulis.books.index')->with('success', 'Buku dihapus');
}

}
