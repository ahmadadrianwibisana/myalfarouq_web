<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAdministrasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_type',
        'user_id',
        'trip_id',
        'file_dokumen',
        'status',
    ];
}
