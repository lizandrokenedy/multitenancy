<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->double('body_mass');
            $table->double('height');
            $table->unsignedBigInteger('flexibility_id');
            $table->unsignedBigInteger('abdominal_resistance_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('evaluator_id');
            $table->unsignedBigInteger('school_id');
            $table->double('imc');
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('evaluator_id')->references('id')->on('users');
            $table->foreign('school_id')->references('id')->on('schools');
            $table->foreign('flexibility_id')->references('id')->on('flexibility_status');
            $table->foreign('abdominal_resistance_id')->references('id')->on('abdominal_resistance_status');
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
        Schema::dropIfExists('assessments');
    }
}
