<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Post;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Mengambil semua post milik user yang sedang login
        $posts = \App\Models\Post::where('user_id', $user->id)->latest()->get();

        // Mengirimkan variabel $user dan $posts ke view
        return view('user.dashboard', compact('user', 'posts'));
    }
}
