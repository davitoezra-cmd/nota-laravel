<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens; // ← TAMBAHKAN INI
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kd_apotek',
    ];

    protected $hidden = [
        'password',
    ];

    public function notas()
    {
        return $this->hasMany(Nota::class, 'id_user', 'id');
    }

    public function apotek()
    {
        return $this->belongsTo(Apotek::class, 'kd_apotek', 'kd_apotek');
    }
}