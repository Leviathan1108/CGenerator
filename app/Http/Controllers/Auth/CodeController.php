<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    // Menampilkan form untuk memasukkan kode verifikasi
    public function showVerificationForm()
    {
        return view('auth.passwords.code');
    }

    // Memverifikasi kode yang dimasukkan
    public function verify(Request $request)
    {
        // Validasi input kode
        $request->validate([
            'code' => 'required|numeric|digits:6',  // Validasi kode 6 digit
        ]);

        // Periksa apakah kode yang dimasukkan sesuai (bisa disesuaikan dengan logika Anda)
        if ($request->code === '123456') { // Kode verifikasi yang benar
            // Jika kode benar, redirect ke halaman reset password
            return redirect()->route('password.reset', [
                'token' => session('reset_token'),
                'email' => session('reset_email'),
            ]);            
        }

        // Jika kode salah, tampilkan pesan error
        return back()->withErrors(['code' => 'Invalid code. Please try again.']);
    }
}
