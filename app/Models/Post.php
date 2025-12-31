<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'trip_id',
        'title',
        'slug',
        'content',
        'image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
