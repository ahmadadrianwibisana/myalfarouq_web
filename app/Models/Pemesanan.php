<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
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
        'alasan_batal',
        'total_pembayaran',
        'tour_gate', // Add this line
        'jumlah_peserta', // Add jumlah_peserta here
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function openTrip()
    {
        return $this->belongsTo(OpenTrip::class, 'open_trip_id');
    }

    public function privateTrip()
    {
        return $this->belongsTo(PrivateTrip::class, 'private_trip_id');
    }

    public function dataAdministrasi()
    {
        return $this->hasMany(DataAdministrasi::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public static function validate($data)
    {
        if ($data['trip_type'] === 'open_trip' && empty($data['jumlah_peserta'])) {
            throw new ValidationException('Jumlah peserta harus diisi untuk open trip.');
        }

        // Tambahkan validasi lain sesuai kebutuhan
    }
}
