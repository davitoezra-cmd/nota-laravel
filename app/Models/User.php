<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
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
