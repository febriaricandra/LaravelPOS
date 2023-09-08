<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Symfony\Component\Console\Input\Input;
use Alert;

class AdminBarangController extends Controller
{
    //
    public function index(Request $request)
    {
        $barang = DB::table('table_barang')->paginate(5);

        return view('admin.barang.index', compact('barang'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $now = DB::raw('CURRENT_TIMESTAMP');
        $request->validate([
            'nama_barang' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'stok' => 'required',
        ]);
        DB::table('table_barang')->insert([
            'id' => IdGenerator::generate(['table' => 'table_barang', 'length' => 10, 'prefix' => 'GM-']), // Generate Id
            'nama_barang' => $request->nama_barang,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        alert()->success('Success', 'Data Barang Berhasil Ditambahkan!');
        return redirect('/admin/barang')->with('status', 'Data Barang Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $barang = DB::table('table_barang')->where('id', $id)->first();
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'stok' => 'required',
        ]);
        DB::table('table_barang')->where('id', $id)->update([
            'nama_barang' => $request->nama_barang,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
        ]);
        alert()->success('Success', 'Data Barang Berhasil diubah!');
        return redirect('/admin/barang')->with('status', 'Data Barang Berhasil Diubah!');
    }

    public function destroy($id)
    {
        DB::table('table_barang')->where('id', $id)->delete();
        return redirect('/admin/barang')->with('status', 'Data Barang Berhasil Dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $barang = DB::table('table_barang')->where('nama_barang', 'like', '%' . $search . '%')->paginate(5);
        if ($barang->isEmpty()) {
            return redirect('/admin/barang')->with('error', 'Data Barang Tidak Ditemukan!');
        }
        return view('admin.barang.index', compact('barang'))->with('status', 'Data Barang Berhasil Ditemukan!');
    }
}
