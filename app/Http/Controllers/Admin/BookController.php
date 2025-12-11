<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // PENTING: Untuk hapus file

class BookController extends Controller
{
    /**
     * Menampilkan daftar semua buku (Read).
     */
    public function index()
    {
        $books = Book::latest()->paginate(10); 
        return view('admin.books.index', [
            'books' => $books
        ]);
    }

    /**
     * Menampilkan form untuk membuat buku baru (Create - Form).
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Menyimpan buku baru ke database (Create - Logic).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_path' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $request->file('cover_path')->store('covers', 'public');

        Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'description' => $validated['description'],
            'cover_path' => $path,
            'slug' => Str::slug($validated['title']), 
        ]);

        return redirect()->route('admin.books.index')
                         ->with('success', 'Buku baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu buku.
     */
    public function show(Book $book)
    {
        // Redirect ke halaman kelola bab
        return redirect()->route('admin.books.chapters.index', $book);
    }

    /**
     * Menampilkan form untuk mengedit buku (Update - Form).
     */
    public function edit(Book $book)
    {
        // Mengarahkan ke view edit dengan data buku
        return view('admin.books.edit', ['book' => $book]);
    }

    /**
     * Meng-update data buku di database (Update - Logic).
     */
    public function update(Request $request, Book $book)
    {
        // Validasi
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books,title,' . $book->id, // Unik, kecuali untuk dirinya sendiri
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Boleh null (tidak ganti sampul)
        ]);

        // Cek jika ada gambar sampul baru di-upload
        if ($request->hasFile('cover_path')) {
            // 1. Hapus gambar lama
            if ($book->cover_path) {
                Storage::disk('public')->delete($book->cover_path);
            }
            // 2. Upload gambar baru
            $path = $request->file('cover_path')->store('covers', 'public');
            $validated['cover_path'] = $path; // Ganti path di data tervalidasi
        }

        // Update slug jika judul berubah
        $validated['slug'] = Str::slug($validated['title']);

        // Update data buku di database
        $book->update($validated);

        return redirect()->route('admin.books.index')
                         ->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Menghapus buku dari database (Delete).
     */
    public function destroy(Book $book)
    {
        // 1. Hapus gambar sampul dari storage
        if ($book->cover_path) {
            Storage::disk('public')->delete($book->cover_path);
        }

        // 2. Hapus data buku (bersama bab-babnya, krn 'onDelete('cascade')' di migrasi)
        $book->delete();

        return redirect()->route('admin.books.index')
                         ->with('success', 'Buku berhasil dihapus!');
    }
    public function adminIndex()
{
    $books = Book::with('user')->latest()->get();

    return view('admin.books.index', compact('books'));
}

public function approve(Book $book)
{
    $book->update([
        'status' => 'approved',
        'rejected_reason' => null
    ]);

    return redirect()->back()->with('success', 'Buku berhasil disetujui!');
}

public function reject(Request $request, Book $book)
{
    $request->validate([
        'rejected_reason' => 'required'
    ]);

    $book->update([
        'status' => 'rejected',
        'rejected_reason' => $request->rejected_reason
    ]);

    return redirect()->back()->with('success', 'Buku ditolak!');
}

}