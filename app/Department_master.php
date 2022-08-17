<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Department_master extends Model
{
    //
    protected $table = 'dept_master';
    protected $fillable = ['dept_no','dept_name'];
       

    public static function Department_view()
    {
        $dept = DB::table('dept_master')->get();
        return $dept;
    }
}
