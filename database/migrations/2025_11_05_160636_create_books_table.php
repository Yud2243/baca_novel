<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Judul buku
        $table->string('author'); // Nama penulis
        $table->string('slug')->unique(); // Untuk URL (cth: /books/nama-buku-keren)
        $table->text('description')->nullable(); // Sinopsis/deskripsi
        $table->string('cover_path')->nullable(); // Path/link ke gambar sampul
        $table->timestamps(); // otomatis membuat created_at & updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
