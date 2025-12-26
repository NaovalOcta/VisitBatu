<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'location',
        'description',
        'price',
        'duration',
        'thumbnail',
    ];
}
