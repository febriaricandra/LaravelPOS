<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $barang = [
            'nama_barang' => 'Buku Tulis',
            'harga_jual' => 5000,
            'harga_beli' => 3000,
            'stok' => 100,
            'keterangan' => 'Buku Tulis 100 lembar'
        ];

        Barang::create($barang);
    }
}
