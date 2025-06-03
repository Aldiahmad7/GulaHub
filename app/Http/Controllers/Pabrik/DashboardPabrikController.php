<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaPanen;
use App\Models\RencanaGiling;
use Illuminate\Support\Facades\DB;

class DasboardPabrikController extends Controller
{

    public function dashboardPabrik()
    {
        $pabrik = Auth::user();

        return view('pabrik.dashboard', compact('pabrik'));
    }

}
