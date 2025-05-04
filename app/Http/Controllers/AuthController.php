<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            session(['refreshToken' => $response->json()['refreshToken']]);
            session(['user_email' => $request->email]);

            return redirect()->route('tutorials.index');
        }

        return back()->with('error', 'Login gagal. Cek email/password.');
    }

    public function logout()
    {
        // Tetap coba panggil server logout, tapi jangan blok proses meski gagal
        $response = Http::post('https://jwt-auth-eight-neon.vercel.app/logout', [
            'refresh_token' => session('refreshToken'),
        ]);

        // Optional log if needed
        if (!$response->successful()) {
            logger()->warning('Logout API gagal', ['body' => $response->body()]);
        }

        // Tetap flush session lokal
        session()->flush();
        return redirect()->route('login.form')->with('success', 'Logout berhasil');
    }
}
