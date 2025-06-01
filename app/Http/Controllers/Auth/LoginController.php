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
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email/Username atau password salah. Silahkan masukkan lagi!');
    }

    // protected untuk role
    protected function authenticated($request, $user)
    {
        switch ($user->role) {
            case 'superadmin':
                return redirect('/dashboard/superadmin');
            case 'admin':
                return redirect('/dashboard/admin');
            case 'recipient':
                return redirect('/dashboard/recipient');
            default:
                return redirect('/home');
        }
    }
}