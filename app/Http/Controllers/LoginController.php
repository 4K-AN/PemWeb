<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Fungsi untuk memproses Login
    public function authenticate(Request $request)
    {
        // 1. Validasi: Pastikan inputan email & password ada
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

       // AMBIL NILAI CHECKBOX
    // $request->boolean('remember') akan bernilai TRUE kalau dicentang, FALSE kalau tidak.
    $remember = $request->boolean('remember');

    // MASUKKAN VARIABEL $remember SEBAGAI ARGUMEN KEDUA
    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        return redirect()->intended('home');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah, coba cek lagi.',
    ]);
    }

    // Fungsi untuk Logout (Jaga-jaga kalau nanti butuh)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login-edvizo')->with('success', 'Anda telah keluar.');
    }
}
