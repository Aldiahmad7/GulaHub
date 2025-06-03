<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaGiling;
use Illuminate\Support\Facades\DB;

class JadwalGilingController extends Controller
{

    public function jadwalGiling()
    {
    // Ambil semua user dengan role pabrik
    $pabriks = \App\Models\User::where('role', 'pabrik')->get();

    return view('petani.jadwalgiling', compact('pabriks'));
    }

    public function rencanaGilingByPetani(Request $request, $userId)
    {
    $tahun = $request->get('tahun', date('Y'));
    $pabrik = \App\Models\User::findOrFail($userId);

    $rencana = RencanaGiling::whereYear('tanggal', $tahun)
        ->where('user_id', $userId)
        ->get();

    $dataPerBulan = [];

    foreach ($rencana as $item) {
        $bulanNama = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('F');
        $dataPerBulan[$bulanNama][] = $item;
    }

    return view('petani.rencanagiling', [
        'tahunDipilih' => $tahun,
        'dataPerBulan' => $dataPerBulan,
        'pabrik' => $pabrik,
    ]);
    }

    public function ajukanSetoran($id)
    {
    $rencana = RencanaGiling::findOrFail($id);
    $petani = auth()->user();

    // Cek apakah sudah pernah mengajukan
    if ($rencana->pengaju()->where('petani_id', $petani->id)->exists()) {
        return back()->with('warning', 'Anda sudah mengajukan untuk tanggal ini.');
    }

    $rencana->pengaju()->attach($petani->id, [
        'status' => 'Menunggu Persetujuan',
        'tanggal_diajukan' => now(),
    ]);

    return back()->with('success', 'Pengajuan berhasil dikirim.');
    }

}
