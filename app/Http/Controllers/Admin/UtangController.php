<?php

namespace App\Http\Controllers\Admin;

use App\Services\UtangService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        return view('admin.utang.index', compact('utang'));
    }

    public function show($id){
        //relationship between table_order, table_detail_order, table_barang, table_status
        $utang = $this->utangService->showData($id);
        $status = DB::table('table_status')->get();
        return view('admin.utang.show', compact('utang', 'status'));
    }

    public function edit($id){
        $utang = DB::table('table_order')->where('id', $id)->first();
        $status = DB::table('table_status')->get();
        return view('admin.utang.edit', compact('utang', 'status'));
    }

    public function update(Request $request, $id){
        $item = $this->utangService->update($request, $id);
        return redirect('/admin/utang')->with('status', 'Data utang berhasil diupdate!');
    }
}
