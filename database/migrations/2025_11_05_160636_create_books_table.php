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

            // Pemilik buku (penulis yang membuat)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Judul dan slug
            $table->string('title');
            $table->string('slug')->unique();

            // Deskripsi & cover
            $table->text('description')->nullable();
            $table->string('cover_path')->nullable();

            // Status verifikasi admin
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');

            // Alasan penolakan bila ditolak admin
            $table->text('rejected_reason')->nullable();

            // Timestamps
            $table->timestamps();
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
