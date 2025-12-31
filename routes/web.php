<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\UserController; // Pastikan Anda membuat controller ini atau gunakan penutupan (closure)
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('welcome_page');

Route::get('/about-page', function () {
    return view('about_page');
})->name('about_page');

Route::get('/trips-page', [HomeController::class, 'trips'])->name('trips_page');

Route::get('/blog-page', [HomeController::class, 'blog'])->name('blog_page');

Route::get('/contact-page', function () {
    return view('contact_page');
})->name('contact_page');


// Route Resource untuk Trip (Mencakup CRUD lengkap)
Route::resource('trips', TripController::class)->only(['index', 'show']);


// --- AUTHENTICATION ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- ADMIN ROUTES ---
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('trips', TripController::class);
    Route::resource('posts', AdminPostController::class);
    Route::post('/posts/{post}/approve', [AdminPostController::class, 'approve'])->name('posts.approve');
    Route::post('/posts/{post}/reject', [AdminPostController::class, 'reject'])->name('posts.reject');
});

// --- USER ROUTES ---
Route::middleware(['auth'])->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', UserPostController::class);
});

Route::get('/blog/{slug}', [UserPostController::class, 'show'])->name('blog.show');
