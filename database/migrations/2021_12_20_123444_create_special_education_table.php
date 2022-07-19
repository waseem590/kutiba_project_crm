<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applications_id')->nullable();
            $table->foreign('applications_id')->references('id')->on('applications');
            $table->string('certificate_1')->nullable();
            $table->string('certificate_2')->nullable();
            $table->string('certificate_3')->nullable();
            $table->string('certificate_4')->nullable();
            $table->string('foundation')->nullable();
            $table->string('associate_degree')->nullable();
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
        Schema::dropIfExists('special_education');
    }
}
