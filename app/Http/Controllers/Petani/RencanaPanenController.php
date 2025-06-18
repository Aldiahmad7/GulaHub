<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaPanen;
use App\Models\RencanaGiling;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RencanaPanenController extends Controller
{
    public function rencanaPanen(Request $request)
    {
    $tahun = $request->get('tahun', date('Y'));
    $userId = Auth::user()->id;

    $rencana = RencanaPanen::whereYear('tanggal', $tahun)
        ->where('user_id', $userId)
        ->orderBy('tanggal', 'asc')
        ->paginate(10);

    $dataPerBulan = [];

    foreach ($rencana as $item) {
        $bulanNama = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('F'); // Januari, Februari, ...
        $dataPerBulan[$bulanNama][] = $item;
    }

    return view('petani.rencanapanen', [
        'tahunDipilih' => $tahun,
        'dataPerBulan' => $dataPerBulan,
        'rencana' => $rencana,
    ]);
    }

    public function storeRencanaPanen(Request $request)
    {
    $request->validate([
        'jenis_tebu' => 'required|string',
        'total_panen' => 'required|string',
        'tanggal' => 'required|date|after_or_equal:today',
    ]);

    RencanaPanen::create([
        'user_id' => Auth::user()->id,
        'jenis_tebu' => $request->jenis_tebu,
        'total_panen' => $request->total_panen,
        'tanggal' => $request->tanggal,
        'status' => 'Menunggu',
    ]);

    return redirect()->route('petani.rencanapanen', ['tahun' => date('Y', strtotime($request->tanggal))])
    ->with('success', 'Data berhasil ditambahkan!');
    }
    public function destroyPanen($id)
    {
    $rencana = RencanaPanen::findOrFail($id);
    $rencana->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
    public function updatePanen(Request $request, $id)
    {
    $request->validate([
        'jenis_tebu' => 'required|string',
        'total_panen' => 'required|string',
        'tanggal' => 'required|date|after_or_equal:today',
    ]);

    $rencana = RencanaPanen::findOrFail($id);

    // Pastikan hanya user yang berhak yang bisa mengubah data
    if ($rencana->user_id !== Auth::user()->id) {
        abort(403, 'Akses ditolak');
    }

    $rencana->update([
        'jenis_tebu' => $request->jenis_tebu,
        'total_panen' => $request->total_panen,
        'tanggal' => $request->tanggal,
    ]);

    return redirect()->route('petani.rencanapanen', ['tahun' => date('Y', strtotime($request->tanggal))])
        ->with('success', 'Data berhasil diperbarui!');

    }

}
