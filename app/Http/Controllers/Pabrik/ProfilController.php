<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller

{
    public function edit()
    {
        $user = Auth::user();
        return view('pabrik.profil', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
        ]);

        \App\Models\User::where('id', Auth::id())->update($validated);

        return redirect()->route('pabrik.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
