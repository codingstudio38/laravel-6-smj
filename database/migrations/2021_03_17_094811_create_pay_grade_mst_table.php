<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayGradeMstTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('pay_grade_mst', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pay_grade_code');
            $table->string('pay_grade_desc');
            $table->string('pay_scale');
            $table->integer('min_scale');
            $table->integer('max_scale');
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
