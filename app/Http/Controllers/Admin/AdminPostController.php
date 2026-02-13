<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trip;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostStatusMail;

class AdminPostController extends Controller
{
    // Menampilkan daftar semua post (terutama yang pending)
    public function index()
    {
        $posts = Post::with('user', 'trip')
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    // Setujui Postingan
    public function approve(Post $post)
    {
        $post->update(['status' => 'approved']);

        // Kirim Email Notifikasi
        Mail::to($post->user->email)->send(new PostStatusMail($post, 'approved'));

        return back()->with('success', 'Postingan berhasil disetujui dan ditayangkan.');
    }

    // Tolak Postingan
    public function reject(Post $post)
    {
        $post->update(['status' => 'rejected']);

        // Kirim Email Notifikasi
        Mail::to($post->user->email)->send(new PostStatusMail($post, 'rejected'));

        return back()->with('error', 'Postingan ditolak.');
    }
}
