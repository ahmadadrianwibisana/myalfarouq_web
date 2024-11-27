<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'adminbesar_id',
        'judul_artikel',
        'deskripsi',
        'tanggal_publish',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
