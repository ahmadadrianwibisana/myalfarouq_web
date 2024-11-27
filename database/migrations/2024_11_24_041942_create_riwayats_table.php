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
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pemesanan_id')->constrained('pemesanans')->onDelete('cascade');
            $table->enum('trip_type', ['open_trip', 'private_trip']);
            $table->enum('status_pembayaran', ['pending', 'terbayar', 'gagal'])->default('pending');
            $table->enum('status_administrasi', ['pending', 'approved', 'rejected'])->default('pending');
            $table->decimal('jumlah_pembayaran', 10, 2); // Jumlah pembayaran
            $table->timestamp('tanggal_pembayaran')->nullable();
            $table->datetime('tanggal_riwayat'); // Menggunakan datetime
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
