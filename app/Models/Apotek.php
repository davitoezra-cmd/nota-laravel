<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apotek extends Model
{
   protected $fillable = ['kd_apotek', 'nama_apotek'];

   public function users()
   {
       return $this->hasMany(User::class, 'kd_apotek', 'kd_apotek');
   }
}
