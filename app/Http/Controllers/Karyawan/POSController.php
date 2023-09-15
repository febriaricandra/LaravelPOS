<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class POSController extends Controller
{
    //
    public function index(Request $request)
    {
        $barang = DB::table('table_barang')->paginate(4);
        $status = DB::table('table_status')->get();
        return view('karyawan.pos.index', compact('barang', 'status'));
    }

    public function search(Request $request)
    {
        $search_text = $request->search;
        $barang = DB::table('table_barang')->where('nama_barang', 'LIKE', '%' . $search_text . '%')->paginate(4);
        $status = DB::table('table_status')->get();
        return view('karyawan.pos.index', compact('barang', 'status'));
    }

    public function checkout(Request $request)
    {
        $now = DB::raw('CURRENT_TIMESTAMP');
        $request->validate([
            'submitOrder' => 'required',
            'status' => 'required',
            'bayar' => 'required|gt:0|numeric',
            'kembalian' => 'required|numeric',
            'harga_total' => 'required|gt:0|numeric',
        ]);

        try{
            DB::table('table_order')->insert([
                'id' => IdGenerator::generate(['table' => 'table_order', 'length' => 10, 'prefix' => 'INV-']),
                'id_status' => $request->status,
                'id_user' => auth()->user()->id,
                'harga_total' => $request->harga_total,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
    
            $id_order = DB::table('table_order')->where('id_user', auth()->user()->id)->orderBy('id', 'desc')->first();
    
            $submitOrder = json_decode($request->submitOrder);
    
            foreach ($submitOrder as $key => $value) {
                DB::table('table_detail_order')->insert([
                    'id_order' => $id_order->id,
                    'id_barang' => $value->id,
                    'jumlah' => $value->quantity,
                    'subtotal' => $value->subtotal,
                    'bayar' => $request->bayar,
                    'kembalian' => $request->kembalian,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            //stock update
            foreach ($submitOrder as $key => $value) {
                $barang = DB::table('table_barang')->where('id', $value->id)->first();
                $stok = $barang->stok - $value->quantity;
                DB::table('table_barang')->where('id', $value->id)->update([
                    'stok' => $stok,
                ]);
            }
    
            alert()->success('Success', 'Pembelian Berhasil!');
            return redirect('/karyawan/pos')->with('status', 'Pembelian Berhasil!');
        }
        catch(\Exception $e){
            alert()->error('Error', 'Pembelian gagal!');
            return redirect('/karyawan/pos')->with('status', 'Pembelian gagal!');
        }
    }
}
