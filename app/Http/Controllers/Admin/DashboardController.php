<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        //take revenue from table_order 
        $revenue = DB::table('table_order')
            ->sum('harga_total');
        //take revenue by month and years
        $revenuePerMonth = DB::table('table_order')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(harga_total) as revenue'), DB::raw('COUNT(id) as orders'))
            ->groupBy('month', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        //total barang
        $barang = DB::table('table_barang')->count();

        //total karyawan
        $karyawan = DB::table('users')->count();

        //total utang
        $utang = DB::table('table_order')
            ->where('id_status', '=', 2)
            ->count();

        $revenueJson = json_encode($revenuePerMonth);
        return view('admin.dashboard.index', compact('revenue','revenuePerMonth', 'revenueJson', 'barang', 'karyawan', 'utang'));
    }
}
