<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Pabrik\ProfilController;
use App\Http\Controllers\Pabrik\JadwalPanenController;
use App\Http\Controllers\Petani\JadwalGilingController;
use App\Http\Controllers\Petani\RencanaPanenController;
use App\Http\Controllers\Petani\RiwayatSetorController;
use App\Http\Controllers\Pabrik\RencanaGilingController;
use App\Http\Controllers\Pabrik\RiwayatTerimaController;
use App\Http\Controllers\Pabrik\DashboardPabrikController;
use App\Http\Controllers\Pabrik\PengajuanPabrikController;
use App\Http\Controllers\Petani\DashboardPetaniController;
use App\Http\Controllers\Petani\PengajuanPetaniController;
use App\Http\Controllers\Petani\PermintaanSetorController;
use App\Http\Controllers\Pabrik\PermintaanTerimaController;

// LANDING PAGE DAN AUTH
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'pabrik':
                return redirect()->route('pabrik.dashboard');
            case 'petani':
                return redirect()->route('petani.dashboard');
            default:
                return redirect('/');
        }
    }

    return view('landingpage');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registerPabrik', [AuthController::class, 'showRegisterPabrik'])->name('registerPabrik');
Route::post('/registerPabrik', [AuthController::class, 'registerPabrik'])->name('register.pabrik.post');

Route::get('/registerPetani', [AuthController::class, 'showRegisterPetani'])->name('registerPetani');
Route::post('/registerPetani', [AuthController::class, 'registerPetani'])->name('register.petani.post');

// ADMIN
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/pengguna', [AdminController::class, 'pengguna'])->name('admin.pengguna');
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::put('/admin/pengguna/{id}', [AdminController::class, 'updatePengguna']);
    Route::delete('/admin/pengguna/{id}', [AdminController::class, 'hapusPengguna']);
});

// PABRIK ROUTES
Route::middleware(['auth', RoleMiddleware::class . ':pabrik'])->prefix('pabrik')->name('pabrik.')->group(function () {
    Route::get('/dashboard', [DashboardPabrikController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/jadwalpanen', [JadwalPanenController::class, 'jadwalPanen'])->name('jadwalpanen');
    Route::get('/rencanapanen/{id}', [JadwalPanenController::class, 'rencanaPanenByPabrik'])->name('rencanapanen');
    Route::post('/ajukan-terima/{id}', [JadwalPanenController::class, 'ajukanTerima'])->name('ajukan');

    Route::get('/permintaan', [PermintaanTerimaController::class, 'permintaanTerima'])->name('permintaan');
    Route::post('/konfirmasi/{rencanaGilingId}/{petaniId}', [PermintaanTerimaController::class, 'konfirmasiAjuan'])->name('konfirmasi');

    Route::get('/rencanagiling', [RencanaGilingController::class, 'rencanaGiling'])->name('rencanagiling');
    Route::post('/rencanagiling', [RencanaGilingController::class, 'storeRencanaGiling'])->name('rencanagilingstore');
    Route::put('/rencanagiling/{id}', [RencanaGilingController::class, 'updateGiling'])->name('rencanagilingupdate');
    Route::delete('/rencanagiling/{id}', [RencanaGilingController::class, 'destroyGiling'])->name('rencanagilingdestroy');

    Route::get('/riwayatterima', [RiwayatTerimaController::class, 'riwayatTerima'])->name('riwayatterima');

    Route::get('/pabrik/ajuan-saya', [PengajuanPabrikController::class, 'ajuanPabrik'])->name('ajuan');
});

// PETANI ROUTES
Route::middleware(['auth', RoleMiddleware::class . ':petani'])->prefix('petani')->name('petani.')->group(function () {
    Route::get('/dashboard', [DashboardPetaniController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/jadwalgiling', [JadwalGilingController::class, 'jadwalGiling'])->name('jadwalgiling');
    Route::get('/rencanagiling/{id}', [JadwalGilingController::class, 'rencanaGilingByPetani'])->name('rencanagiling');
    Route::post('/ajukan-setoran/{id}', [JadwalGilingController::class, 'ajukanSetoran'])->name('ajukan');

    Route::get('/permintaan', [PermintaanSetorController::class, 'permintaanSetor'])->name('permintaan');
    Route::post('/konfirmasi/{rencanaPanenId}/{pabrikId}', [PermintaanSetorController::class, 'konfirmasiSetor'])->name('konfirmasi');

    Route::get('/rencanapanen', [RencanaPanenController::class, 'rencanaPanen'])->name('rencanapanen');
    Route::post('/rencanapanen', [RencanaPanenController::class, 'storeRencanaPanen'])->name('rencanapanenstore');
    Route::put('/rencanapanen/{id}', [RencanaPanenController::class, 'updatePanen'])->name('rencanapanenupdate');
    Route::delete('/rencanapanen/{id}', [RencanaPanenController::class, 'destroyPanen'])->name('rencanapanendestroy');

    Route::get('/riwayatsetor', [RiwayatSetorController::class, 'riwayatSetor'])->name('riwayatsetor');

    Route::get('/petani/ajuan-saya', [PengajuanPetaniController::class, 'ajuanPetani'])->name('ajuan');

});
