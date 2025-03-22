<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CertiController;
use App\Http\Controllers\TemplatesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Menangani autentikasi default Laravel
Auth::routes();

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Halaman yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/certificate', [CertiController::class, 'index'])->name('certificate');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/templates', [TemplatesController::class, 'index'])->name('templates');
});

// Rute Login & Register
Route::middleware(['guest'])->group(function () {Route::get('/login', function () {
    return view('auth.login');
})->name('login');


    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
?>