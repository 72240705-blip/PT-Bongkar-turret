<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\KendaraanController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/verify-otp', [AuthController::class, 'showOtp'])->name('otp.show');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Driver Routes (Hanya untuk pengguna yang sudah Login)
Route::middleware(['auth'])->group(function () {
    // Dashboard Pengemudi
    Route::get('/dashboard', [DriverController::class, 'dashboard'])->name('dashboard');

    // Modul Kelola Kendaraan
    Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
    Route::post('/kendaraan', [KendaraanController::class, 'store'])->name('kendaraan.store');
    Route::post('/kendaraan/{id}/set-utama', [KendaraanController::class, 'setUtama'])->name('kendaraan.set-utama');
    Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy'])->name('kendaraan.destroy');
});