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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id(); // kolom id, primary key
            $table->foreignId('adminbesar_id')->constrained('admin_besars')->onDelete('cascade'); // foreign key yang mengarah ke admin_besars
            $table->string('judul_artikel'); // kolom untuk judul artikel
            $table->string('deskripsi'); // kolom untuk deskripsi artikel
            $table->date('tanggal_publish')->nullable(); // kolom untuk tanggal publikasi, bisa kosong
            $table->timestamps(); // kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};


