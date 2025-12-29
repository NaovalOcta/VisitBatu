<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trip;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    // Menampilkan daftar semua post (terutama yang pending)
    public function index()
    {
        $posts = Post::with('user')
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')") // Pending paling atas
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    // Setujui Postingan
    public function approve(Post $post)
    {
        $post->update(['status' => 'approved']);
        return back()->with('success', 'Postingan berhasil disetujui dan ditayangkan.');
    }

    // Tolak Postingan
    public function reject(Post $post)
    {
        $post->update(['status' => 'rejected']);
        return back()->with('error', 'Postingan ditolak.');
    }
}
