<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PabrikRencanaPanen extends Pivot
{
    protected $table = 'pabrik_rencana_panen';

    protected $fillable = [
        'pabrik_id',
        'rencana_panen_id',
        'status',
        'catatan_penolakan',
        'tanggal_diajukan'
    ];

    public function pabrik()
    {
        return $this->belongsTo(User::class, 'pabrik_id');
    }

    public function rencanaPanen()
    {
        return $this->belongsTo(RencanaPanen::class);
    }
}
