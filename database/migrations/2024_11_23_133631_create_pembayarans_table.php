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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained()->onDelete('cascade');
            $table->string('bukti_pembayaran');
            $table->timestamp('tanggal_pembayaran');
            $table->string('jumlah_pembayaran');
            $table->enum('status_pembayaran', ['pending', 'success', 'failed'])->default('pending'); // Add enum column
            $table->string('alasan_gagal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
