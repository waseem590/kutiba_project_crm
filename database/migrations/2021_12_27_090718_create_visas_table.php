<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
            $table->string('case_officer');
            $table->string('student_id');
            $table->string('date_visa')->nullable();
            $table->string('visa_type');
            $table->string('num_applicants');
            $table->string('visa_status');
            $table->string('immigration_fees');
            $table->string('immigration_pay_method');
            $table->string('immigration_dop');
            $table->string('service_fee');
            $table->string('service_pay_method');
            $table->string('service_dop');
            $table->string('status')->default('UnComplete');
            $table->string('select_status')->default('UnComplete');
            $table->string('approval_date')->default('UnComplete');
            $table->string('visa_expire_date');
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
        Schema::dropIfExists('visas');
    }
}
