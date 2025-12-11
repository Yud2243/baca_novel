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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();

            // Relasi ke buku
            $table->foreignId('book_id')
                ->constrained('books')
                ->cascadeOnDelete();

            // Judul bab
            $table->string('title');

            // Nomor bab (1, 2, 3...)
            $table->integer('chapter_number');

            // Konten bab
            $table->longText('content');

            // Untuk memastikan tidak ada dua bab nomor sama di satu buku
            $table->unique(['book_id', 'chapter_number']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
