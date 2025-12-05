<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'penulis_status')) {
                $table->enum('penulis_status', ['none','pending','approved','rejected'])
                      ->default('none')
                      ->after('role');
            }

            if (!Schema::hasColumn('users', 'penulis_bio')) {
                $table->text('penulis_bio')->nullable()->after('penulis_status');
            }

            if (!Schema::hasColumn('users', 'penulis_sample')) {
                $table->string('penulis_sample')->nullable()->after('penulis_bio');
            }

            if (!Schema::hasColumn('users', 'penulis_note')) {
                $table->text('penulis_note')->nullable()->after('penulis_sample');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'penulis_note')) {
                $table->dropColumn('penulis_note');
            }
            if (Schema::hasColumn('users', 'penulis_sample')) {
                $table->dropColumn('penulis_sample');
            }
            if (Schema::hasColumn('users', 'penulis_bio')) {
                $table->dropColumn('penulis_bio');
            }
            if (Schema::hasColumn('users', 'penulis_status')) {
                $table->dropColumn('penulis_status');
            }
        });
    }
};
