<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorInsurerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_insurer', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('insurer_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('insurer_id')->references('id')->on('insurers');
            $table->float('cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_insurer');
    }
}
