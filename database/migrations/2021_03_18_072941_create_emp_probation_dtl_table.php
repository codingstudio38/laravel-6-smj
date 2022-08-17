<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpProbationDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('emp_probation_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_no');
            $table->integer('sl_no');
             $table->string('prob_order_no');
            $table->integer('prob_start_date');
            $table->integer('prob_end_date');
            $table->integer('pay_grade');
            $table->integer('intial_basic');
            $table->integer('special_allowance');
            $table->integer('other_allowance');
            $table->string('remarks');
            $table->integer('nominee_dob');
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
