<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddStudentDropdownTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_student_dropdown_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('add_student_id');
            $table->unsignedBigInteger('dropdown_type_id');
            $table->string('course_accepted')->default('Not Accepted');
            $table->string('course_complete')->default('UnComplete');
            $table->string('course_complete_date')->nullable();

            $table->foreign('add_student_id')->references('id')->on('add_students');
            $table->foreign('dropdown_type_id')->references('id')->on('dropdown_types');
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
        Schema::dropIfExists('add_student_dropdown_type');
    }
}
