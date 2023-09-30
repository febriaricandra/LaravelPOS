<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class KaryawanService
{
    public function getData()
    {
        $karyawan = DB::table('users')->where('role', '=', 'karyawan')->paginate(10);
        return $karyawan;
    }

    public function create($request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $item = DB::table('users')->insert([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role' => 'karyawan',
        ]);

        return $item;
    }

    public function delete($id)
    {
        $item = DB::table('users')->where('id', '=', $id)->delete();
        return $item;
    }
}