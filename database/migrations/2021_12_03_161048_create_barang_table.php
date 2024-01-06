<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_satuan');
            $table->string('nama_barang');
            $table->integer('harga_beli');
            $table->integer('harga_grosir');
            $table->integer('harga_ecer');
            $table->integer('stok');
            $table->timestamps();

            $table->foreign('id_kategori')->references('id')->on('kategori');
            $table->foreign('id_satuan')->references('id')->on('satuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
