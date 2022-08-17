<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAntecedentDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('emp_antecedent_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_no');
            $table->integer('sl_no');
            $table->string('order_no');
            $table->integer('order_date');
            $table->string('type');
            $table->integer('WEE_date');
            $table->integer('WET_date');
            $table->string('remarks');
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
