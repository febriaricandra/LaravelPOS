<?php

namespace App\Http\Controllers\Admin;

use App\Services\KaryawanService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    //
    private $karyawanService;

    public function __construct(KaryawanService $karyawanService)
    {
        $this->karyawanService = $karyawanService;
    }

    public function index(){

        $karyawan = $this->karyawanService->getData();

        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function create(){
        return view('admin.karyawan.create');
    }

    public function store(Request $request){
        $item = $this->karyawanService->create($request);
        if($item){
            alert()->success('Success', 'Data Karyawan Berhasil Ditambahkan!');
            return redirect('/admin/karyawan')->with('status', 'Data Karyawan Berhasil Ditambahkan!');
        }else{
            alert()->error('Error', 'Data Karyawan Gagal Ditambahkan!');
            return redirect('/admin/karyawan')->with('status', 'Data Karyawan Gagal Ditambahkan!');
        }
    }

    public function destroy($id){
        $item = $this->karyawanService->delete($id);

        if($item){
            alert()->success('Success', 'Data Karyawan Berhasil Dihapus!');
            return redirect('/admin/karyawan')->with('status', 'Data Karyawan Berhasil Dihapus!');
        }else{
            alert()->error('Error', 'Data Karyawan Gagal Dihapus!');
            return redirect('/admin/karyawan')->with('status', 'Data Karyawan Gagal Dihapus!');
        }
    }
}
