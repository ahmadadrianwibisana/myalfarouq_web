<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('open_trips', function (Blueprint $table) {
            $table->integer('jumlah_peserta')->default(0); // Adding jumlah_peserta column with default value 0
        });
    }
    
    public function down()
    {
        Schema::table('open_trips', function (Blueprint $table) {
            $table->dropColumn('jumlah_peserta');
        });
    }    
};
