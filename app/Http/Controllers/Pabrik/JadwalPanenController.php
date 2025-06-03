<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaPanen;
use Illuminate\Support\Facades\DB;



class JadwalPanenController extends Controller
{

    public function jadwalPanen()
    {
    // Ambil semua user dengan role pabrik
    $petanis = \App\Models\User::where('role', 'petani')->get();

    return view('pabrik.jadwalpanen', compact('petanis'));
    }

    public function rencanaPanenByPabrik(Request $request, $userId)
    {
    $tahun = $request->get('tahun', date('Y'));
    $petani = \App\Models\User::findOrFail($userId);

    $rencana = RencanaPanen::whereYear('tanggal', $tahun)
        ->where('user_id', $userId)
        ->get();

    $dataPerBulan = [];

    foreach ($rencana as $item) {
        $bulanNama = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('F');
        $dataPerBulan[$bulanNama][] = $item;
    }

    return view('pabrik.rencanapanen', [
        'tahunDipilih' => $tahun,
        'dataPerBulan' => $dataPerBulan,
        'petani' => $petani,
    ]);
    }

    public function ajukanTerima($id)
    {
    $rencana = RencanaPanen::findOrFail($id);
    $pabrik = auth()->user();

    // Cek apakah sudah pernah mengajukan
    if ($rencana->pengaju()->where('pabrik_id', $pabrik->id)->exists()) {
        return back()->with('warning', 'Anda sudah mengajukan untuk tanggal ini.');
    }

    $rencana->pengaju()->attach($pabrik->id, [
        'status' => 'Menunggu Persetujuan',
        'tanggal_diajukan' => now(),
    ]);

    return back()->with('success', 'Pengajuan berhasil dikirim.');
    }

}
