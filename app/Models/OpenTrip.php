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
        'jumlah_peserta',
        'star_point'
    ];
}
