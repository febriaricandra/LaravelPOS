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
        Schema::create('table_detail_order', function (Blueprint $table) {
            $table->id();
            $table->string('id_order');
            $table->string('id_barang');
            $table->bigInteger('jumlah');
            $table->bigInteger('harga_total');
            $table->string('keterangan')->nullable();

            $table->foreign('id_order')->references('id')->on('table_order')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('table_barang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_detail_order');
    }
};
