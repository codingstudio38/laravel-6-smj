<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpMstTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('emp_mst', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_no');
            $table->string('emp_name');
            $table->integer('dept_no');
            $table->string('grade_code');
            $table->integer('desg_code');
            $table->date('DOB');
            $table->date('DOJ');
            $table->date('DOP');
            $table->date('retirement_date');
            $table->string('emp_type');
            $table->string('active_type');
            $table->string('inactive_reason');
            $table->date('cont_end_date');
            $table->integer('const_sal');
            $table->date('prob_start_date');
            $table->date('confirm_date');
            $table->string('sex');
            $table->string('marital_status');
            $table->string('blood_group');
            $table->string('id_mark');
            $table->string('spouse_name');
            $table->string('father_name');
            $table->text('present_address1');
            $table->text('present_address2');
            $table->text('present_address3');
            $table->string('ph_no');
            $table->string('email');
            $table->string('payment_mode');
            $table->string('bank_ac_no');
            $table->string('bank_code');
            $table->string('pf_ac_no');
            $table->decimal('basic_pay',12,2);
            $table->decimal('incr_amt',8,2);
            $table->date('incr_due_date');
            $table->date('prob_end_date');
            $table->decimal('vpf_perc',5,2);
            $table->string('catg');
            $table->decimal('da_pay',12,2);
            $table->string('srl_no');
            $table->integer('leave_encash_days');
            $table->string('pf_ded');
            $table->decimal('spl_allow',12,2);
            $table->string('esi_ded');
            $table->string('sal_catg');
            $table->string('esi_ac_no');
            $table->decimal('conv_allow',12,2);
            $table->decimal('vp_perc',5,2);
            $table->decimal('pp1',12,2);
            $table->decimal('pp2',12,2);
            $table->string('pay_grade_code');
            $table->decimal('new_basic_pay',12,2);
            $table->string('mother_name');
            $table->date('spouse_dob');
            $table->date('father_dob');
            $table->date('mother_dob');
            $table->string('employee_code');
            $table->date('lefton_date');
            $table->string('pan_no');
            $table->decimal('spl_allow2',12,2);
            $table->integer('UAN');
            $table->string('adhara_no');
            $table->string('retire');
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
