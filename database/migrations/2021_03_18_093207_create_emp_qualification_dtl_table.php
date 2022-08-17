<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpQualificationDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('emp_qualification_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_no');
            $table->integer('sl_no');
            $table->string('emp_quali');
            $table->string('institution');
            $table->integer('division');
            $table->integer('qualification_type');
            $table->integer('year_passing');
            $table->integer('mark_perc');
            $table->integer('stream_subject');
            $table->string('qualification_level_code');
            $table->binary('upload');
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
