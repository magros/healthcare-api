<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('office_id');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');

            $table->time('hour');
            $table->date('date');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');


            $table->unsignedBigInteger('doctor_medical_service_id');
            $table->foreign('doctor_medical_service_id')->references('id')->on('doctor_medical_service')->onDelete('cascade');

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
        Schema::dropIfExists('medical_appointment');
    }
}
