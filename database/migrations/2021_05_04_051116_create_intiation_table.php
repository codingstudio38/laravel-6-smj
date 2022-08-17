<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntiationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('emp_initiation_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_no');
            $table->string('initiative_date');
            $table->string('type');
            $table->string('description');
            $table->string('remark');
            $table->string('upload');
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
