<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', function () {
    return view('auth');
})->name('login');

Route::get('/catalog', function () {
    return view('catalog');
});

Route::get('/product-detail', function () {
    return view('product-detail');
});

Route::get('/store-profile', function () {
    return view('store-profile');
});

Route::get('/toko-umkm', function () {
    return view('toko-umkm');
});

Route::get('profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::get('/kelola-toko', function () {
    return view('kelola-toko');
})->middleware('auth')->name('kelola-toko');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');