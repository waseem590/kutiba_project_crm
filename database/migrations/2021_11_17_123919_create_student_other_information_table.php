<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentOtherInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_other_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('add_students_id')->nullable();
            $table->foreign('add_students_id')->references('id')->on('add_students');
            $table->string('funding_type')->nullable();
            $table->string('sponsor_name')->nullable();
            $table->string('student_source')->nullable();
            $table->string('cohort_name')->nullable();
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
        Schema::dropIfExists('student_other_information');
    }
}
