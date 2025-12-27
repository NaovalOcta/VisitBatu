<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TripController;

Route::get('/', function () {
    return view('welcome_page');
})->name('welcome_page');

Route::get('/register-page', function () {
    return view('auth.register_page');
})->name('register_page');

Route::get('/login-page', function () {
    return view('auth.login_page');
})->name('login_page');

Route::get('/about-page', function () {
    return view('about_page');
})->name('about_page');

Route::get('/trips-page', function () {
    return view('trips_page');
})->name('trips_page');

Route::get('/blog-page', function () {
    return view('blog_page');
})->name('blog_page');

Route::get('/contact-page', function () {
    return view('contact_page');
})->name('contact_page');


// Route Resource untuk Trip (Mencakup CRUD lengkap)
Route::resource('trips', TripController::class);


// Route Logout (Standar Laravel)
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Group Route untuk User yang sudah Login
Route::middleware(['auth'])->group(function () {

    // Redirect logic sederhana ke dashboard berdasarkan role
    Route::get('/dashboard-redirect', function () {
        $role = Auth::user()->role; // Pastikan kolom 'role' ada di tabel users

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    })->name('dashboard');

    // Dummy Route untuk Admin Dashboard (Nanti diganti dengan Controller asli)
    Route::get('/admin/dashboard', function () {
        return "Halaman Admin Dashboard"; // Ganti dengan view('admin.dashboard') nanti
    })->name('admin.dashboard');

    // Dummy Route untuk User Dashboard (Nanti diganti dengan Controller asli)
    Route::get('/user/dashboard', function () {
        return "Halaman User Dashboard"; // Ganti dengan view('user.dashboard') nanti
    })->name('user.dashboard');
});
