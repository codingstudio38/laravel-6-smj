<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkPlaceToEmpMstTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emp_mst', function (Blueprint $table) {
            //
            $table->string('work_place')->after('inactive_reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emp_mst', function (Blueprint $table) {
            //
            $table->dropColumn('work_place');
        });
    }
}
