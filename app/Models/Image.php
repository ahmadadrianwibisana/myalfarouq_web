<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['artikel_id', 'image_path'];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class);
    }
}
