<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\CodeController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SecurityController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\UserController;

// Autentikasi Laravel bawaan
//Auth::routes();

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Rute untuk user yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::resource('certificates', CertificateController::class);
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::resource('templates', TemplateController::class);
    Route::get('/check/{code}', [VerificationController::class, 'check'])->name('verifications.check');
    Route::resource('recipients', RecipientController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('templatesuperadmin', TemplateController::class);
    Route::put('templatesuperadmin/{id}', [TemplateController::class, 'update'])->name('templates.update');
    Route::delete('/templatesuperadmin/{id}', [TemplateController::class, 'destroy'])->name('templates.destroy');
    Route::resource('templateadmin', CertificateController::class);
    Route::get('/verifications', [VerificationController::class, 'index'])->name('verifications.index');
    Route::post('/verifications/check', [VerificationController::class, 'check'])->name('verifications.check');
    Route::get('/verifications/{code}', [VerificationController::class, 'show']);
    Route::get('/user/{id}/edit',[UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/{id}',[UserController::class, 'update'])->name('users.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Rute untuk guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);


    Route::post('/login', [AuthController::class, 'processLogin']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister']);
    Route::get('/registration-success', function () {
        return view('auth.success_registration');
    })->name('registration.success');

    // Rute untuk meminta link reset password (Email)
    Route::get('password/reset', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/templates/{id}/edit', [TemplateController::class, 'edit'])->name('templates.edit');
    
    // Rute untuk merubah password baru setelah mendapatkan link reset
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

    // Rute untuk proses verifikasi kode keamanan
    Route::post('verify-security-code', [SecurityController::class, 'verifyCode'])->name('verify.security.code');

    //Route ke Halaman success_reset
    Route::get('/reset/success', function () {
        return view('auth.passwords.success_reset');  // Pastikan ada file success_reset.blade.php
    })->name('password.reset.success');
    


});
?>