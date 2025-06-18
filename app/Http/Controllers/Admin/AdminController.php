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
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $pabrikCount = User::where('role', 'pabrik')->count();
        $petaniCount = User::where('role', 'petani')->count();

        $totalPengajuan = RencanaGiling::count() + RencanaPanen::count();

        $recentPengajuan = collect()
            ->merge(
                RencanaGiling::with('pabrik')
                    ->latest()
                    ->take(3)
                    ->get()
                    ->map(function($item) {
                        return (object)[
                            'jenis' => 'Giling',
                            'pengaju' => $item->pabrik->name,
                            'tanggal' => $item->created_at->format('d M Y'),
                            'status' => $item->status
                        ];
                    })
            )
            ->merge(
                RencanaPanen::with('petani')
                    ->latest()
                    ->take(3)
                    ->get()
                    ->map(function($item) {
                        return (object)[
                            'jenis' => 'Panen',
                            'pengaju' => $item->petani->name,
                            'tanggal' => $item->created_at->format('d M Y'),
                            'status' => $item->status
                        ];
                    })
            )
            ->sortByDesc('tanggal')
            ->take(5);

        return view('admin.dashboard', compact(
            'totalUsers',
            'pabrikCount',
            'petaniCount',
            'totalPengajuan',
            'recentPengajuan'
        ));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pengguna berhasil diperbarui'
        ]);
    }

    public function hapusPengguna($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'pabrik' && ($user->rencanaGilings()->exists() || $user->pabrikRencanaPanens()->exists())) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus pabrik yang memiliki data pengajuan'
            ], 422);
        }

        if ($user->role === 'petani' && ($user->rencanaPanens()->exists() || $user->petaniRencanaGilings()->exists())) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus petani yang memiliki data pengajuan'
            ], 422);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil dihapus'
        ]);
    }
}
