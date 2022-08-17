<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUploadToEmpDependentDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emp_dependent_dtl', function (Blueprint $table) {
            //
             $table->string('upload_adhara')->after('depd_adhara_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emp_dependent_dtl', function (Blueprint $table) {
            //
        });
    }
}
