<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpNomineeDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('emp_nominee_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_no');
            $table->integer('sl_no');
            $table->string('nominee_name');
            $table->string('relationship');
            $table->string('address1');
            $table->string('address2');
            $table->string('address3');
            $table->string('contact_ph_no');
            $table->integer('adhara_number');
            $table->string('nominee_dob');
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
