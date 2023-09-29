<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(){
        $order = $this->orderService->getData();
        return view('karyawan.order.index', compact('order'));
    }

    public function show($id){
        //relationship between table_order, table_detail_order, table_barang, table_status
        $order = $this->orderService->showData($id);
        return view('karyawan.order.show', compact('order'));
    }
}
