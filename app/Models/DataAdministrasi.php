<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAdministrasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemesanan_id',
        'file_dokumen',
        'status',
    ];

    // Relasi ke model Pemesanan

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

}