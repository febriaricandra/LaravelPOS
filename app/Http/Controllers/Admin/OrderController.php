<?php

namespace App\Http\Controllers\Admin;

use App\Services\OrderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        return view('admin.order.index', compact('order'));
    }

    public function show($id){
        //relationship between table_order, table_detail_order, table_barang, table_status
        $order = $this->orderService->showData($id);
        return view('admin.order.show', compact('order'));
    }
}
