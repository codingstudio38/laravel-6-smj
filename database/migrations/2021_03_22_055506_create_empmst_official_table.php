<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpmstOfficialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('empmst_official', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_no');
            $table->integer('intial_special');
            $table->integer('current_special');
            $table->integer('intial_other_special');
            $table->integer('current_other_special');
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
