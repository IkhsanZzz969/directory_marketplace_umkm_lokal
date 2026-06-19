<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/toko/{slug}', [StoreController::class, 'show'])->name('shop.show');

Route::get('/toko-umkm', function () {
    return view('toko-umkm');
});

Route::get('profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::get('/kelola-toko', function () {
    $categories = \App\Models\Category::all();
    $products = \App\Models\Product::with(['category', 'primaryImage'])->orderByDesc('created_at')->get()->map(function($p) {
        $primaryImg = $p->primaryImage->first();
        return [
            'id' => $p->id,
            'e' => $primaryImg ? '' : '📦',
            'bg' => '#fef3c7',
            'img_url' => $primaryImg ? asset('storage/' . $primaryImg->image_path) : null,
            'name' => $p->name,
            'slug' => $p->slug,
            'cat' => $p->category ? $p->category->name : 'Tanpa Kategori',
            'price' => (float) $p->price,
            'views' => $p->views_count,
            'featured' => $p->is_featured,
            'status' => 'active'
        ];
    });
    return view('kelola-toko', ['categories' => $categories, 'jsProducts' => $products]);
})->middleware('auth')->name('kelola-toko');

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

    Route::get('/create-shop', [StoreController::class, 'create'])->name('shop.create');
    Route::post('/create-shop', [StoreController::class, 'store'])->name('shop.store');
    
    Route::get('/edit-toko', [StoreController::class, 'edit'])->name('shop.edit');
    Route::put('/edit-toko', [StoreController::class, 'update'])->name('shop.update');

    Route::get('/tambah-produk', [ProductController::class, 'create'])->name('product.create');
    Route::post('/tambah-produk', [ProductController::class, 'store'])->name('product.store');
    Route::post('/kategori', [ProductController::class, 'storeCategory'])->name('category.store');
    Route::put('/produk/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});
