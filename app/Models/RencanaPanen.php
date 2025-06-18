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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengaju()
    {
        return $this->belongsToMany(User::class, 'pabrik_rencana_panen', 'rencana_panen_id', 'pabrik_id')
            ->withPivot('status', 'tanggal_diajukan')
            ->withTimestamps();
    }

    public function petani()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pabrik()
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public function pengajuanPanen()
    {
        return $this->belongsToMany(rencanaPanen::class, 'pabrik_rencana_panen')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function persetujuanPabrik()
    {
        return $this->hasMany(PabrikRencanaPanen::class, 'rencana_panen_id');
    }
}
