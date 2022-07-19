<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applications_id')->nullable();
            $table->foreign('applications_id')->references('id')->on('applications');
            $table->string('diploma')->nullable();
            $table->string('d_start_date')->nullable();
            $table->string('advance_diploma')->nullable();
            $table->string('ad_start_date')->nullable();
            $table->string('bachelor')->nullable();
            $table->string('b_start_date')->nullable();
            $table->string('bachelor_hons')->nullable();
            $table->string('bh_start_date')->nullable();
            $table->string('graduate_diploma')->nullable();
            $table->string('gd_start_date')->nullable();
            $table->string('masters_degree')->nullable();
            $table->string('md_start_date')->nullable();
            $table->string('doctoral_degree')->nullable();
            $table->string('dd_start_date')->nullable();
            $table->string('primary_school')->nullable();
            $table->string('high_school')->nullable();
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
        Schema::dropIfExists('education');
    }
}
