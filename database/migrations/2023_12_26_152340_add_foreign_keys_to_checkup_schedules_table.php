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
        Schema::table('checkup_schedules', function (Blueprint $table) {
            $table->foreign(['doctor_id'], 'checkup_schedules_ibfk_1')->references(['id'])->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkup_schedules', function (Blueprint $table) {
            $table->dropForeign('checkup_schedules_ibfk_1');
        });
    }
};
