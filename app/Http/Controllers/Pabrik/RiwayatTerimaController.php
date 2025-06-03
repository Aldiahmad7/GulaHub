<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatTerimaController extends Controller
{

    public function riwayatTerima(Request $request)
    {
        $tahun = $request->input('tahun');
        $pabrikId = Auth::user()->id; // ID pabrik yang login

        $riwayat = DB::table('petani_rencana_giling')
            ->join('users', 'petani_rencana_giling.petani_id', '=', 'users.id')
            ->join('rencana_gilings', 'petani_rencana_giling.rencana_giling_id', '=', 'rencana_gilings.id')
            ->select(
                'users.name as nama_petani',
                'rencana_gilings.tanggal as tanggal_rencana',
                'petani_rencana_giling.status',
                'petani_rencana_giling.tanggal_diajukan'
            )
            ->where('rencana_gilings.user_id', $pabrikId) // Filter sesuai pabrik yang login
            ->whereIn('petani_rencana_giling.status', ['Disetujui', 'Ditolak'])
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('rencana_gilings.tanggal', $tahun);
            })
            ->orderBy('rencana_gilings.tanggal', 'desc')
            ->get();

        return view('pabrik.riwayatterima', compact('riwayat', 'tahun'));
    }

}
