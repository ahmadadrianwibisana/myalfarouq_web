<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Riwayat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pemesanan_id',
        'trip_type',
        'status_pembayaran',
        'status_administrasi',
        'jumlah_pembayaran',
        'tanggal_pembayaran',
        'tanggal_riwayat',
    ];

    /**
     * Relasi dengan tabel User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
        return $this->hasOne(Pembayaran::class);
    }

    /**
     * Relasi dengan tabel OpenTrip
     */
    public function openTrip()
    {
        return $this->belongsTo(OpenTrip::class, 'trip_type');
    }

    /**
     * Relasi dengan tabel PrivateTrip
     */
    public function privateTrip()
    {
        return $this->belongsTo(PrivateTrip::class, 'trip_type');
    }
}
