<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['kd_barang', 'nama_barang', 'quantity', 'satuan', 'harga'];
}
