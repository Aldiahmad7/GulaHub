<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaPanen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'target_id',
        'jenis_tebu',
        'total_panen',
        'tanggal',
        'status',
        'catatan_penolakan'
    ];

    public function petani()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pabrik()
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public function persetujuanPabrik()
    {
        return $this->hasMany(PabrikRencanaPanen::class, 'rencana_panen_id');
    }
}
