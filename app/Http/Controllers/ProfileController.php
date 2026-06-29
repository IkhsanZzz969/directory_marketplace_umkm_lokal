<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $totalProducts = 0;
        $totalViews = 0;

        if (Auth::user()->role === 'umkm') {
            $shop = Shop::where('user_id', Auth::id())->first();
            if ($shop) {
                $totalProducts = Product::where('shop_id', $shop->id)->count();
                $totalViews = Product::where('shop_id', $shop->id)->sum('views_count');
            }
        }

        $wishlistProducts = Auth::user()->wishlistedProducts()
            ->with(['primaryImage', 'shop', 'category'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->get();

        $chatHistories = \App\Models\WhatsappChat::where('user_id', Auth::id())
            ->with(['shop', 'product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.menu.profile', compact('totalProducts', 'totalViews', 'wishlistProducts', 'chatHistories'));
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|string',
        ]);

        $user = auth()->user();

        // The image comes as a base64 string from Cropper.js: data:image/png;base64,....
        $imageParts = explode(';base64,', $request->avatar);
        $imageTypeAux = explode('image/', $imageParts[0]);
        $imageType = $imageTypeAux[1] ?? 'png';
        $imageBase64 = base64_decode($imageParts[1]);

        $fileName = 'avatar_'.$user->id.'_'.time().'.'.$imageType;

        // Ensure directory exists
        Storage::disk('public')->makeDirectory('avatars');
        Storage::disk('public')->put('avatars/'.$fileName, $imageBase64);

        // Delete old avatar if exists
        if ($user->avatar && Storage::disk('public')->exists('avatars/'.$user->avatar)) {
            Storage::disk('public')->delete('avatars/'.$user->avatar);
        }

        $user->avatar = $fileName;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Foto profil berhasil diperbarui!',
            'avatar_url' => $user->avatar_url,
        ]);
    }
}
