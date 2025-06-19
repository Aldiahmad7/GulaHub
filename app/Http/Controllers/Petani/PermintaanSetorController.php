<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaPanen;
use Illuminate\Support\Facades\DB;

class PermintaanSetorController extends Controller
{

    public function permintaanSetor()
    {
    $petaniId = Auth::user()->id; // ambil ID user (petani) yang login

    $rencanaDenganPengajuan = RencanaPanen::where('user_id', $petaniId)
        ->whereHas('pengaju', function ($query) {
            $query->where('pabrik_rencana_panen.status', 'Menunggu Persetujuan');
        })
        ->with(['pengaju' => function ($query) {
            $query->where('pabrik_rencana_panen.status', 'Menunggu Persetujuan');
        }])
        ->get();

    return view('petani.permintaan', compact('rencanaDenganPengajuan'));
    }

    public function konfirmasiSetor(Request $request, $rencanaPanenId, $pabrikId)
    {
        $status = $request->input('status'); // "Disetujui" atau "Ditolak"
        $catatan = $request->input('catatan_penolakan'); // Catatan dari petani

        DB::beginTransaction();
        try {
            $updateData = ['status' => $status];
            if ($status === 'Ditolak' && $catatan) {
                $updateData['catatan_penolakan'] = $catatan;
            }

            // Update status untuk pabrik yang dikonfirmasi
            DB::table('pabrik_rencana_panen')
                ->where('rencana_panen_id', $rencanaPanenId)
                ->where('pabrik_id', $pabrikId)
                ->update($updateData);

            if ($status === 'Disetujui') {
                // Tolak semua pabrik lain dalam rencana yang sama
                DB::table('pabrik_rencana_panen')
                    ->where('rencana_panen_id', $rencanaPanenId)
                    ->where('pabrik_id', '!=', $pabrikId)
                    ->where('status', 'Menunggu Persetujuan')
                    ->update([
                        'status' => 'Ditolak',
                        'catatan_penolakan' => 'Saya sudah menerima ajuan pabrik lain',
                    ]);

                // Update status utama rencana panen
                RencanaPanen::where('id', $rencanaPanenId)
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
