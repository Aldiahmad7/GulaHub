<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaGiling;
use Illuminate\Support\Facades\DB;



class PermintaanTerimaController extends Controller
{

    public function permintaanTerima()
    {
        $pabrikId = Auth::user()->id; // Ambil ID pabrik yang login

        // Ambil hanya rencana giling milik pabrik ini
        $rencanaDenganPengajuan = RencanaGiling::where('user_id', $pabrikId)
            ->whereHas('pengaju', function ($query) {
                $query->where('petani_rencana_giling.status', 'Menunggu Persetujuan');
            })
            ->with(['pengaju' => function ($query) {
                $query->where('petani_rencana_giling.status', 'Menunggu Persetujuan');
            }])
            ->get();

        return view('pabrik.permintaan', compact('rencanaDenganPengajuan'));
    }


    public function konfirmasiAjuan(Request $request, $rencanaGilingId, $petaniId)
    {
        $status = $request->input('status'); // "Disetujui" atau "Ditolak"

        DB::beginTransaction();
        try {
            // Update status di pivot untuk petani yg dikonfirmasi
            DB::table('petani_rencana_giling')
                ->where('rencana_giling_id', $rencanaGilingId)
                ->where('petani_id', $petaniId)
                ->update(['status' => $status]);

            if ($status === 'Disetujui') {
                // Tolak semua pengajuan lain di pivot yang berkaitan dengan rencana ini
                DB::table('petani_rencana_giling')
                    ->where('rencana_giling_id', $rencanaGilingId)
                    ->where('petani_id', '!=', $petaniId)
                    ->update(['status' => 'Ditolak']);

                // Ubah status di rencana giling menjadi "Disetujui"
                RencanaGiling::where('id', $rencanaGilingId)
                    ->update(['status' => 'Disetujui']);
            }

            DB::commit();
            return back()->with('success', 'Status berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
