<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
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
        return view('admin.laporan');
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
