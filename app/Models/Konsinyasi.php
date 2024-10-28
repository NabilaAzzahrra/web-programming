<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsinyasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'konsinyasi'
    ];
    protected $table = 'konsinyasi';

<<<<<<< HEAD
    public function  konsinyasi_pro()
    {
        return $this->hasMany(konsinyasi_pro::class, 'id_konsinyasi','id');
    }
=======
    public function konsinyasiProduk(){
        return $this->hasMany(KonsinyasiProduk::class, 'id_konsinyasi');
    }

>>>>>>> 4ccfae710b246ab8aecc969ca6b8d8d3e0b465be
}
