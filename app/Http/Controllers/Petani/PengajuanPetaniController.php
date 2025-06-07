<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuanPetaniController extends Controller
{
    public function ajuanPetani(Request $request)
    {
        $userId = Auth::id();
        $tahunDipilih = $request->input('tahun');

        $query = DB::table('petani_rencana_giling')
            ->join('rencana_gilings', 'petani_rencana_giling.rencana_giling_id', '=', 'rencana_gilings.id')
            ->join('users as pabrik', 'rencana_gilings.user_id', '=', 'pabrik.id')
            ->where('petani_rencana_giling.petani_id', $userId);

        // Filter berdasarkan tahun jika dipilih
        if ($tahunDipilih) {
            $query->whereYear('rencana_gilings.tanggal', $tahunDipilih);
        }

        $ajuanSaya = $query->select(
                'pabrik.name as nama_pabrik',
                'rencana_gilings.tanggal as tanggal_rencana',
                'petani_rencana_giling.status',
                'petani_rencana_giling.catatan_penolakan',
                'petani_rencana_giling.tanggal_diajukan',
            )
            ->orderBy('rencana_gilings.tanggal', 'desc')
            ->paginate(10);

        return view('petani.pengajuan', compact('ajuanSaya', 'tahunDipilih'));
    }
}
