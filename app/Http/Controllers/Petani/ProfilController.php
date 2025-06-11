<?php

namespace App\Http\Controllers\Petani;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('petani.profil', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
        ]);

        \App\Models\User::where('id', Auth::id())->update($validated);

        return redirect()->route('petani.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
