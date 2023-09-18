<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtangController extends Controller
{
    //
    public function index(){
        $utang = DB::table('table_order')
        ->join('table_status', 'table_order.id_status', '=', 'table_status.id')
        ->join('users', 'table_order.id_user', '=', 'users.id')
        ->select('table_order.id', 'table_order.harga_total', 'table_order.created_at', 'table_status.status', 'users.name')
        ->where('table_status.id', '=', 2)
        ->paginate(10);

        return view('karyawan.utang.index', compact('utang'));
    }

    public function show($id){
        //relationship between table_order, table_detail_order, table_barang, table_status
        $utang = DB::table('table_order')
            ->join('table_detail_order', 'table_order.id', '=', 'table_detail_order.id_order')
            ->join('table_barang', 'table_detail_order.id_barang', '=', 'table_barang.id')
            ->join('table_status', 'table_order.id_status', '=', 'table_status.id')
            ->select('table_order.id', 'table_order.created_at', 'table_status.status', 'table_barang.nama_barang', 'table_barang.harga_jual', 'table_detail_order.jumlah', 'table_detail_order.subtotal')
            ->where('table_order.id', '=', $id)
            ->get();
        
        $status = DB::table('table_status')->get();
        return view('karyawan.utang.show', compact('utang', 'status'));
    }

    public function edit($id){
        $utang = DB::table('table_order')->where('id', $id)->first();
        $status = DB::table('table_status')->get();
        return view('karyawan.utang.edit', compact('utang', 'status'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'status' => 'required'
        ]);

        DB::table('table_order')
            ->where('id', $id)
            ->update([
                'id_status' => $request->status
            ]);

        return redirect('/karyawan/utang')->with('status', 'Data utang berhasil diupdate!');
    }
}
