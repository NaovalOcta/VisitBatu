<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip; // Menggunakan Model yang sudah ada
use App\Models\Post; // Menggunakan Model yang sudah ada
use App\Models\Category;

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

    public function trips(Request $request)
    {
        $query = Trip::query();

        // Ambil data kategori untuk ditampilkan di sidebar filter
        $categories = Category::all();

        // 1. Filter Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // 2. Filter Kategori
        if ($request->has('categories')) {
            $query->whereIn('category_id', (array)$request->categories);
        }

        // 3. Filter Harga
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 4. LOGIKA SORTING (Baru Ditambahkan)
        $sort = $request->input('sort', 'rekomendasi'); // Default ke 'rekomendasi' jika kosong

        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'rekomendasi':
            default:
                $query->orderBy('title', 'asc');
                break;
        }

        $trips = $query->paginate(8)->withQueryString();

        return view('trips_page', compact('trips', 'categories'));
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
