<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailNota extends Model
{
    protected $fillable = ['no_nota', 'kd_barang', 'quantity', 'harga', 'jumlah'];

    public function nota()
    {
        return $this->belongsTo(Nota::class, 'no_nota', 'no_nota');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kd_barang', 'kd_barang');
    }
}