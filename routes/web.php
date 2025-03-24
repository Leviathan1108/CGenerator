<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CertiController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\RecipientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Menangani autentikasi default Laravel
Auth::routes();

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
// dashboard bukan halaman tersembunyi
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Halaman yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/certificates', [CertiController::class, 'index'])->name('certificates');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::resource('templates', TemplateController::class);
    Route::get('/verifications', [VerificationController::class, 'index']);
    Route::get('/recipients', [RecipientController::class, 'index']);
});

// ini kemungkinan tidak diikutkan karna tidak terlalu berguna
// // Rute Login & Register
// Route::middleware(['auth'])->group(function (){
//     Route::get('/login', [AuthController::class,'login'])->name('login');
//     Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
//     Route::post('/register', [AuthController::class, 'processRegister']);
//     return view('auth.register');
// });

// // Logout
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');