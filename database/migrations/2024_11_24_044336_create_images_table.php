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
        if (!Schema::hasTable('images')) {
            Schema::create('images', function (Blueprint $table) {
                $table->id(); // kolom id, primary key
            $table->foreignId('artikel_id')->constrained('artikels')->onDelete('cascade'); // foreign key yang mengarah ke artikel_id
            $table->string('image_path'); // kolom untuk path gambar
            $table->timestamps(); // kolom created_at dan updated_at
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
