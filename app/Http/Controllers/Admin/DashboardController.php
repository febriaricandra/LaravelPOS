<?php

namespace App\Http\Controllers\Admin;

use App\Services\DashboardService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $revenue = $this->dashboardService->getData()['revenue'];
        $revenuePerMonth = $this->dashboardService->getData()['revenuePerMonth'];
        $barang = $this->dashboardService->getData()['barang'];
        $karyawan = $this->dashboardService->getData()['karyawan'];
        $utang = $this->dashboardService->getData()['utang'];
        $revenueJson = json_encode($revenuePerMonth);
        return view('admin.dashboard.index', compact('revenue','revenuePerMonth', 'revenueJson', 'barang', 'karyawan', 'utang'));
    }
}
