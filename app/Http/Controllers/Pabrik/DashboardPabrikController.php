<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaGiling;
use App\Models\PabrikRencanaPanen;

class DashboardPabrikController extends Controller
{
    public function dashboard()
    {
        $pabrik = Auth::user();

        $data = [
            'pabrik' => $pabrik,
            'totalRencanaGiling' => RencanaGiling::where('user_id', $pabrik->id)->count(),
            'rencanaGilingTerbaru' => RencanaGiling::where('user_id', $pabrik->id)
                                            ->latest()
                                            ->take(5)
                                            ->get(),
        ];

        return view('pabrik.dashboard', $data);
    }
}
