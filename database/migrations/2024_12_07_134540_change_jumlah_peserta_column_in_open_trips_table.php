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
        Schema::table('open_trips', function (Blueprint $table) {
            $table->decimal('jumlah_peserta', 10, 2)->change(); // Mengubah tipe kolom jumlah_peserta menjadi decimal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('open_trips', function (Blueprint $table) {
            $table->string('jumlah_peserta')->change(); // Mengembalikan tipe kolom ke string
        });
    }
};
