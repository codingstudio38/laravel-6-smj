<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpAchievementTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('emp_achievement_dtl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_no');
            $table->string('achievement_date');
            $table->string('achievement_type');
            $table->string('achievement_period');
            $table->string('remark');
            $table->string('upload');
            $table->rememberToken();
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
