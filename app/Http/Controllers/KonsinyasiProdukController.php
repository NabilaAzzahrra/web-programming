<?php

namespace App\Http\Controllers;

use App\Models\KonsinyasiProduk;
use Illuminate\Http\Request;

class KonsinyasiProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konsinyasiProduk = KonsinyasiProduk::paginate(10);
        return view('page.konsinyasiProduk.index')->with([
            'konsinyasiProduk' => $konsinyasiProduk
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
            'id_konsinyasi' => $request->input('id_konsinyasi'),
            'id_produk' => $request->input('id_produk'),
            'stok' => $request->input('stok'),
            'tgl_konsinyasi' => $request->input('tgl_konsinyasi'),
        ];

        $konsinyasiProduk = KonsinyasiProduk::findOrFail($id);
        $konsinyasiProduk->update($data);

        return back()->with('message_update', 'Data diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $konsinyasiProduk = KonsinyasiProduk::findOrFail($id);
        $konsinyasiProduk->delete();

        return back()->with('message_delete', 'Data dihapus');
    }
}
