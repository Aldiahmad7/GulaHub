<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function pengguna()
    {
        return view('admin.pengguna');
    }

    public function laporan()
    {
        return view('admin.laporan');
    }
}
