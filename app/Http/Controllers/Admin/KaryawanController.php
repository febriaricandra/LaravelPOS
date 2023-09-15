<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    //
    public function index(){

        $karyawan = DB::table('users')
            ->where('role', '=', 'karyawan')
            ->paginate(10);

        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function create(){
        return view('admin.karyawan.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role' => 'karyawan',
        ]);

        return redirect()->route('admin.karyawan.index')->with('status', 'Data Karyawan Berhasil Ditambahkan!');
    }

    public function destroy($id){
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect()->route('admin.karyawan.index')->with('status', 'Data Karyawan Berhasil Dihapus!');
    }
}
