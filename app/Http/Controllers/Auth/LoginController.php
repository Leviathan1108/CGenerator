<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah login berhasil
        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return redirect()->back()->with('error', 'Email atau password salah!');
    }
}

