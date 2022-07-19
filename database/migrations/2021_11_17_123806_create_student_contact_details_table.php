<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_contact_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('add_students_id')->nullable();
            $table->foreign('add_students_id')->references('id')->on('add_students');
            $table->string('email');
            $table->string('secondary_email')->nullable();
            $table->string('contact_number');
            $table->string('secondary_contact_number')->nullable();
            $table->string('address_details')->nullable();
            $table->string('street_address')->nullable();
            $table->string('suburb')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('post_code')->nullable();
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
        Schema::dropIfExists('student_contact_details');
    }
}
