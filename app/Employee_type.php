<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Employee_type extends Model
{
    //
    protected $table = 'employee_type';
    //protected $fillable = ['desg_code','desg_name'];
  public static function EmployeeType_Master_view()
    {
        $EmployeeType_view = DB::table('employee_type')->get();
        return $EmployeeType_view;
    }

}
