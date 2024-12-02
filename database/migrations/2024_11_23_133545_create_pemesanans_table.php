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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('trip_type', ['open_trip', 'private_trip']);
            $table->decimal('total_pembayaran', 10, 2)->nullable();
            
            // Kolom untuk open_trip_id jika trip_type adalah open_trip
            $table->foreignId('open_trip_id')->nullable()->constrained('open_trips')->onDelete('cascade');

            // Kolom untuk private_trip_id jika trip_type adalah private_trip
            $table->foreignId('private_trip_id')->nullable()->constrained('private_trips')->onDelete('cascade');
            
            $table->timestamp('tanggal_pemesanan');
            $table->enum('status', ['pending', 'terkonfirmasi', 'dibatalkan'])->default('pending');
            $table->string('alasan_batal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
