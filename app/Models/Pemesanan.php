<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trip_type',
        'trip_id', // pastikan trip_id ada untuk merujuk trip
        'status',
        'tanggal_pemesanan',
    ];
}
