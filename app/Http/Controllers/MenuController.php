<?php

namespace App\Http\Controllers;

class MenuController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function catalog()
    {
        $products = \App\Models\Product::with(['shop', 'primaryImage', 'category'])->where('status', 'active')->latest()->get();
        $categories = \App\Models\Category::all();
        
        $districts = [
            ['id' => 1, 'name' => 'Purwokerto Utara', 'city' => 'purwokerto', 'icon' => '⛰️'],
            ['id' => 2, 'name' => 'Purwokerto Selatan', 'city' => 'purwokerto', 'icon' => '🏙️'],
            ['id' => 3, 'name' => 'Purwokerto Barat', 'city' => 'purwokerto', 'icon' => '🏙️'],
            ['id' => 4, 'name' => 'Purwokerto Timur', 'city' => 'purwokerto', 'icon' => '🏙️'],
            ['id' => 5, 'name' => 'Baturraden', 'city' => 'banyumas', 'icon' => '🌲'],
            ['id' => 6, 'name' => 'Sokaraja', 'city' => 'banyumas', 'icon' => '🏢'],
            ['id' => 7, 'name' => 'Banyumas', 'city' => 'banyumas', 'icon' => '🏛️'],
            ['id' => 8, 'name' => 'Kembaran', 'city' => 'banyumas', 'icon' => '🌳'],
            ['id' => 9, 'name' => 'Sumbang', 'city' => 'banyumas', 'icon' => '⛰️'],
            ['id' => 10, 'name' => 'Kedungbanteng', 'city' => 'banyumas', 'icon' => '⛰️'],
            ['id' => 11, 'name' => 'Karanglewas', 'city' => 'banyumas', 'icon' => '🌳'],
            ['id' => 12, 'name' => 'Cilongok', 'city' => 'banyumas', 'icon' => '🌲'],
            ['id' => 13, 'name' => 'Ajibarang', 'city' => 'banyumas', 'icon' => '🏭'],
            ['id' => 14, 'name' => 'Pekuncen', 'city' => 'banyumas', 'icon' => '⛰️'],
            ['id' => 15, 'name' => 'Gumelar', 'city' => 'banyumas', 'icon' => '⛰️'],
            ['id' => 16, 'name' => 'Lumbir', 'city' => 'banyumas', 'icon' => '🌲'],
            ['id' => 17, 'name' => 'Wangon', 'city' => 'banyumas', 'icon' => '🛣️'],
            ['id' => 18, 'name' => 'Jatilawang', 'city' => 'banyumas', 'icon' => '🌳'],
            ['id' => 19, 'name' => 'Purwojati', 'city' => 'banyumas', 'icon' => '🌳'],
            ['id' => 20, 'name' => 'Rawalo', 'city' => 'banyumas', 'icon' => '🌊'],
            ['id' => 21, 'name' => 'Kebasen', 'city' => 'banyumas', 'icon' => '🌊'],
            ['id' => 22, 'name' => 'Patikraja', 'city' => 'banyumas', 'icon' => '🛣️'],
            ['id' => 23, 'name' => 'Kalibagor', 'city' => 'banyumas', 'icon' => '🌳'],
            ['id' => 24, 'name' => 'Somagede', 'city' => 'banyumas', 'icon' => '🌳'],
            ['id' => 25, 'name' => 'Kemranjen', 'city' => 'banyumas', 'icon' => '🍈'],
            ['id' => 26, 'name' => 'Sumpiuh', 'city' => 'banyumas', 'icon' => '🏙️'],
            ['id' => 27, 'name' => 'Tambak', 'city' => 'banyumas', 'icon' => '🦆']
        ];

        return view('pages.menu.catalog', compact('products', 'categories', 'districts'));
    }

    public function msmeShop()
    {
        return view('pages.menu.msme-shop');
    }
}
