<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_doctor_pivot', function (Blueprint $table) {
            $table->foreign(['poli_id'], 'doctors_ibfs_1')->references(['id'])->on('polis');
            $table->foreign(['user_id'], 'doctors_ibff_1')->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_doctor_pivot', function (Blueprint $table) {
            $table->dropForeign('doctors_ibfs_1');
            $table->dropForeign('doctors_ibff_1');
        });
    }
};
