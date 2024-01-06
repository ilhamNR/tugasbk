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
        Schema::table('poli_registrants', function (Blueprint $table) {
            $table->foreign(['patient_id'], 'poli_registrants_ibfk_1')->references(['id'])->on('patients');
            $table->foreign(['checkup_schedule_id'], 'poli_registrants_ibfk_2')->references(['id'])->on('checkup_schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poli_registrants', function (Blueprint $table) {
            $table->dropForeign('poli_registrants_ibfk_1');
            $table->dropForeign('poli_registrants_ibfk_2');
        });
    }
};
