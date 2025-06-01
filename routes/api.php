<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pabrik\ProfilController;

Route::middleware('auth:sanctum')->put('/profil', [ProfilController::class, 'update']);
