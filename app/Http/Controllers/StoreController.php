<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function create()
    {
        return view('pages.shop.create-shop');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input dari Fetch API Javascript
        $validator = Validator::make($request->all(), [
            'name'            => 'required|string|max:100',
            'slug'            => 'required|string|max:120|regex:/^[a-z0-9-]+$/|unique:shops,slug',
            'description'     => 'nullable|string|max:500',
            'category'        => 'required|string',
            'logo'            => 'nullable|string',
            'whatsapp_number' => 'required|string|min:9|max:15',
            'address'         => 'required|string|max:300',
            'district_name'     => 'required|string', 
        ], [
            // Kustomisasi pesan error bahasa Indonesia
            'slug.unique'     => 'URL/Slug toko ini sudah digunakan. Silakan modifikasi nama atau slug toko kamu.',
            'slug.regex'      => 'Slug hanya boleh berisi huruf kecil, angka, dan tanda hubung (-).',
            'district_name.required' => 'Kecamatan wajib dipilih dari daftar.',
        ]);

        // Jika validasi gagal, kembalikan response error ke Javascript
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first() // Ambil pesan error pertama saja
            ], 422);
        }

        // 2. Proses Simpan ke Database
        try {
            // Kita asumsikan user harus login untuk membuat toko.
            // Maka kita ambil ID user yang sedang login untuk dihubungkan ke toko ini.
            $user = Auth::user();

            $shop = Shop::create([
                'user_id'         => $user->id,
                'name'            => $request->name,
                'slug'            => $request->slug,
                'description'     => $request->description,
                'category'        => $request->category,
                'logo'            => $request->logo,
                'whatsapp_number' => $request->whatsapp_number,
                'address'         => $request->address,
                'district'   => $request->district_name,
                'status'          => 'pending', 
            ]);

            // 3. Jika berhasil, kirim response sukses ke Javascript (akan memicu layer Confetti 🎉)
            return response()->json([
                'success' => true,
                'message' => 'Toko berhasil didaftarkan!'
            ], 200);

        } catch (\Exception $e) {
            // Jika ada masalah query database atau server error
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
}
