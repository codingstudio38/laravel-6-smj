<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Qualification extends Model
{
    //emp_qualification_dtl
     protected $table = 'emp_qualification_dtl';


       public static function Qualification_view()
      {
        $Qualification_view = DB::table('emp_qualification_dtl')->get();
        return $Qualification_view;
      }

}
