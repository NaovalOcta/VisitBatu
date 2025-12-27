<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;

Route::get('/', function () {
    return view('welcome_page');
})->name('welcome_page');

Route::get('/register-page', function () {
    return view('register_page');
})->name('register_page');

Route::get('/login-page', function () {
    return view('login_page');
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
