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
        Schema::create('open_trips', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->string('destinasi');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->string('lama_keberangkatan');
            $table->decimal('harga', 10, 2);
            $table->string('kuota');
            $table->string('deskripsi_trip');
            $table->string('image')->nullable();
            $table->string('star_point');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_trips');
    }
};
