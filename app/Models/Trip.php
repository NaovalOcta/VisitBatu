<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'location',
        'description',
        'image',
        'price',
    ];
}
