<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PetaniRencanaGiling extends Pivot
{
    protected $table = 'petani_rencana_giling';

    protected $fillable = [
        'petani_id',
        'rencana_giling_id',
        'status',
        'catatan_penolakan',
        'tanggal_diajukan'
    ];

    public function petani()
    {
        return $this->belongsTo(User::class, 'petani_id');
    }

    public function rencanaGiling()
    {
        return $this->belongsTo(RencanaGiling::class);
    }
}
