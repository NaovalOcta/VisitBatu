<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Satu kategori punya banyak trips
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
    