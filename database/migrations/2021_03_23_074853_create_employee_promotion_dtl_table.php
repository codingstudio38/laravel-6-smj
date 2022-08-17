<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePromotionDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        //
         Schema::create('employee_promotion_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_id_no');
            $table->integer('sl_no');
            $table->string('promotion_order_no');
            $table->string('promotion_date');
            $table->string('promotion_effect_date');
           $table->string('from_grade_code');
            $table->integer('from_desg_code');
            $table->integer('desg_code');
            $table->integer('from_design');
            $table->integer('from_basic_pay');
            $table->string('special_allownace');
            $table->string('other_special_allownace');
            $table->integer('to_grade_code');
            $table->integer('to_portion');
            $table->string('to_basic_pay');
            $table->string('total_allowance');
            $table->integer('other_allowance');
            $table->integer('remark');
            $table->string('upload');
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
