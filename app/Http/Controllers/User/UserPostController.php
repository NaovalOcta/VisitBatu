<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class UserPostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->paginate(10);

        return view('user.posts.index', compact('posts'));
    }
    public function show(Post $post)
    {
        return view('user.posts.show', compact('post'));
    }

    public function create()
    {
        return view('user.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'image'   => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'slug'    => Str::slug($request->title) . '-' . time(), // Slug unik
            'content' => $request->content,
            'image'   => $imagePath,
            'status'  => 'pending', // Default status saat baru dibuat
        ]);

        return redirect()->route('user.dashboard_user')
            ->with('success', 'Blog berhasil dibuat! Menunggu persetujuan admin.');
    }

    // public function show($slug)
    // {
    //     // Mencari post berdasarkan slug, jika tidak ada akan muncul error 404
    //     $post = Post::where('slug', $slug)->with('user')->firstOrFail();

    //     // Mengembalikan view detail blog
    //     return view('user.posts.show', compact('post'));
    // }

    public function edit(Post $post)
    {
        // Keamanan: Pastikan hanya pemilik yang bisa mengedit
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit blog ini.');
        }

        return view('user.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Keamanan: Pastikan hanya pemilik yang bisa mengupdate
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'image'   => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'title'   => $request->title,
            'slug'    => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'status'  => 'pending', // Set kembali ke pending agar direview ulang admin jika ada perubahan
        ];

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('user.dashboard_user')
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

        return redirect()->route('user.dashboard_user')
            ->with('success', 'Blog telah berhasil dihapus secara permanen.');
    }
}
