<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpExperienceDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('emp_experience_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_no');
            $table->integer('sl_no');
            $table->string('orgn_name');
            $table->string('sector');
            $table->string('position');
            $table->integer('start_date');
            $table->integer('end_date');
            $table->string('reason');
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
