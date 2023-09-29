<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Get data from table_order with join to table_status and users table
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getData()
    {
        $order = DB::table('table_order')
        ->join('table_status', 'table_order.id_status', '=', 'table_status.id')
        ->join('users', 'table_order.id_user', '=', 'users.id')
        ->select('table_order.id', 'table_order.created_at', 'table_status.status', 'table_order.harga_total', 'users.name')
        ->where('table_status.id', '=', 1)
        ->orderBy('table_order.id', 'desc')
        ->paginate(10);
        
        return $order;
    }

    /**
     * Retrieve order data by ID.
     *
     * @param int $id The ID of the order to retrieve.
     * @return Illuminate\Support\Collection The order data.
     */
    public function showData($id)
    {
        $order = DB::table('table_order')
            ->join('table_detail_order', 'table_order.id', '=', 'table_detail_order.id_order')
            ->join('table_barang', 'table_detail_order.id_barang', '=', 'table_barang.id')
            ->join('table_status', 'table_order.id_status', '=', 'table_status.id')
            ->select('table_order.id', 'table_order.created_at', 'table_status.status', 'table_barang.nama_barang', 'table_barang.harga_jual', 'table_detail_order.jumlah', 'table_detail_order.subtotal')
            ->where('table_order.id', '=', $id)
            ->get();
        return $order;
    }
}