<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermanentAddress1ToEmpMstTable extends Migration
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
             $table->string('permanent_address1')->after('present_address3');
             $table->string('permanent_address2')->after('permanent_address1');
             $table->string('permanent_address3')->after('permanent_address2');
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
        });
    }
}
