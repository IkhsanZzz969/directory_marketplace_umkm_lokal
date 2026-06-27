<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function toggle(Product $product)
    {
        $user = auth()->user();

        if ($user->wishlistedProducts()->where('product_id', $product->id)->exists()) {
            $user->wishlistedProducts()->detach($product->id);
            return back()->with('success', 'Produk dihapus dari Wishlist.');
        } else {
            $user->wishlistedProducts()->attach($product->id);
            return back()->with('success', 'Produk ditambahkan ke Wishlist!');
        }
    }
}
