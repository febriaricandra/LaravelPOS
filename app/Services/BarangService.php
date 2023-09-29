<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BarangService
{
    private $idGenerator;

    public function __construct(IdGenerator $idGenerator)
    {
        $this->idGenerator = $idGenerator;
    }

    public function create($request)
    {
        $now = DB::raw('CURRENT_TIMESTAMP');

        try {
            DB::connection()->beginTransaction();
            $barangId = $this->createBarang($request, $now);
            DB::connection()->commit();

            return true;
        } catch (\Exception $e) {
            DB::connection()->rollback();
            return false;
        }
    }

    public function update($request, $id)
    {
        $now = DB::raw('CURRENT_TIMESTAMP');

        try {
            DB::connection()->beginTransaction();
            $this->updateBarang($request, $id, $now);
            DB::connection()->commit();

            return true;
        } catch (\Exception $e) {
            DB::connection()->rollback();
            return false;
        }
    }

    public function delete($id)
    {
        try {
            DB::connection()->beginTransaction();
            $this->deleteBarang($id);
            DB::connection()->commit();

            return true;
        } catch (\Exception $e) {
            DB::connection()->rollback();
            return false;
        }
    }

    public function search($request)
    {
        $barang = DB::table('table_barang')
            ->where('nama_barang', 'like', '%' . $request->search . '%')
            ->paginate(5);
        if ($barang->isEmpty()) {
            return false;
        } else {
            return $barang;
        }
    }

    public function createBarang($request, $now)
    {
        $barangId = $this->idGenerator->generate(['table' => 'table_barang', 'length' => 10, 'prefix' => 'GM-']);
        DB::table('table_barang')->insert([
            'id' => $barangId,
            'nama_barang' => $request->nama_barang,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => 0,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        return $barangId;
    }

    public function updateBarang($request, $id, $now)
    {
        DB::table('table_barang')->where('id', $id)->update([
            'nama_barang' => $request->nama_barang,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
            'updated_at' => $now,
        ]);
    }

    public function deleteBarang($id)
    {
        DB::table('table_barang')->where('id', $id)->delete();
    }
}