<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatSetorController extends Controller
{

    public function riwayatSetor(Request $request)
    {
        $tahun = $request->input('tahun');
        $petaniId = Auth::user()->id; // ambil id petani yang login

        $riwayat = DB::table('pabrik_rencana_panen')
            ->join('users', 'pabrik_rencana_panen.pabrik_id', '=', 'users.id')
            ->join('rencana_panens', 'pabrik_rencana_panen.rencana_panen_id', '=', 'rencana_panens.id')
            ->select(
                'users.name as nama_pabrik',
                'rencana_panens.tanggal as tanggal_rencana',
                'pabrik_rencana_panen.status',
                'pabrik_rencana_panen.tanggal_diajukan'
            )
            ->where('rencana_panens.user_id', $petaniId) // filter hanya data milik petani login
            ->whereIn('pabrik_rencana_panen.status', ['Disetujui', 'Ditolak'])
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('rencana_panens.tanggal', $tahun);
            })
            ->orderBy('rencana_panens.tanggal', 'desc')
            ->get();

        return view('petani.riwayatsetor', compact('riwayat', 'tahun'));
    }

}
