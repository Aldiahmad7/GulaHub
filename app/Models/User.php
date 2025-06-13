<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'alamat',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi: 1 User memiliki banyak RencanaGiling.
     */
    public function rencanaGiling()
    {
        return $this->hasMany(RencanaGiling::class);
    }
    public function rencanaPanen()
    {
        return $this->hasMany(rencanaPanen::class);
    }

    public function pengajuanGiling()
    {
        return $this->belongsToMany(RencanaGiling::class, 'petani_rencana_giling', 'petani_id', 'rencana_giling_id')
            ->withPivot('status', 'tanggal_diajukan')
            ->withTimestamps();
    }

    public function pengajuanPanen()
    {
        return $this->belongsToMany(rencanaPanen::class, 'pabrik_rencana_panen', 'pabrik_id', 'rencana_panen_id')
            ->withPivot('status', 'tanggal_diajukan')
            ->withTimestamps();
    }
}
