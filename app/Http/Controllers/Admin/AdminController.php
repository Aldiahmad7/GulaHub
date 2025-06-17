<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\RencanaPanen;
use Illuminate\Http\Request;
use App\Models\RencanaGiling;
use App\Models\PabrikRencanaPanen;
use App\Models\PetaniRencanaGiling;
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
        // Data pengajuan giling dari pabrik ke petani
        $rencanaGilings = RencanaGiling::with(['pabrik', 'petani'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Data pengajuan panen dari petani ke pabrik
        $rencanaPanens = RencanaPanen::with(['petani', 'pabrik'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Data persetujuan petani terhadap pengajuan giling pabrik
        $persetujuanGiling = PetaniRencanaGiling::with(['rencanaGiling.pabrik', 'petani'])
            ->orderBy('tanggal_diajukan', 'desc')
            ->get();

        // Data persetujuan pabrik terhadap pengajuan panen petani
        $persetujuanPanen = PabrikRencanaPanen::with(['rencanaPanen.petani', 'pabrik'])
            ->orderBy('tanggal_diajukan', 'desc')
            ->get();

        return view('admin.laporan', compact(
            'rencanaGilings',
            'rencanaPanens',
            'persetujuanGiling',
            'persetujuanPanen'
        ));
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
