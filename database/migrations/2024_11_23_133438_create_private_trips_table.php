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
        Schema::create('private_trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();  // Allow null
            $table->string('no_telepon');
            $table->string('nama_trip');
            $table->string('destinasi');
            $table->date('tanggal_pergi');
            $table->date('tanggal_kembali');
            $table->string('star_point');
            $table->string('jumlah_peserta');
            $table->string('deskripsi_trip');
            $table->decimal('harga', 10, 2);
            $table->date('tanggal_pengajuan'); // Automatically set
            $table->date('tanggal_disetujui')->nullable(); // Set when status is approved
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->string('image')->nullable();
            $table->text('keterangan_ditolak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_trips');
    }
};
