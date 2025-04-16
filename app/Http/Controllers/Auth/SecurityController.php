<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        logger('Input code: ' . $request->code);
    logger('Session code: ' . session('security_code'));
    
    if ($request->code == session('security_code')) {
        // Kode benar, redirect ke halaman reset password dengan token dummy
        return redirect()->route('password.reset', [
            'token' => 'dummy-token', 
            'email' => session('reset_email')
        ]);
    }

    return back()->withErrors(['code' => 'Kode salah, coba lagi.']);
    }
}
