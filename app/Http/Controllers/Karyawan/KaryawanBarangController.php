<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class KaryawanBarangController extends Controller
{
    public function index()
    {
        $barang = DB::table('table_barang')->paginate(10);

        return view('karyawan.barang.index', compact('barang'));
    }

    public function create()
    {
        return view('karyawan.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);
        DB::table('table_barang')->insert([
            'id' => IdGenerator::generate(['table' => 'table_barang', 'length' => 10, 'prefix' => 'GM-']),
            'nama_barang' => $request->nama_barang,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => 0,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/karyawan/barang')->with('status', 'Data Barang Berhasil Ditambahkan!');
    }
}
