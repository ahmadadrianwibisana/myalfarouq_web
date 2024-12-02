<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Riwayat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemesanan_id',
        'pembayaran_id',
        'data_administrasi_id',
        'tanggal_riwayat',
    ];

    /**
     * Relasi dengan tabel Pemesanan
     */
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    /**
     * Relasi dengan tabel Pembayaran
     */
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    /**
     * Relasi dengan tabel Data Administrasi
     */
    public function dataAdministrasi()
    {
        return $this->belongsTo(DataAdministrasi::class);
    }
}