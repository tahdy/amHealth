<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Visits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('info')->nullable();
            $table->string('prescription')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('glucose_level')->nullable();
            $table->string('blood_count')->nullable();
            $table->string('Diseases')->nullable();
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('patient_id');

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
        //
    }
}
