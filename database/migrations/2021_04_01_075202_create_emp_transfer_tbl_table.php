<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpTransferTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::create('emp_trnasfer_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_no')->nullable();
            $table->string('tranfer_order_no');
            $table->string('type');
            $table->date('trans_date');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('from_dept');
            $table->string('to_dept');
            $table->string('from_work');
            $table->string('to_work');
            $table->string('reason');
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
