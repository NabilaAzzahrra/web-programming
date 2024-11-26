<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_penjualan',
        'id_produk',
        'qty',
        'total'
    ];

    protected $table = 'detail_penjualan';
}
