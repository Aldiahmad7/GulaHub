<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/registerPabrik', [AuthController::class, 'showRegisterPabrik'])->name('registerPabrik');
Route::get('/registerPetani', [AuthController::class, 'showRegisterPetani'])->name('registerPetani');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/registerPabrik', [AuthController::class, 'registerPabrik'])->name('register.pabrik.post');
Route::post('/registerPetani', [AuthController::class, 'registerPetani'])->name('register.petani.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// PABRIK
Route::middleware(['auth', RoleMiddleware::class . ':pabrik'])->group(function () {
    Route::get('/pabrik/dashboard', function () {
        return view('pabrik.dashboard');
    })->name('pabrik.dashboard');
});

// PETANI
Route::middleware(['auth', RoleMiddleware::class . ':petani'])->group(function () {
    Route::get('/petani/dashboard', function () {
        return view('petani.dashboard');
    })->name('petani.dashboard');
});
