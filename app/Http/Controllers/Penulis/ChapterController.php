<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    public function create(Book $book)
    {
        abort_unless($book->user_id === Auth::id(), 403);
        return view('penulis.chapters.create', compact('book'));
    }

    public function store(Request $request, Book $book)
    {
        abort_unless($book->user_id === Auth::id(), 403);

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $nextNumber = $book->chapters()->max('chapter_number') + 1;

        Chapter::create([
            'book_id'        => $book->id,
            'title'          => $request->title,
            'content'        => $request->content,
            'chapter_number' => $nextNumber ?: 1,
        ]);

        return redirect()
            ->route('penulis.books.show', $book)
            ->with('success', 'Chapter berhasil ditambahkan.');
    }

    public function edit(Book $book, Chapter $chapter)
    {
        abort_unless(
            $book->user_id === Auth::id() &&
            $chapter->book_id === $book->id,
            403
        );

        return view('penulis.chapters.edit', compact('book', 'chapter'));
    }

    public function update(Request $request, Book $book, Chapter $chapter)
    {
        abort_unless(
            $book->user_id === Auth::id() &&
            $chapter->book_id === $book->id,
            403
        );

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $chapter->update([
            'title'   => $request->title,
            'content' => $request->content,
        ]);

        return redirect()
            ->route('penulis.books.show', $book)
            ->with('success', 'Chapter diperbarui.');
    }

    public function destroy(Book $book, Chapter $chapter)
    {
        abort_unless(
            $book->user_id === Auth::id() &&
            $chapter->book_id === $book->id,
            403
        );

        $chapter->delete();

        return back()->with('success', 'Chapter dihapus.');
    }
}
