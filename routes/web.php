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
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\LayoutController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Redirect setelah registrasi sukses
Route::get('/registration.success', function () {
    return view('auth.success_registration');
})->name('registration.success');

// Rute untuk user yang sudah login & verified
Route::middleware(['auth', 'verified.custom'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


    Route::resource('/certificates', CertificateController::class);
    Route::get('/history', [CertificateController::class, 'show_certificate'])->name('show_certificate');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/check/{code}', [VerificationController::class, 'check'])->name('verifications.check');
    Route::resource('recipients', RecipientController::class);
    Route::resource('subscriptions', SubscriptionController::class);

    Route::get('templateadmin/upload', [CertificateController::class, 'upload'])->name('templateadmin.upload');
    Route::post('templateadmin/upload', [CertificateController::class, 'storeUpload'])->name('templateadmin.upload.store');
    Route::delete('templateadmin/upload/{id}', [CertificateController::class, 'deleteTemporaryBackground'])->name('templateadmin.upload.delete');
    Route::get('templateadmin/data-input', [CertificateController::class, 'dataInput'])->name('templateadmin.dataInput');
    Route::post('templateadmin/store-data', [CertificateController::class, 'storeData'])->name('templateadmin.storeData');
    Route::get('templateadmin/template', [CertificateController::class, 'template'])->name('templateadmin.template');
    Route::resource('templateadmin', CertificateController::class)->except(['show']);

    Route::resource('templateadmin/contacts', ContactController::class)->only(['index', 'store', 'update', 'destroy'])->names([
        'index' => 'templateadmin.contacts',
        'store' => 'templateadmin.contacts.store',
        'update' => 'templateadmin.contacts.update',
        'destroy' => 'templateadmin.contacts.destroy',
    ]);

    Route::get('/templateadmin/preview', [PreviewController::class, 'index'])->name('certificate.preview');
    Route::post('/certificate', [CertificateController::class, 'store'])->name('certificate.store');
    Route::get('/certificate', [CertificateController::class, 'index']);
    Route::get('/certificate/{id}/download', [CertificateController::class, 'download']);
    Route::get('templateadmin/preview', [CertificateController::class, 'dataInputs'])->name('templateadmin.dataInputs');
    Route::get('/certificate/previews/{id}', [CertificateController::class, 'previews'])->name('certificate.previews');
    Route::get('/templateadmin/preview/{id}', [CertificateController::class, 'dataInputs'])->name('templateadmin.previews');
    Route::get('/certificate/preview', [CertificateController::class, 'preview'])->name('certificate.preview');

    Route::post('/send-certificate-email', [CertificateController::class, 'sendEmail']);
    Route::post('/send-bulk-email', [CertificateController::class, 'sendBulkEmail']);
    Route::post('/certificates/send-bulk', [CertificateController::class, 'sendBulk'])->name('certificates.sendBulk');

    Route::get('/verifications', [VerificationController::class, 'index'])->name('verifications.index');
    Route::get('/verifications/{code}', [VerificationController::class, 'show']);
    Route::post('/verify', [VerificationController::class, 'check'])->name('verifications.check');

    Route::get('/settings/{id}', [UserController::class, 'show'])->name('show');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// middleware untuk superadmin
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    // route untuk user management
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'UserCreate'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
    //route untuk history certificate
    Route::get('/history', [CertificateController::class, 'show_certificate'])->name('show_certificate');
    // route untuk settings dan logout
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/settings/{id}', [UserController::class, 'show'])->name('show');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin/user/{id}/edit', [UserController::class, 'AdminEdit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [UserController::class, 'Adminupdate'])->name('admin.user.update');
    Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
});
// end

Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {
    // route untuk create certificate
    Route::get('templateadmin/upload', [CertificateController::class, 'upload'])->name('templateadmin.upload');
    Route::post('templateadmin/upload', [CertificateController::class, 'storeUpload'])->name('templateadmin.upload.store');
    Route::delete('templateadmin/upload/{id}', [CertificateController::class, 'deleteTemporaryBackground'])->name('templateadmin.upload.delete');
    Route::get('templateadmin/data-input', [CertificateController::class, 'dataInput'])->name('templateadmin.dataInput');
    Route::post('templateadmin/store-data', [CertificateController::class, 'storeData'])->name('templateadmin.storeData');
    Route::get('templateadmin/template', [CertificateController::class, 'template'])->name('templateadmin.template');
    Route::resource('templateadmin', CertificateController::class)->except(['show']);

    Route::resource('templateadmin/contacts', ContactController::class)->only(['index', 'store', 'update', 'destroy'])->names([
        'index' => 'templateadmin.contacts',
        'store' => 'templateadmin.contacts.store',
        'update' => 'templateadmin.contacts.update',
        'destroy' => 'templateadmin.contacts.destroy',
    ]);

    Route::get('/templateadmin/preview', [PreviewController::class, 'index'])->name('certificate.preview');
    Route::post('/certificate', [CertificateController::class, 'store'])->name('certificate.store');
    Route::get('/certificate', [CertificateController::class, 'index']);
    Route::get('/certificate/{id}/download', [CertificateController::class, 'download']);
    Route::get('templateadmin/preview', [CertificateController::class, 'dataInputs'])->name('templateadmin.dataInputs');
    Route::get('/certificate/previews/{id}', [CertificateController::class, 'previews'])->name('certificate.previews');
    Route::get('/templateadmin/preview/{id}', [CertificateController::class, 'dataInputs'])->name('templateadmin.previews');
    Route::get('/certificate/preview', [CertificateController::class, 'preview'])->name('certificate.preview');

    Route::post('/send-certificate-email', [CertificateController::class, 'sendEmail']);
    Route::post('/send-bulk-email', [CertificateController::class, 'sendBulkEmail']);
    Route::post('/certificates/send-bulk', [CertificateController::class, 'sendBulk'])->name('certificates.sendBulk');
    Route::resource('/certificates', CertificateController::class);
    Route::get('/certificate/layout', [LayoutController::class, 'show']);
Route::post('/certificate/layout', [LayoutController::class, 'store']);

    // route untuk verifikasi
    Route::post('verify-security-code', [SecurityController::class, 'verifyCode'])->name('verify.security.code');
    Route::get('/verifications', [VerificationController::class, 'index'])->name('verifications.index');
    Route::post('/verifications/check', [VerificationController::class, 'check'])->name('verifications.check');
    Route::get('/verifications/{code}', [VerificationController::class, 'show']);
    Route::get('/check/{code}', [VerificationController::class, 'check'])->name('verifications.check');

    // route untuk create template
    Route::put('templatesuperadmin/{id}', [TemplateController::class, 'update'])->name('templates.update');
    Route::delete('/templatesuperadmin/{id}', [TemplateController::class, 'destroy'])->name('templates.destroy');
    Route::resource('templates', TemplateController::class);
    Route::resource('templatesuperadmin', TemplateController::class);

    // route untuk stting dan logout
    Route::get('/settings/{id}', [UserController::class, 'show'])->name('show');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Rute Guest -> Log in / Register
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister']);

    Route::get('password/reset', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('/password-reset-success', function () {
        return view('auth.passwords.success_reset');
    })->name('password.success');


    Route::post('verify-security-code', [SecurityController::class, 'verifyCode'])->name('verify.security.code');
    Route::get('/verifications', [VerificationController::class, 'index'])->name('verifications.index');
    Route::post('/verifications/check', [VerificationController::class, 'check'])->name('verifications.check');
    Route::get('/verifications/{code}', [VerificationController::class, 'show']);
    Route::get('/check/{code}', [VerificationController::class, 'check'])->name('verifications.check');
});

// Aktifkan fitur email verification Laravel
Auth::routes(['verify' => true]);