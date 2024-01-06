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
        Schema::table('checkup_details', function (Blueprint $table) {
            $table->foreign(['medicine_id'], 'checkup_details_ibfk_1')->references(['id'])->on('medicines');
            $table->foreign(['checkup_id'], 'checkup_details_ibfk_2')->references(['id'])->on('checkups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkup_details', function (Blueprint $table) {
            $table->dropForeign('checkup_details_ibfk_1');
            $table->dropForeign('checkup_details_ibfk_2');
        });
    }
};
