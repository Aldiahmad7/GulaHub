<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }

        return view('auth.login');
    }

    public function showRegisterPabrik()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }

        return view('auth.registerPabrik');
    }

    public function showRegisterPetani()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }

        return view('auth.registerPetani');
    }

    private function redirectToDashboard()
    {
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'pabrik' => redirect()->route('pabrik.dashboard'),
            'petani' => redirect()->route('petani.dashboard'),
            default => redirect('/'),
        };
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            if ($role === 'admin') return redirect()->route('admin.dashboard');
            if ($role === 'pabrik') return redirect()->route('pabrik.dashboard');
            if ($role === 'petani') return redirect()->route('petani.dashboard');

            return redirect('/');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function registerPabrik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('email')) {
                return back()->with('error', 'Email sudah terdaftar!')->withInput();
            }

            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pabrik',
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }

    public function registerPetani(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('email')) {
                return back()->with('error', 'Email sudah terdaftar!')->withInput();
            }

            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petani',
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }
}
