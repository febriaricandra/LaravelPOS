<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CheckoutService
{
    private $idGenerator;

    public function __construct(IdGenerator $idGenerator)
    {
        $this->idGenerator = $idGenerator;
    }

    public function checkout($request)
    {
        $now = DB::raw('CURRENT_TIMESTAMP');

        try {
            DB::connection()->beginTransaction();
            $orderId = $this->createOrder($request, $now);
            $this->createOrderItems($request, $orderId, $now);
            $this->updateStock($request);
            DB::connection()->commit();

            return true;
        } catch (\Exception $e) {
            DB::connection()->rollback();
            return false;
        }
    }

    private function createOrder($request, $now)
    {
        $orderId = $this->idGenerator->generate(['table' => 'table_order', 'length' => 10, 'prefix' => 'INV-']);
        DB::table('table_order')->insert([
            'id' => $orderId,
            'id_status' => $request->status,
            'id_user' => auth()->user()->id,
            'harga_total' => $request->harga_total,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        return $orderId;
    }

    private function createOrderItems($request, $orderId, $now)
    {
        $orderItems = json_decode($request->submitOrder);

        foreach ($orderItems as $item) {
            DB::table('table_detail_order')->insert([
                'id_order' => $orderId,
                'id_barang' => $item->id,
                'jumlah' => $item->quantity,
                'subtotal' => $item->subtotal,
                'bayar' => $request->bayar,
                'kembalian' => $request->kembalian,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    private function updateStock($request)
    {
        $orderItems = json_decode($request->submitOrder);

        foreach ($orderItems as $item) {
            $barang = DB::table('table_barang')->where('id', $item->id)->first();
            $stok = $barang->stok - $item->quantity;
            DB::table('table_barang')->where('id', $item->id)->update([
                'stok' => $stok,
            ]);
        }
    }
}
?>