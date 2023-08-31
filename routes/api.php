<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/barang', function (){
    return response()->json([
        'message' => 'success',
        'data' => [
            'id' => 1,
            'nama' => 'Buku',
            'harga' => 10000,
            'stok' => 10,
        ]
    ]);
});
