<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/registerPabrik', [AuthController::class, 'showRegisterPabrik'])->name('registerPabrik');
Route::get('/registerPetani', [AuthController::class, 'showRegisterPetani'])->name('registerPetani');
