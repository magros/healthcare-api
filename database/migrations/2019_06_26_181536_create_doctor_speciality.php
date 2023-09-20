<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorSpeciality extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_speciality', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');

            $table->unsignedBigInteger('speciality_id');
            $table->foreign('speciality_id')->references('id')->on('specialities');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_speciality');
    }
}
