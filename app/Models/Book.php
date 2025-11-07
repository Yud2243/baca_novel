<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // PENTING: Import HasMany

class Book extends Model
{
    use HasFactory;

    /**
     * Mass-assignment protection.
     * Kolom ini BOLEKEH diisi saat menggunakan Book::create()
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'cover_path',
        'slug',
    ];

    /**
     * INI ADALAH BAGIAN YANG HILANG/RUSAK
     * * Relasi: Satu Buku punya BANYAK Bab (Chapter)
     */
    public function chapters(): HasMany
    {
        // Urutkan otomatis berdasarkan nomor bab
        return $this->hasMany(Chapter::class)->orderBy('chapter_number', 'asc');
    }
}