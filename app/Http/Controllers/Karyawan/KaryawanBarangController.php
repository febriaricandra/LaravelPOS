<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanBarangController extends Controller
{
    public function index()
    {
        $barang = DB::table('table_barang')->paginate(5);
        return view('karyawan.barang.index', compact('barang'));
    }

    public function create()
    {
        return view('karyawan.barang.create');
    }

    public function store(Request $request)
    {
        $now = DB::raw('CURRENT_TIMESTAMP');
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
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        alert()->success('Success', 'Data Barang Berhasil Ditambahkan!');
        return redirect('/karyawan/barang')->with('status', 'Data Barang Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);
        DB::table('table_barang')->where('id', $id)->update([
            'nama_barang' => $request->nama_barang,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
        ]);
        alert()->success('Success', 'Data Barang Berhasil Diubah!');
        return redirect('/karyawan/barang')->with('status', 'Data Barang Berhasil Diubah!');
    }

    public function edit($id)
    {
        $barang = DB::table('table_barang')->where('id', $id)->first();
        return view('karyawan.barang.edit', compact('barang'));
    }

    public function destroy($id)
    {
        DB::table('table_barang')->where('id', $id)->delete();
        return redirect('/karyawan/barang')->with('status', 'Data Barang Berhasil Dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $barang = DB::table('table_barang')->where('nama_barang', 'like', '%' . $search . '%')->paginate(5);
        if ($barang->isEmpty()) {
            return redirect('/karyawan/barang')->with('error', 'Data Barang Tidak Ditemukan!');
        }
        return view('karyawan.barang.index', compact('barang'))->with('status', 'Data Barang Berhasil Ditemukan!');
    }
}
