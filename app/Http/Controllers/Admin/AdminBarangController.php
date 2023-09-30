<?php

namespace App\Http\Controllers\Admin;

use App\Services\BarangService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;

class AdminBarangController extends Controller
{
    //
    private $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

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
        $item = $this->barangService->create($request);
        if($item){
            alert()->success('Success', 'Data Barang Berhasil Ditambahkan!');
            return redirect('/admin/barang')->with('status', 'Data Barang Berhasil Ditambahkan!');
        }else{
            alert()->error('Error', 'Data Barang Gagal Ditambahkan!');
            return redirect('/admin/barang')->with('status', 'Data Barang Gagal Ditambahkan!');
        }
        
    }

    public function edit($id)
    {
        $barang = DB::table('table_barang')->where('id', $id)->first();
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $item = $this->barangService->update($request, $id);
        if($item){
            alert()->success('Success', 'Data Barang Berhasil Diubah!');
            return redirect('/admin/barang')->with('status', 'Data Barang Berhasil Diubah!');
        }else{
            alert()->error('Error', 'Data Barang Gagal Diubah!');
            return redirect('/admin/barang')->with('status', 'Data Barang Gagal Diubah!');
        }
    }

    public function destroy($id)
    {
        $item = $this->barangService->delete($id);
        if($item){
            alert()->success('Success', 'Data Barang Berhasil Dihapus!');
            return redirect('/admin/barang')->with('status', 'Data Barang Berhasil Dihapus!');
        }else{
            alert()->error('Error', 'Data Barang Gagal Dihapus!');
            return redirect('/admin/barang')->with('status', 'Data Barang Gagal Dihapus!');
        }
    }

    public function search(Request $request)
    {
        $barang = $this->barangService->search($request);
        if($barang){
            alert()->success('Success', 'Data Barang Berhasil Ditemukan!');
            return view('admin.barang.index', compact('barang'));
        }else{
            alert()->error('Error', 'Data Barang Tidak Ditemukan!');
            return redirect('/admin/barang')->with('status', 'Data Barang Tidak Ditemukan!');
        }
    }
}
