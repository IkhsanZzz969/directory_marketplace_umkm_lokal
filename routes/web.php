<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', [AuthController::class, 'index'])->name('login');

Route::get('/catalog', function () {
    return view('catalog');
});

Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/toko/{slug}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/toko-umkm', function () {
    return view('toko-umkm');
});

Route::get('profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/administrator', [AdminController::class, 'administrator'])->name('administrator');

    Route::patch('/admin/shop/{shop}/approve', [AdminController::class, 'approveShop'])->name('admin.shop.approve');
    Route::patch('/admin/shop/{shop}/reject', [AdminController::class, 'rejectShop'])->name('admin.shop.reject');

    Route::post('/admin/category', [AdminController::class, 'storeCategory'])->name('admin.category.store');
    Route::put('/admin/category/{category}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    Route::delete('/admin/category/{category}', [AdminController::class, 'deleteCategory'])->name('admin.category.destroy');

    Route::get('/create-shop', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/create-shop', [ShopController::class, 'store'])->name('shop.store');

    Route::get('/edit-toko', [ShopController::class, 'edit'])->name('shop.edit');
    Route::put('/edit-toko', [ShopController::class, 'update'])->name('shop.update');

    Route::get('/manage-shop', [ShopController::class, 'manageShop'])->name('shop.manage');

    Route::get('/tambah-produk', [ProductController::class, 'create'])->name('product.create');
    Route::post('/tambah-produk', [ProductController::class, 'store'])->name('product.store');
    Route::post('/kategori', [ProductController::class, 'storeCategory'])->name('category.store');
    Route::put('/produk/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});
