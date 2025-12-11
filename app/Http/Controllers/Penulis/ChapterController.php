<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    // Daftar semua chapter dari buku milik penulis
    public function index(Book $book)
    {
        if($book->user_id !== Auth::id()) abort(403);
        $chapters = $book->chapters;
        return view('penulis.chapters.index', compact('book', 'chapters'));
    }

    // Form tambah chapter baru
    public function create(Book $book)
    {
        if($book->user_id !== Auth::id()) abort(403);
        return view('penulis.chapters.create', compact('book'));
    }

    // Simpan chapter baru
    public function store(Request $request, Book $book)
    {
        if($book->user_id !== Auth::id()) abort(403);

        $book->chapters()->create([
            'title' => $request->title,
            'content' => $request->content,
            'chapter_number' => $request->chapter_number,
            'status' => 'pending', // harus divalidasi admin
        ]);

        return redirect()->route('penulis.chapters.index', $book->id);
    }

    // Form edit chapter
    public function edit(Book $book, Chapter $chapter)
    {
        if($book->user_id !== Auth::id() || $chapter->book_id !== $book->id) abort(403);
        return view('penulis.chapters.edit', compact('book', 'chapter'));
    }

    // Update chapter
    public function update(Request $request, Book $book, Chapter $chapter)
    {
        if($book->user_id !== Auth::id() || $chapter->book_id !== $book->id) abort(403);

        $chapter->update([
            'title' => $request->title,
            'content' => $request->content,
            'chapter_number' => $request->chapter_number,
            'status' => 'pending', // harus divalidasi ulang
        ]);

        return redirect()->route('penulis.chapters.index', $book->id);
    }

    // Hapus chapter
    public function destroy(Book $book, Chapter $chapter)
    {
        if($book->user_id !== Auth::id() || $chapter->book_id !== $book->id) abort(403);
        $chapter->delete();
        return redirect()->route('penulis.chapters.index', $book->id);
    }
}
