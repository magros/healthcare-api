<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->mediumText('description')->nullable();
            $table->string('avatar')->nullable();
            $table->string('address', 150)->nullable();
            $table->string('postal_code', 8)->nullable();
            $table->string('suburb', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('address_reference', 200)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->string('latitude', 20)->nullable();
            $table->string('longitude', 20)->nullable();
            $table->enum('office_type', ['MATRIX', 'BRANCH'])->default('BRANCH');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->integer('hospital_id')->nullable();
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
        Schema::dropIfExists('doctor_offices');
    }
}
