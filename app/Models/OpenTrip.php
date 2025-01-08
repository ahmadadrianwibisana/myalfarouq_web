<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenTrip extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_paket',
        'destinasi',
        'tanggal_berangkat',
        'tanggal_pulang',
        'lama_keberangkatan',
        'harga',
        'kuota',
        'deskripsi_trip',
        'image',
        'star_point',
        'file',
        'include',
        'exclude',
        'view_count' // Tambahkan view_count ke fillable
    ];

      // Method untuk menambah jumlah view_count
      public function incrementViewCount()
      {
          $this->increment('view_count'); // Tambah 1 ke kolom view_count
      }

    
}
