<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login_page');
})->name('login_page');

Route::get('/register_page', function () {
    return view('register_page');
})->name('register_page');

Route::get('/welcome_page', function () {
    return view('welcome_page');
})->name('welcome_page');

Route::get('/about_page', function () {
    return view('about_page');
})->name('about_page');

Route::get('/trips_page', function () {
    return view('trips_page');
})->name('trips_page');

Route::get('/blog_page', function () {
    return view('blog_page');
})->name('blog_page');

Route::get('/contact_page', function () {
    return view('contact_page');
})->name('contact_page');

