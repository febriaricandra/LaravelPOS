<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class UtangService
{

    /**
     * Get data from table_order with specific status and join it with table_status and users table.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getData()
    {
        $utang = DB::table('table_order')
        ->join('table_status', 'table_order.id_status', '=', 'table_status.id')
        ->join('users', 'table_order.id_user', '=', 'users.id')
        ->select('table_order.id', 'table_order.harga_total', 'table_order.created_at', 'table_status.status', 'users.name')
        ->where('table_status.id', '=', 2)
        ->paginate(10);

        return $utang;
    }
    
    /**
     * Retrieve data of a specific order including its status, ordered items, and details.
     *
     * @param int $id The ID of the order to retrieve.
     * @return Illuminate\Support\Collection A collection of the order's data including its ID, creation date, status, ordered items, and details.
     */
    public function showData($id)
    {
        $utang = DB::table('table_order')
        ->join('table_detail_order', 'table_order.id', '=', 'table_detail_order.id_order')
        ->join('table_barang', 'table_detail_order.id_barang', '=', 'table_barang.id')
        ->join('table_status', 'table_order.id_status', '=', 'table_status.id')
        ->select('table_order.id', 'table_order.created_at', 'table_status.status', 'table_barang.nama_barang', 'table_barang.harga_jual', 'table_detail_order.jumlah', 'table_detail_order.subtotal')
        ->where('table_order.id', '=', $id)
        ->get();

        return $utang;
    }

    /**
     * Update the status of an order.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return bool
     */
    public function update($request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        DB::table('table_order')
            ->where('id', $id)
            ->update([
                'id_status' => $request->status
            ]);
        
        return true;
    }
}