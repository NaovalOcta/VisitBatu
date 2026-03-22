<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'category_id',
        'slug',
        'location',
        'description',
        'price',
        'duration',
        'thumbnail',
        'whatsapp_number',
        'map_iframe',
        'latitude',
        'longitude',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
