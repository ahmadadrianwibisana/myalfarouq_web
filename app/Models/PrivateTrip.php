<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_telepon',
        'nama_trip',
        'destinasi',
        'tanggal_pergi',
        'tanggal_kembali',
        'star_point',
        'jumlah_peserta',
        'deskripsi_trip',
        'harga',
        'tanggal_pengajuan',
        'tanggal_disetujui',
        'status',
        'image'
    ];
}
