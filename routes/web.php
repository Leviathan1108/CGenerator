<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\RecipientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SubscriptionController;


// Menangani autentikasi default Laravel
Auth::routes();

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
// dashboard bukan halaman tersembunyi
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Halaman yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::resource('certificates', CertificateController::class);
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::resource('templates', TemplateController::class);
    Route::resource('verifications', VerificationController::class);
    Route::get('/check/{code}', [VerificationController::class, 'check'])->name('verifications.check');
    Route::resource('recipients', RecipientController::class);   
    Route::resource('subscriptions', SubscriptionController::class); 
});

// Rute Login & Register
Route::middleware(['guest'])->group(function () {Route::get('/login', function () {
    return view('auth.login');
})->name('login');


    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister']);
    Route::get('/registration-success', function () {
        return view('auth.success_registration');
    })->name('registration.success');
    
});
Route::get('/templates/{id}/edit', [TemplateController::class, 'edit'])->name('templates.edit');

// // Logout
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
?>