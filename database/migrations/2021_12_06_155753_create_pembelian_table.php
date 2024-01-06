<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_suplier');
            $table->unsignedBigInteger('id_barang');
            $table->string('kodePembelian');
            $table->string('tanggal');
            $table->integer('harga_barang');
            $table->integer('jumlah_barang');
            $table->integer('harga_total');
            $table->timestamps();
            
            $table->foreign('id_suplier')->references('id')->on('suplier');
            $table->foreign('id_barang')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}
