<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\BarangService;

class KaryawanBarangController extends Controller
{
    private $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

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
        $item = $this->barangService->create($request);
        if($item){
            alert()->success('Success', 'Data Barang Berhasil Ditambahkan!');
            return redirect('/karyawan/barang')->with('status', 'Data Barang Berhasil Ditambahkan!');
        }else{
            alert()->error('Error', 'Data Barang Gagal Ditambahkan!');
            return redirect('/karyawan/barang')->with('status', 'Data Barang Gagal Ditambahkan!');
        }
    }

    public function update(Request $request, $id)
    {
        $item = $this->barangService->update($request, $id);
        if($item){
            alert()->success('Success', 'Data Barang Berhasil Diubah!');
            return redirect('/karyawan/barang')->with('status', 'Data Barang Berhasil Diubah!');
        }else{
            alert()->error('Error', 'Data Barang Gagal Diubah!');
            return redirect('/karyawan/barang')->with('status', 'Data Barang Gagal Diubah!');
        }
    }

    public function edit($id)
    {
        $barang = DB::table('table_barang')->where('id', $id)->first();
        return view('karyawan.barang.edit', compact('barang'));
    }

    public function destroy($id)
    {
        $item = $this->barangService->delete($id);
        if($item){
            alert()->success('Success', 'Data Barang Berhasil Dihapus!');
            return redirect('/karyawan/barang')->with('status', 'Data Barang Berhasil Dihapus!');
        }else{
            alert()->error('Error', 'Data Barang Gagal Dihapus!');
            return redirect('/karyawan/barang')->with('status', 'Data Barang Gagal Dihapus!');
        }
    }

    public function search(Request $request)
    {
        $barang = $this->barangService->search($request);
        if($barang){
            alert()->success('Success', 'Data Barang Berhasil Ditemukan!');
            return view('karyawan.barang.index', compact('barang'));
        }else{
            alert()->error('Error', 'Data Barang Tidak Ditemukan!');
            return redirect('/karyawan/barang')->with('status', 'Data Barang Tidak Ditemukan!');
        }
    }
}
