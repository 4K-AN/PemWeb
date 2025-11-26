<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register_edvizo');
    }

    public function process(Request $request)
    {
      // 1. Validasi Input (Satpam Pengecekan)
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users', // 'unique' biar email gak kembar
            'password' => 'required|min:8|confirmed'  // 'confirmed' akan otomatis cek input 'password_confirmation'
        ]);

        // 2. Simpan ke Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) // Enkripsi password
        ]);

        // 3. Kalau sukses, lempar ke halaman Login bawa pesan sukses
        return redirect('/login-edvizo')->with('success', 'Registrasi berhasil! Silakan login ya.');
    }
}