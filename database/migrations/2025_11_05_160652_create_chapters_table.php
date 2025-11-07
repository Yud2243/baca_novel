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
        
        // Ini adalah "kunci" yang menyambungkan bab ini ke bukunya
        $table->foreignId('book_id')
              ->constrained() // ke tabel 'books'
              ->onDelete('cascade'); // Jika buku dihapus, babnya ikut terhapus

        $table->string('title'); // Judul Bab (cth: "Bab 1: Awal Mula")
        $table->integer('chapter_number'); // Untuk mengurutkan (1, 2, 3...)
        
        // Tempat menyimpan isi novel. longText() bisa muat sangat banyak teks.
        $table->longText('content'); 
        
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
