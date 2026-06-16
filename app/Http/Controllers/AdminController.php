<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function administrator()
    {
        $umkm = Shop::with('user')->get();
        $pendingUmkm = Shop::with('user')->where('status', 'pending')->count();

        $listUser = User::select('id', 'name', 'email', 'phone', 'role', 'created_at')->whereNotIn('role', ['superadmin'])->get();
        return view('pages.admin.administrator', compact('umkm', 'pendingUmkm', 'listUser'));
    }

    public function approveShop(Shop $shop)
    {
        $shop->update([
            'status' => 'approved',
            'is_active' => 'active',
        ]);

        return response()->json([
            'success' => true,
            'message' => "Toko \"{$shop->name}\" berhasil disetujui dan sekarang aktif.",
        ]);
    }

    public function rejectShop(Shop $shop)
    {
        $shop->update([
            'status' => 'rejected',
            'is_active' => 'inactive',
        ]);

        return response()->json([
            'success' => true,
            'message' => "Toko \"{$shop->name}\" telah ditolak.",
        ]);
    }
}
