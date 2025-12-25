<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Auth::user()->books;
        return view('penulis.books.index', compact('books'));
    }

    public function create()
    {
        return view('penulis.books.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'author'      => 'required|string|max:255',
        'description' => 'nullable|string',
        'cover_path'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $coverPath = null;

    if ($request->hasFile('cover_path')) {
        $coverPath = $request->file('cover_path')
                             ->store('covers', 'public');
    }

    Auth::user()->books()->create([
        'title'       => $validated['title'],
        'author'      => $validated['author'],
        'description' => $validated['description'] ?? null,
        'cover_path'  => $coverPath,
        'status'      => 'pending',
    ]);

    return redirect()
        ->route('penulis.books.index')
        ->with('success', 'Buku berhasil dibuat dan menunggu validasi admin.');
}


    public function show(Book $book)
    {
        abort_unless($book->user_id === Auth::id(), 403);

        $book->load('chapters');

        return view('penulis.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
    if ($book->user_id !== Auth::id()) {
        abort(403);
    }

    return view('penulis.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
{
    if ($book->user_id !== Auth::id()) {
        abort(403);
    }

    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'cover_path'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // 🔹 Jika upload cover baru
    if ($request->hasFile('cover_path')) {

        // hapus cover lama kalau ada
        if ($book->cover_path && Storage::disk('public')->exists($book->cover_path)) {
            Storage::disk('public')->delete($book->cover_path);
        }

        $validated['cover_path'] = $request->file('cover_path')
                                           ->store('covers', 'public');
    }

    $book->update($validated);

    return redirect()
        ->route('penulis.books.show', $book)
        ->with('success', 'Buku berhasil diperbarui.');
}

    public function destroy(Book $book)
    {
        abort_unless($book->user_id === Auth::id(), 403);

        $book->delete();

        return redirect()
            ->route('penulis.books.index')
            ->with('success', 'Buku dihapus');
    }

}
