<?php

namespace App\Http\Controllers;

use App\Models\Konsinyasi;
use App\Models\konsinyasi_pro;
use App\Models\Produk;
use Illuminate\Http\Request;

class konsinyasi_proController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konsinyasi_pro = konsinyasi_pro::paginate(5);
        $konsinyasi = Konsinyasi::all();
        $produk = Produk::all();
        return view('page.konsinyasi_pro.index')->with([
            'konsinyasi_pro' => $konsinyasi_pro,
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
        $data = [
            'id_konsinyasi' => $request->input('id_konsinyasi'),
            'id_produk' => $request->input('id_produk'),
            'stok' => $request->input('stok'),
            'tgl_konsinyasi' => $request->input('tgl_konsinyasi'),
        ];

        $id_produk = $request->input('id_produk');
        $stokKonsinyasi = $request->input('stok');
        $produk = Produk::where('id',$id_produk)->first();
        $stokProduk = $produk->stok;
        // dd($stokProduk);

        $dataProduk = [
           'stok'=> $stokProduk + $stokKonsinyasi
        ];

        $updateProduk = Produk::findOrfail($id_produk);
        $updateProduk->update($dataProduk);

        konsinyasi_pro::create($data);

        return back()->with('message_create', 'Data Konsinyasi Sudah ditambahkan');
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


        $id_produk =  $request->input('id_produk');
        $stokkonsinyasi_pro = $request->input('stok');
        $produkKonsinyasi = Konsinyasi_pro::where('id', $id)->first();
        $stokLama = $produkKonsinyasi->stok;

        if ($stokLama < $stokkonsinyasi_pro) {
            $stokUpdate = $stokkonsinyasi_pro + $stokLama;
        } else {
            $stokUpdate= $stokLama - $stokkonsinyasi_pro;
        }

        // dd($stokUpdate);


        $produk = Produk::where('id', $id_produk)->first();
        $stokProduk = $produk->stok;
        $dataProduk =[
            'stok' => $stokProduk = $stokkonsinyasi_pro
        ];

        $updateProduk = Produk::findOrFail($id_produk);
        $updateProduk->update($dataProduk);



        $datas = konsinyasi_pro::findOrFail($id);
        $datas->update($data);

        return back()->with('message_update', 'Data Konsinyasi Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $datakonsinyasi_pro = konsinyasi_pro::where('id',$id)->first();
        $id_produk = $datakonsinyasi_pro->id_produk;
        $stokkonsinyasi_pro = $datakonsinyasi_pro->stok;

        $produk = Produk::where('id', $id_produk)->first();
        $stokProduk = $produk->stok;
        $dataProduk =[
            'stok' => $stokProduk = $stokkonsinyasi_pro
        ];

        $updateProduk = Produk::findOrFail($id_produk);
        $updateProduk->update($dataProduk);

        $konsinyasi_pro = konsinyasi_pro::findOrFail($id);
        $konsinyasi_pro->delete();
        return back()->with('message_delete','Data Konsinyasi Sudah dihapus');
    }
}
