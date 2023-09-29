<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UtangService;
use Illuminate\Support\Facades\DB;

class UtangController extends Controller
{
    //
    private $utangService;

    public function __construct(UtangService $utangService)
    {
        $this->utangService = $utangService;
    }

    public function index(){
        $utang = $this->utangService->getData();
        return view('karyawan.utang.index', compact('utang'));
    }

    public function show($id){
        $utang = $this->utangService->showData($id);
        $status = DB::table('table_status')->get();
        return view('karyawan.utang.show', compact('utang', 'status'));
    }

    public function edit($id){
        $utang = DB::table('table_order')->where('id', $id)->first();
        $status = DB::table('table_status')->get();
        return view('karyawan.utang.edit', compact('utang', 'status'));
    }

    public function update(Request $request, $id){
        $item = $this->utangService->update($request, $id);
        if($item){
            alert()->success('Success', 'Data Utang Berhasil Diubah!');
            return redirect('/karyawan/utang')->with('status', 'Data Utang Berhasil Diubah!');
        }else{
            alert()->error('Error', 'Data Utang Gagal Diubah!');
            return redirect('/karyawan/utang')->with('status', 'Data Utang Gagal Diubah!');
        }
    }
}
