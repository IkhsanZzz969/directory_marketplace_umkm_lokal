<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MenuController::class, 'index'])->name('home');

Route::get('/auth', [AuthController::class, 'index'])->name('login');

Route::get('/katalog-produk', [MenuController::class, 'catalog'])->name('catalog');
Route::get('/toko-umkm', [MenuController::class, 'msmeShop'])->name('msme-shop');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/administrator', [AdminController::class, 'administrator'])->name('administrator');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

    Route::patch('/administrator/toko/{shop}/setujui', [AdminController::class, 'approveShop'])->name('admin.shop.approve');
    Route::patch('/administrator/toko/{shop}/tolak', [AdminController::class, 'rejectShop'])->name('admin.shop.reject');

    Route::post('/administrator/kategori', [AdminController::class, 'storeCategory'])->name('admin.category.store');
    Route::put('/administrator/kategori/{category}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    Route::delete('/administrator/kategori/{category}', [AdminController::class, 'deleteCategory'])->name('admin.category.destroy');

    Route::get('/buat-toko', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/buat-toko', [ShopController::class, 'store'])->name('shop.store');

    Route::get('/edit-toko', [ShopController::class, 'edit'])->name('shop.edit');
    Route::put('/edit-toko', [ShopController::class, 'update'])->name('shop.update');
    Route::get('/toko/{slug}', [ShopController::class, 'show'])->name('shop.show');

    Route::get('/manage-shop', [ShopController::class, 'manageShop'])->name('shop.manage');

    Route::get('/tambah-produk', [ProductController::class, 'create'])->name('product.create');
    Route::post('/tambah-produk', [ProductController::class, 'store'])->name('product.store');

    Route::put('/produk/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show');
});
