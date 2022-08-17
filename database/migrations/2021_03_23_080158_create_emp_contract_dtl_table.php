<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpContractDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('emp_contract_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_no');
            $table->integer('sl_no');
            $table->string('cont_order_no');
            $table->integer('cont_start_date');
            $table->integer('cont_end_date');
            $table->string('remarks');
            $table->integer('consolidated_pay');
            $table->integer('special_allowance');
            $table->integer('other_allowance');
            $table->integer('sal');
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
