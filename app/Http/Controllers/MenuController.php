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
        return view('pages.menu.catalog');
    }

    public function msmeShop()
    {
        return view('pages.menu.msme-shop');
    }
}
