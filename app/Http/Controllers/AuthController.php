<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.auth');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|in:user,umkm',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|min:10|max:15',
        ], [
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.',
            'password.min' => 'Password minimal harus 8 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            $username = strtolower(str_replace(' ', '', $request->name));
            $user = User::create([
                'name' => $request->name,
                'username' => $username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => $request->role,
            ]);

            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil dibuat!',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data ke database: '.$e->getMessage(),
            ], 500);
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $redirectUrl = route('profile');

            if ($user->role === 'superadmin') {
                $redirectUrl = route('administrator');
            }

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'redirect_url' => $redirectUrl,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password yang Anda masukkan salah.',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil keluar dari akun.',
            ]);
        }

        return redirect('/auth');
    }
}
