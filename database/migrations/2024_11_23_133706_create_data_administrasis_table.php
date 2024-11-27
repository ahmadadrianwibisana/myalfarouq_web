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
        Schema::create('data_administrasis', function (Blueprint $table) {
            $table->id();
            $table->enum('trip_type', ['open_trip', 'private_trip']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi dengan pengguna
            
            // Kolom untuk open_trip_id jika trip_type adalah open_trip
            $table->foreignId('open_trip_id')->nullable()->constrained('open_trips')->onDelete('cascade');
            
            // Kolom untuk private_trip_id jika trip_type adalah private_trip
            $table->foreignId('private_trip_id')->nullable()->constrained('private_trips')->onDelete('cascade');
            
            $table->foreignId('pemesanan_id')->constrained()->onDelete('cascade'); // Relasi dengan pemesanan
            $table->string('file_dokumen'); // Menyimpan nama file dokumen yang diupload
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status dokumen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_administrasis');
    }
};
