<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('staff_name');
            $table->string('job_title');
            $table->string('email');
            $table->string('contact_no');
            $table->string('contact_no2')->nullable();
            $table->string('dob')->nullable();
            $table->string('notes');
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
        Schema::dropIfExists('school_contacts');
    }
}
