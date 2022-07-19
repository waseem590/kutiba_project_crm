<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('add_students_id');
            $table->string('study_dest');
            $table->string('inst_name');
            $table->string('app_type')->nullable();
            $table->string('duration')->nullable();
            $table->string('start_date')->nullable();
            $table->string('Tuition Fee')->nullable();
            $table->string('status')->default('Submitted');
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
        Schema::dropIfExists('applications');
    }
}
