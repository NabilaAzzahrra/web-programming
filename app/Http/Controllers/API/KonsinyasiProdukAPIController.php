<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KonsinyasiProduk;
use Illuminate\Http\Request;

class KonsinyasiProdukAPIController extends Controller
{
    public function get_all()
    {
        $konsinyasiProduk = KonsinyasiProduk::all();
        return response()->json([
            'konsinyasiProduk' => $konsinyasiProduk,
        ]);
    }
}
