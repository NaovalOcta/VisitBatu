<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTrips = Trip::count();
        $pendingPosts = Post::where('status', 'pending')->count();

        // Mengambil postingan blog yang butuh moderasi
        $moderationQueue = Post::where('status', 'pending')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalTrips', 'pendingPosts', 'moderationQueue'));
    }
}
