<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $response = Http::post('https://jwt-auth-eight-neon.vercel.app/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($response->successful()) {
            $token = $response->json('refreshToken');

            // Simpan token dan email ke session
            session(['refreshToken' => $token]);
            session(['user_email' => $request->email]);

            return redirect()->route('tutorials.index');
        }

        return back()->with('error', 'Login gagal. Cek email/password.');
    }

    public function logout()
    {
        $token = session('refreshToken');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('https://jwt-auth-eight-neon.vercel.app/logout');

        if ($response->successful()) {
            session()->flush(); // hapus semua session
            return redirect()->route('login.form')->with('success', 'Logout berhasil');
        }

        return back()->with('error', 'Logout gagal');
    }
}
