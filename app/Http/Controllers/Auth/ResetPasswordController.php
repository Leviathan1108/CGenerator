<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    // Menampilkan form permintaan reset password
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email'); // Form input email
    }

    // Mengirimkan email reset password
    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    
    // Kirim link reset password seperti biasa
    $status = Password::sendResetLink(
        $request->only('email')
    );

    if ($status == Password::RESET_LINK_SENT) {
        $code = rand(100000, 999999);
    
        session([
            'security_code' => $code,
            'reset_email' => $request->email, 
        ]);
    
        \Mail::raw("Your reset code: $code", function($message) use ($request) {
            $message->to($request->email)->subject('Your Password Reset Code');
        });
    
        // PERBAIKAN: Redirect ke route yang menerima GET 
        return redirect()->route('code.enter')->with('status', 'A security code has been sent to your email.');
    }
    else {
        return back()->withErrors(['email' => trans($status)]);
    }
}


    // Menampilkan form reset password baru
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    // Menyimpan password baru
    public function reset(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
    ]);

    // Debug input
    logger('Input email: ' . $request->email);
    logger('Token: ' . $request->token);
    logger('Session email: ' . session('reset_email'));

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            logger('Resetting password for user: ' . $user->email);

            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            event(new \Illuminate\Auth\Events\PasswordReset($user));
        }
    );

    logger('Reset status: ' . $status);

    if ($status == Password::PASSWORD_RESET) {
        logger('Redirecting to success page...');
        return redirect()->route('password.reset.success');
    } else {
        logger('Reset failed: ' . $status);
        return back()->withErrors(['email' => __($status)]);
    }
}

    public function verifyCode(Request $request)
{
    $request->validate([
        'code' => 'required',
    ]);
    
    // Tambahkan log debugging
    logger('Verifying code: ' . $request->code);
    logger('Session security code: ' . session('security_code'));
    logger('Reset email: ' . session('reset_email'));

    if ($request->code == session('security_code')) {
        // Kode benar, redirect ke halaman reset password
        return redirect()->route('password.reset', ['token' => 'dummy-token', 'email' => session('reset_email')]);
    }

    return back()->withErrors(['code' => 'Kode salah, coba lagi.']);
}

    
}
