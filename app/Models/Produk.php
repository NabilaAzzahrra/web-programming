<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk',
        'harga',
        'stok',
    ];

    protected $table = 'produk';

    public function  konsinyasi_pro()
    {
        return $this->hasMany(konsinyasi_pro::class, 'id_produk','id');
    }
}
