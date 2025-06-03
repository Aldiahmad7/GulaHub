<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaPanen;
use App\Models\RencanaGiling;
use Illuminate\Support\Facades\DB;

class DashboardPetaniController extends Controller
{

    public function dashboardPetani()
    {
        $petani = Auth::user();

        return view('petani.dashboard', compact('petani'));
    }

}
