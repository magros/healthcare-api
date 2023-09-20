<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_medical_service', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');

            $table->unsignedBigInteger('medical_service_id');
            $table->foreign('medical_service_id')->references('id')->on('medical_services')->onDelete('cascade');

            $table->float('cost');
            $table->float('duration');
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
        Schema::dropIfExists('create_doctor_services');
    }
}
