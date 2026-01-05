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
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
