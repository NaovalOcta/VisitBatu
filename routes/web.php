<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\DashboardController;

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


// --- AUTHENTICATION ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- ADMIN ROUTES ---
// Menggunakan middleware 'auth' dan middleware 'is_admin' (pastikan alias middleware sudah didaftarkan)
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->name('admin.')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard_admin');
    Route::resource('trips', TripController::class);
    Route::resource('posts', PostController::class);
});
