<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\UserController; // Pastikan Anda membuat controller ini atau gunakan penutupan (closure)

Route::get('/', [HomeController::class, 'index'])->name('welcome_page');

Route::get('/about-page', function () {
    return view('about_page');
})->name('about-page');

Route::get('/trips-page', [HomeController::class, 'trips'])->name('trips-page.index');

Route::get('/trips-page/{trip}', [HomeController::class, 'showTrip'])->name('trips-page.show');

Route::get('/blog-page', [HomeController::class, 'blog'])->name('blog-page.index');
Route::get('/blog/{post:slug}', [HomeController::class, 'showBlog'])->name('blog-page.show');

Route::get('/contact-page', [HomeController::class, 'contact'])->name('contact_page');
Route::post('/contact-page', [HomeController::class, 'sendContact'])->name('contact.send');


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
    Route::resource('trips', TripController::class)->names([
        'index' => 'trips.index',
        'create' => 'trips.create',
        'store' => 'trips.store',
        'show' => 'trips.show',
        'edit' => 'trips.edit',
        'update' => 'trips.update',
        'destroy' => 'trips.destroy',
    ]);
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'show' => 'categories.show',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy',
    ]);
    Route::resource('posts', AdminPostController::class)->names([
        'index' => 'posts.index',
        'create' => 'posts.create',
        'store' => 'posts.store',
        'show' => 'posts.show',
        'edit' => 'posts.edit',
        'update' => 'posts.update',
        'destroy' => 'posts.destroy',
    ]);
    Route::post('/posts/{post}/approve', [AdminPostController::class, 'approve'])->name('posts.approve');
    Route::post('/posts/{post}/reject', [AdminPostController::class, 'reject'])->name('posts.reject');
});

// --- USER ROUTES ---
Route::middleware(['auth'])->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', UserPostController::class)->names([
        'index' => 'posts.index',
        'create' => 'posts.create',
        'store' => 'posts.store',
        'show' => 'posts.show',
        'edit' => 'posts.edit',
        'update' => 'posts.update',
        'destroy' => 'posts.destroy',
    ]);
});

Route::get('/blog/{slug}', [UserPostController::class, 'show'])->name('blog.show');
