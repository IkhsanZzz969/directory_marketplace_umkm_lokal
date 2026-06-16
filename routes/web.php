<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
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

Route::middleware('auth')->group(function () {
    Route::get('/administrator', [AdminController::class, 'administrator'])->name('administrator');

    Route::patch('/admin/shop/{shop}/approve', [AdminController::class, 'approveShop'])->name('admin.shop.approve');
    Route::patch('/admin/shop/{shop}/reject', [AdminController::class, 'rejectShop'])->name('admin.shop.reject');

    Route::get('/create-shop', [StoreController::class, 'create'])->name('shop.create');
    Route::post('/create-shop', [StoreController::class, 'store'])->name('shop.store');
});