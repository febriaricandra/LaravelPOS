<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getData()
    {
        //take revenue from table_order 
        $revenue = DB::table('table_order')
            ->where('id_status', '=', 1)
            ->sum('harga_total');
        //take revenue by month and years
        $revenuePerMonth = DB::table('table_order')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(harga_total) as revenue'), DB::raw('COUNT(id) as orders'))
            ->where('id_status', '=', 1)
            ->groupBy('month', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        //total barang
        $barang = DB::table('table_barang')->count();

        //total karyawan
        $karyawan = DB::table('users')->where('role', '=', 'karyawan')->count();

        //total utang
        $utang = DB::table('table_order')
            ->where('id_status', '=', 2)
            ->count();

        return [
            'revenue' => $revenue,
            'revenuePerMonth' => $revenuePerMonth,
            'barang' => $barang,
            'karyawan' => $karyawan,
            'utang' => $utang,
        ];
    }
}
