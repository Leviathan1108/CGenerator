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
use App\Http\Controllers\UserController;
use App\Models\CertificateBackground;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ContactController;



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
    
    // Route halaman upload background
    Route::get('templateadmin/upload', [CertificateController::class, 'upload'])->name('templateadmin.upload');
    Route::post('templateadmin/upload', [CertificateController::class, 'storeUpload'])->name('templateadmin.upload.store');
    Route::delete('templateadmin/upload/{id}', [CertificateController::class, 'deleteTemporaryBackground'])->name('templateadmin.upload.delete');
    // Route untuk input data setelah upload
    Route::get('templateadmin/data-input', [CertificateController::class, 'dataInput'])->name('templateadmin.dataInput');
    Route::post('templateadmin/store-data', [CertificateController::class, 'storeData'])->name('templateadmin.storeData');
    
    Route::get('templateadmin/template', [CertificateController::class, 'template'])->name('templateadmin.template');
    Route::resource('templateadmin', CertificateController::class)->except(['show']);
    
    Route::resource('templateadmin/contacts', ContactController::class)->only([
        'index', 'store', 'update', 'destroy'
    ])->names([
        'index' => 'templateadmin.contacts',
        'store' => 'templateadmin.contacts.store',
        'update' => 'templateadmin.contacts.update',
        'destroy' => 'templateadmin.contacts.destroy',
    ]);
    
    Route::get('/templateadmin/preview', [CertificateController::class, 'preview'])->name('templateadmin.preview');


    Route::get('/verifications', [VerificationController::class, 'index'])->name('verifications.index');
    Route::post('/verifications/check', [VerificationController::class, 'check'])->name('verifications.check');
    Route::get('/verifications/{code}', [VerificationController::class, 'show']);
    Route::get('/user/{id}/edit',[UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/{id}',[UserController::class, 'update'])->name('users.update');
    Route::get('/settings/{id}', [UserController::class, 'show'])->name('show');

    Route::get('/registration-success', function () {
        return view('auth.success_registration');
    })->name('registration.success');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Rute Guest -> Log in
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Rute untuk Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister']);

    // Rute untuk meminta link reset password (Email)
    Route::get('password/reset', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/templates/{id}/edit', [TemplateController::class, 'edit'])->name('templates.edit');
    
    // Rute untuk merubah password baru setelah mendapatkan link reset
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('/reset/success', function () {
        return view('auth.passwords.success_reset');
    })->name('password.reset.success');
    Route::post('/background/store', [CertificateBackgroundController::class, 'store'])->name('background.store');

    // Rute untuk proses verifikasi kode keamanan
    Route::post('verify-security-code', [SecurityController::class, 'verifyCode'])->name('verify.security.code');

});

?>
