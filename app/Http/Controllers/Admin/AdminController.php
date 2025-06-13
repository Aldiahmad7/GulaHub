<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function pengguna()
    {
        $pabrikUsers = User::where('role', 'pabrik')->get();
        $petaniUsers = User::where('role', 'petani')->get();

        return view('admin.pengguna', compact('pabrikUsers', 'petaniUsers'));
    }

    public function laporan()
    {
        $pengajuanPabrik = DB::table('pabrik_rencana_panen')
            ->join('users', 'users.id', '=', 'pabrik_rencana_panen.pabrik_id')
            ->join('rencana_panens', 'rencana_panens.id', '=', 'pabrik_rencana_panen.rencana_panen_id')
            ->select(
                'users.name as nama_pabrik',
                'pabrik_rencana_panen.status',
                'pabrik_rencana_panen.catatan_penolakan',
                'pabrik_rencana_panen.tanggal_diajukan',
                'rencana_panens.jenis_tebu',
                'rencana_panens.total_panen',
                'rencana_panens.tanggal as tanggal_rencana',
                DB::raw("'Panen' as jenis_rencana")
            )
            ->get();

        $pengajuanPetani = DB::table('petani_rencana_giling')
            ->join('users', 'users.id', '=', 'petani_rencana_giling.petani_id')
            ->join('rencana_gilings', 'rencana_gilings.id', '=', 'petani_rencana_giling.rencana_giling_id')
            ->select(
                'users.name as nama_petani',
                'petani_rencana_giling.status',
                'petani_rencana_giling.catatan_penolakan',
                'petani_rencana_giling.tanggal_diajukan',
                'rencana_gilings.kebutuhan_giling',
                'rencana_gilings.tanggal as tanggal_rencana',
                DB::raw("'Giling' as jenis_rencana")
            )
            ->get();

        return view('admin.laporan', compact('pengajuanPabrik', 'pengajuanPetani'));
    }

    public function updatePengguna(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json(['message' => 'Berhasil diperbarui']);
    }

    public function hapusPengguna($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Berhasil dihapus']);
    }
}
