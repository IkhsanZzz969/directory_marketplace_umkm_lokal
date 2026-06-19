<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function administrator()
    {
        $umkm = Shop::with('user')->get();
        $pendingUmkm = Shop::with('user')->where('status', 'pending')->count();

        $listUser = User::select('id', 'name', 'email', 'phone', 'role', 'created_at')->whereNotIn('role', ['superadmin'])->get();
        $categories = Category::all();
        return view('pages.admin.administrator', compact('umkm', 'pendingUmkm', 'listUser', 'categories'));
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

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:120|unique:categories,slug',
        ]);

        Category::create($validated);

        return redirect()->route('administrator')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:120|unique:categories,slug,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('administrator')->with('success', 'Kategori berhasil diupdate!');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();

        return redirect()->route('administrator')->with('success', 'Kategori berhasil dihapus!');
    }
}
