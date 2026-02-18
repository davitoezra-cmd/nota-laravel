<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['no_nota', 'kd_apotek', 'tanggal', 'total_jumlah','nama_penerima', 'id_user'];

    public function apotek()
    {
        return $this->belongsTo(Apotek::class, 'kd_apotek', 'kd_apotek');
    }

    public function detailNota()
    {
        return $this->hasMany(DetailNota::class, 'no_nota', 'no_nota');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
