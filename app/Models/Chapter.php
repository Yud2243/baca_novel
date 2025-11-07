<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo

class Chapter extends Model
{
    use HasFactory;

    /**
     * Mass-assignment protection.
     * Kolom ini BOLEH diisi saat menggunakan ::create()
     */
    protected $fillable = [
        'book_id',
        'title',
        'chapter_number',
        'content',
    ];

    /**
     * Relasi: Satu Bab dimiliki oleh SATU Buku
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}