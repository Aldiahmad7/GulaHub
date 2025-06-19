<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RencanaGiling;

class PermintaanTerimaController extends Controller
{
    public function permintaanTerima()
    {
        $pabrikId = Auth::id();

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
        $catatan = $request->input('catatan_penolakan');

        DB::beginTransaction();
        try {
            $updateData = ['status' => $status];
            if ($status === 'Ditolak' && $catatan) {
                $updateData['catatan_penolakan'] = $catatan;
            }

            DB::table('petani_rencana_giling')
                ->where('rencana_giling_id', $rencanaGilingId)
                ->where('petani_id', $petaniId)
                ->update($updateData);

            if ($status === 'Disetujui') {
                DB::table('petani_rencana_giling')
                    ->where('rencana_giling_id', $rencanaGilingId)
                    ->where('petani_id', '!=', $petaniId)
                    ->where('status', 'Menunggu Persetujuan')
                    ->update([
                        'status' => 'Ditolak',
                        'catatan_penolakan' => 'Saya sudah menerima ajuan petani lain',
                    ]);

                RencanaGiling::where('id', $rencanaGilingId)
                    ->update(['status' => 'Disetujui']);
            }

            DB::commit();
            return back()->with('success', 'Status berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
