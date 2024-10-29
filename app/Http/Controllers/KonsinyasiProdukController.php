<?php

namespace App\Http\Controllers;

use App\Models\Konsinyasi;
use App\Models\KonsinyasiProduk;
use App\Models\Produk;
use Illuminate\Http\Request;

class KonsinyasiProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konsinyasiProduk = KonsinyasiProduk::paginate(10);
        $konsinyasi = Konsinyasi::all();
        $produk = Produk::all();
        return view('page.konsinyasiProduk.index')->with([
            'konsinyasiProduk' => $konsinyasiProduk,
            'konsinyasi' => $konsinyasi,
            'produk' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $konsinyasiProduk = [
            'id_konsinyasi' => $request->input('id_konsinyasi'),
            'id_produk' => $request->input('id_produk'),
            'stok' => $request->input('stok'),
            'tgl_konsinyasi' => $request->input('tgl_konsinyasi'),
        ];

        $id_produk = $request->input('id_produk');
        $stokKonsinyasi = $request->input('stok');

        $produk = Produk::where('id', $id_produk)->first();
        $stokProduk = $produk->stok;
        // dd($stokProduk);

        $dataProduk = [
            'stok' => $stokProduk + $stokKonsinyasi
        ];

        $updateProduk = Produk::findOrFail($id_produk);
        $updateProduk->update($dataProduk);

        KonsinyasiProduk::create($konsinyasiProduk);

        return back()->with('message_create', 'Data ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'id_konsinyasi' => $request->input('id_konsinyasi_edit'),
            'id_produk' => $request->input('id_produk_edit'),
            'stok' => $request->input('stok'),
            'tgl_konsinyasi' => $request->input('tgl_konsinyasi'),
        ];

        $id_produk = $request->input('id_produk_edit');
        $stokKonsinyasiP = $request->input('stok');

        $produkKonsinyasi = KonsinyasiProduk::where('id', $id)->first();
        $stokLama = $produkKonsinyasi->stok;

        if ($stokLama < $stokKonsinyasiP) {
            $tambahStok = $stokKonsinyasiP - $stokLama;
            $stokUpdate = $stokLama + $tambahStok;
        }else{
            $kurangiStok = $stokLama - $stokKonsinyasiP;
            $stokUpdate = $stokLama - $kurangiStok;
        }

        $dataProduk = [
            'stok' => $stokUpdate
        ];

        $updateProduk = Produk::findOrFail($id_produk);
        $updateProduk->update($dataProduk);

        $konsinyasiProduk = KonsinyasiProduk::findOrFail($id);
        $konsinyasiProduk->update($data);

        return back()->with('message_update', 'Data diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataKonsinyasiP = KonsinyasiProduk::where('id', $id)->first();
        $id_produk = $dataKonsinyasiP->id_produk;
        $stokKonsinyasiP = $dataKonsinyasiP->stok;

        $produk = Produk::where('id', $id_produk)->first();
        $stokProduk = $produk->stok;
        $dataProduk = [
            'stok' => $stokProduk - $stokKonsinyasiP
        ];

        $updateProduk = Produk::findOrFail($id_produk);
        $updateProduk->update($dataProduk);

        $konsinyasiProduk = KonsinyasiProduk::findOrFail($id);
        $konsinyasiProduk->delete();

        return back()->with('message_delete', 'Data dihapus');
    }
}
