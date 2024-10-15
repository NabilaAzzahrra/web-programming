<?php

use App\Http\Controllers\API\KonsinyasiProdukAPIController;
use App\Http\Controllers\KonsinyasiProdukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/konsinyasiProduk', [KonsinyasiProdukAPIController::class, 'get_all']);
Route::post('/konsinyasiProdukAdd', [KonsinyasiProdukController::class, 'store']);
Route::patch('/konsinyasiProdukUpdate/{id}', [KonsinyasiProdukController::class, 'update']);
Route::delete('/konsinyasiProdukDelete/{id}', [KonsinyasiProdukController::class, 'destroy']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
