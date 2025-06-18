<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaPanen;
use App\Models\PetaniRencanaGiling;

class DashboardPetaniController extends Controller
{
    public function dashboard()
    {
        $petani = Auth::user();

        $data = [
            'petani' => $petani,
            'totalRencanaPanen' => RencanaPanen::where('user_id', $petani->id)->count(),
            'rencanaPanenTerbaru' => RencanaPanen::where('user_id', $petani->id)
                                            ->latest()
                                            ->take(5)
                                            ->get(),
        ];

        return view('petani.dashboard', $data);
    }
}
