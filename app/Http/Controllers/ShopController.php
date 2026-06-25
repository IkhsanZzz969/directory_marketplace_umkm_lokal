<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function create()
    {
        return view('pages.shop.shop-create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input dari Fetch API Javascript
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:120|regex:/^[a-z0-9-]+$/|unique:shops,slug',
            'description' => 'nullable|string|max:500',
            'category' => 'required|string',
            'logo' => 'nullable|string',
            'whatsapp_number' => 'required|string|min:9|max:15',
            'address' => 'required|string|max:300',
            'district_name' => 'required|string',
        ], [
            // Kustomisasi pesan error bahasa Indonesia
            'slug.unique' => 'URL/Slug toko ini sudah digunakan. Silakan modifikasi nama atau slug toko kamu.',
            'slug.regex' => 'Slug hanya boleh berisi huruf kecil, angka, dan tanda hubung (-).',
            'district_name.required' => 'Kecamatan wajib dipilih dari daftar.',
        ]);

        // Jika validasi gagal, kembalikan response error ke Javascript
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), // Ambil pesan error pertama saja
            ], 422);
        }

        // 2. Proses Simpan ke Database
        try {
            // Kita asumsikan user harus login untuk membuat toko.
            // Maka kita ambil ID user yang sedang login untuk dihubungkan ke toko ini.
            $user = Auth::user();

            $shop = Shop::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'category' => $request->category,
                'logo' => $request->logo,
                'whatsapp_number' => $request->whatsapp_number,
                'address' => $request->address,
                'district' => $request->district_name,
                'status' => 'pending',
            ]);

            // 3. Jika berhasil, kirim response sukses ke Javascript (akan memicu layer Confetti 🎉)
            return response()->json([
                'success' => true,
                'message' => 'Toko berhasil didaftarkan!',
            ], 200);

        } catch (\Exception $e) {
            // Jika ada masalah query database atau server error
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: '.$e->getMessage(),
            ], 500);
        }
    }

    public function edit()
    {
        $shop = Auth::user()->shops;
        if (! $shop) {
            return redirect()->route('shop.create')->with('error', 'Anda belum memiliki toko.');
        }

        return view('pages.shop.shop-edit', compact('shop'));
    }

    public function update(Request $request)
    {
        $shop = Auth::user()->shops;
        if (! $shop) {
            return response()->json(['success' => false, 'message' => 'Toko tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:120|regex:/^[a-z0-9-]+$/|unique:shops,slug,'.$shop->id,
            'description' => 'nullable|string|max:500',
            'category' => 'required|string',
            'logo' => 'nullable|string',
            'whatsapp_number' => 'required|string|min:9|max:15',
            'address' => 'required|string|max:300',
            'district_name' => 'required|string',
        ], [
            'slug.unique' => 'URL/Slug toko ini sudah digunakan. Silakan modifikasi nama atau slug toko kamu.',
            'slug.regex' => 'Slug hanya boleh berisi huruf kecil, angka, dan tanda hubung (-).',
            'district_name.required' => 'Kecamatan wajib dipilih dari daftar.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            $shop->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'category' => $request->category,
                'logo' => $request->logo,
                'whatsapp_number' => $request->whatsapp_number,
                'address' => $request->address,
                'district' => $request->district_name,
                // Status remains the same or maybe changed to pending depending on business logic. We'll leave it.
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data toko berhasil diperbarui!',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: '.$e->getMessage(),
            ], 500);
        }
    }

    public function show($slug)
    {
        $shop = Shop::where('slug', $slug)->firstOrFail();
        $products = Product::where('shop_id', $shop->id)->get();

        return view('pages.shop.shop-profile', compact('shop', 'products'));
    }

    public function manageShop()
    {
        $categories = Category::all();
        $products = Product::with(['category', 'primaryImage'])->orderByDesc('created_at')->get()->map(function ($p) {
            $primaryImg = $p->primaryImage->first();

            return [
                'id' => $p->id,
                'e' => $primaryImg ? '' : '📦',
                'bg' => '#fef3c7',
                'img_url' => $primaryImg ? asset('storage/'.$primaryImg->image_path) : null,
                'name' => $p->name,
                'slug' => $p->slug,
                'cat' => $p->category ? $p->category->name : 'Tanpa Kategori',
                'price' => (float) $p->price,
                'views' => $p->views_count,
                'featured' => $p->is_featured,
                'status' => 'active',
            ];
        });

        return view('pages.shop.shop-manage', ['categories' => $categories, 'jsProducts' => $products]);
    }
}
