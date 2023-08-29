<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBarangController extends Controller
{
    //
    public function index(){
        $barang = DB::table('table_barang')->paginate(10);

        return Response()->json($barang);
    }
}
