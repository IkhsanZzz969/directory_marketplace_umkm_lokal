<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', function () {
    return view('auth');
});

Route::get('/catalog', function () {
    return view('catalog');
});

Route::get('/product-detail', function () {
    return view('product-detail');
});

Route::get('/store-profile', function () {
    return view('store-profile');
});
