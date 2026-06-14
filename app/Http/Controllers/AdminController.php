<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function administrator()
    {
        $umkm = Shop::with('user')->get();
        return view('pages.admin.administrator', compact('umkm'));
    }
}
