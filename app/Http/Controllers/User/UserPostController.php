<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\Trip;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserPostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->with('user', 'trip')->latest()->paginate(10);
        return view('user.posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['user', 'trip'])->firstOrFail();
        return view('user.posts.show', compact('post'));
    }

    public function create()
    {
        $trips = Trip::all();
        return view('user.posts.create', compact('trips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'trip_id' => 'required|exists:trips,id',
            'content' => 'required',
            'image'   => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ], [
            'title.unique' => 'Judul cerita ini sudah ada. Mohon gunakan judul yang lebih spesifik.',
            'trip_id.required' => 'Mohon pilih lokasi wisata yang Anda ceritakan.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        Post::create([
            'user_id' => Auth::id(),
            'trip_id' => $request->trip_id,
            'title'   => $request->title,
            'slug'    => $slug,
            'content' => $request->content,
            'image'   => $imagePath,
            'status'  => 'pending',
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Blog berhasil dibuat! Menunggu persetujuan admin.');
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit blog ini.');
        }

        $trips = Trip::all();
        return view('user.posts.edit', compact('post', 'trips'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title'   => 'required|string|max:255',
            'trip_id' => 'required|exists:trips,id',
            'content' => 'required',
            'image'   => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $data = [
            'trip_id' => $request->trip_id,
            'title'   => $request->title,
            'slug'    => $slug,
            'content' => $request->content,
            'status'  => 'pending',
        ];

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('user.dashboard')
            ->with('success', 'Blog berhasil diperbarui dan sedang menunggu persetujuan ulang.');
    }

    public function destroy(Post $post)
    {
        // Keamanan: Pastikan hanya pemilik yang bisa menghapus
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki otoritas untuk menghapus blog ini.');
        }

        // Hapus file gambar dari storage jika ada
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Hapus data dari database
        $post->delete();

        return redirect()->route('user.dashboard')
            ->with('success', 'Blog telah berhasil dihapus secara permanen.');
    }
}
