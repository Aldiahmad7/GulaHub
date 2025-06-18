<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaGiling;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class RencanaGilingController extends Controller
{

    public function rencanaGiling(Request $request)
    {
    $tahun = $request->get('tahun', date('Y'));
    $userId = Auth::user()->id;

    $rencana = RencanaGiling::whereYear('tanggal', $tahun)
        ->where('user_id', $userId)
        ->orderBy('tanggal', 'asc')
        ->paginate(10);

    $dataPerBulan = [];

    foreach ($rencana as $item) {
        $bulanNama = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('F'); // Januari, Februari, ...
        $dataPerBulan[$bulanNama][] = $item;
    }

    return view('pabrik.rencanagiling', [
        'tahunDipilih' => $tahun,
        'dataPerBulan' => $dataPerBulan,
        'rencana' => $rencana,
    ]);
    }

    public function storeRencanaGiling(Request $request)
    {
    $request->validate([
        'kebutuhan_giling' => 'required|string',
        'tanggal' => 'required|date|after_or_equal:today',
    ]);

    RencanaGiling::create([
        'user_id' => Auth::user()->id,
        'kebutuhan_giling' => $request->kebutuhan_giling,
        'tanggal' => $request->tanggal,
        'status' => 'Menunggu',
    ]);

    return redirect()->route('pabrik.rencanagiling', ['tahun' => date('Y', strtotime($request->tanggal))])
    ->with('success', 'Data berhasil ditambahkan!');
    }
    public function destroyGiling($id)
    {
    $rencana = RencanaGiling::findOrFail($id);
    $rencana->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
    public function updateGiling(Request $request, $id)
    {
    $request->validate([
        'kebutuhan_giling' => 'required|string',
        'tanggal' => 'required|date|after_or_equal:today',
    ]);

    $rencana = RencanaGiling::findOrFail($id);

    // Pastikan hanya user yang berhak yang bisa mengubah data
    if ($rencana->user_id !== Auth::user()->id) {
        abort(403, 'Akses ditolak');
    }

    $rencana->update([
        'kebutuhan_giling' => $request->kebutuhan_giling,
        'tanggal' => $request->tanggal,
    ]);

    return redirect()->route('pabrik.rencanagiling', ['tahun' => date('Y', strtotime($request->tanggal))])
        ->with('success', 'Data berhasil diperbarui!');

    }

}
