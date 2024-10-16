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

    public function konsinyasiProduk(){
        return $this->hasMany(KonsinyasiProduk::class, 'id_konsinyasi');
    }
}
