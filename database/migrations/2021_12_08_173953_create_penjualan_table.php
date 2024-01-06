<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggan')->nullable();
            $table->unsignedBigInteger('id_barang');
            $table->string('kodePenjualan');
            $table->string('tanggal');
            $table->string('jenis');
            $table->string('pelanggan_ecer')->nullable();
            $table->integer('jumlah_barang');
            $table->integer('harga_total');
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id')->on('pelanggan');
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
        Schema::dropIfExists('penjualan');
    }
}
