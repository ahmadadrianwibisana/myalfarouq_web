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
        'open_trip_id', // For Open Trip
        'private_trip_id', // For Private Trip
        'status',
        'tanggal_pemesanan',
        'alasan_batal'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with OpenTrip
    public function openTrip()
    {
        return $this->belongsTo(OpenTrip::class, 'open_trip_id');
    }

    // Relationship with PrivateTrip
    public function privateTrip()
    {
        return $this->belongsTo(PrivateTrip::class, 'private_trip_id');
    }
}
