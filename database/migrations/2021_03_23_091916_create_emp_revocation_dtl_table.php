<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpRevocationDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('emp_revocation_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_no');
            $table->integer('sl_no');
            $table->string('revocation_order_no');
            $table->integer('revocation_order_date');
            $table->string('antecedent_order_no');
            $table->integer('antecedent_order_date');
            $table->string('antecedent_type');
            $table->integer('antecedent_WEE_date');
            $table->integer('antecedent_WET_date');
             $table->integer('revocation_effected_date');
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
