<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class PengajuanPabrikController extends Controller
{

    public function ajuanPabrik(Request $request)
    {
        $userId = Auth::id();
        $tahunDipilih = $request->input('tahun');

        $query = DB::table('pabrik_rencana_panen')
            ->join('rencana_panens', 'pabrik_rencana_panen.rencana_panen_id', '=', 'rencana_panens.id')
            ->join('users as petani', 'rencana_panens.user_id', '=', 'petani.id')
            ->where('pabrik_rencana_panen.pabrik_id', $userId);

        // Filter berdasarkan tahun jika dipilih
        if ($tahunDipilih) {
            $query->whereYear('rencana_panens.tanggal', $tahunDipilih);
        }

        $ajuanSaya = $query->select(
                'petani.name as nama_petani',
                'rencana_panens.tanggal as tanggal_rencana',
                'pabrik_rencana_panen.status',
                'pabrik_rencana_panen.tanggal_diajukan'
            )
            ->orderBy('rencana_panens.tanggal', 'desc')
            ->get();

        return view('pabrik.pengajuan', compact('ajuanSaya', 'tahunDipilih'));
    }

}
