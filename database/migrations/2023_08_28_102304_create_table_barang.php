<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_barang', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama_barang');
            $table->integer('harga_jual');
            $table->integer('harga_beli');
            $table->integer('stok');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_barang');
    }
};
