<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPayGradeToEmpmstOfficialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empmst_official', function (Blueprint $table) {
            //
             $table->string('pay_grade')->after('emp_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empmst_official', function (Blueprint $table) {
            //
        });
    }
}
