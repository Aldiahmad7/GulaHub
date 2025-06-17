<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaGiling extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'target_id',
        'kebutuhan_giling',
        'tanggal',
        'status',
        'catatan_penolakan'
    ];

    public function pabrik()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function petani()
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public function persetujuanPetani()
    {
        return $this->hasMany(PetaniRencanaGiling::class, 'rencana_giling_id');
    }
}
