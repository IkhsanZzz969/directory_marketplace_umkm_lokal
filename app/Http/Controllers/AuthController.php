<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 1. Validasi Input Form menggunakan Validator manual agar mudah custom respon JSON-nya
        $validator = Validator::make($request->all(), [
            'role'     => 'required|in:user,umkm',
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'phone'    => 'required|string|min:10|max:15',
            'otp'      => 'required|string|size:6',
        ], [
            // Kustomisasi pesan error bahasa Indonesia agar serasi dengan desain webmu
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'otp.size'     => 'Kode OTP harus berjumlah 6 digit.',
        ]);

        // Jika validasi input form gagal (misal email kembar atau password kurang dari 8)
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first() // Mengambil satu pesan error pertama
            ], 422);
        }

        // 2. LOGIKA VERIFIKASI OTP (Untuk Keperluan Demo)
        // Kita kunci kode OTP demo yang valid adalah '123456'
        $otpDemoValid = '123456';

        if ($request->otp !== $otpDemoValid) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP salah. Silakan coba lagi dengan kode 123456.'
            ], 400);
        }

        // 3. Simpan ke Database jika validasi lolos & OTP benar
        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password), // Password wajib di-hash
                'phone'    => $request->phone,
                'role'     => $request->role, // Menyimpan string 'user' atau 'umkm'
            ]);

            // Opsional: Jika ingin user langsung otomatis login setelah sukses register
            auth()->login($user);

            // Kembalikan respon sukses yang akan memicu Step 3 (Success Panel) di Blade
            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil dibuat!'
            ], 200);

        } catch (\Exception $e) {
            // Jika ada kendala koneksi database atau error tak terduga lainnya
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data ke database: ' . $e->getMessage()
            ], 500);
        }
    }

    public function authenticate(Request $request)
    {
        // Validasi data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Proses Attempt Login
        // $request->remember adalah boolean yang kita kirim dari checkbox
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Kembalikan JSON sukses agar script Fetch API bisa mengalihkan halaman
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil'
            ]);
        }

        // Jika gagal, kembalikan JSON error
        return response()->json([
            'success' => false,
            'message' => 'Email atau password yang Anda masukkan salah.'
        ], 401);
    }

    public function logout(Request $request)
    {
        // 1. Proses logout user dari sistem auth Laravel
        Auth::logout();

        // 2. Hapus semua data session user yang aktif saat ini
        $request->session()->invalidate();

        // 3. Buat ulang CSRF token baru untuk keamanan sesi berikutnya
        $request->session()->regenerateToken();

        // 4. Cek jika request datang dari Script/Fetch API (AJAX)
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil keluar dari akun.'
            ]);
        }

        // Jika request dari form HTML biasa, langsung redirect ke halaman login
        return redirect('/auth'); 
    }
}
