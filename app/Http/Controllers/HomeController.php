<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip; // Menggunakan Model yang sudah ada
use App\Models\Post; // Menggunakan Model yang sudah ada

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 Trip terbaru untuk Landing Page
        $trips = Trip::latest()->take(3)->get();

        // Ambil 2 Post terbaru yang statusnya 'approved'
        // 'user' diload agar nama penulis tidak query berulang (N+1 problem)
        $posts = Post::with('user')->approved()->latest()->take(2)->get();

        return view('welcome_page', compact('trips', 'posts'));
    }

    public function trips()
    {
        // Ambil semua trip dengan pagination (8 per halaman)
        $trips = Trip::latest()->paginate(8);
        return view('trips_page', compact('trips'));
    }

    public function showTrip(Trip $trip)
    {
        // Menampilkan detail trip (Anda perlu membuat view trips/show.blade.php nanti)
        return view('trips.show', compact('trip'));
    }

    public function blog()
    {
        // Ambil post yang approved, paginate 9 item
        $posts = Post::with('user', 'trip')->approved()->latest()->paginate(9);

        // Ambil item pertama sebagai Featured Post
        $featuredPost = $posts->first();

        return view('blog_page', compact('posts', 'featuredPost'));
    }

    public function showBlog(Post $post)
    {
        return view('blog.show', compact('post'));
    }
}
