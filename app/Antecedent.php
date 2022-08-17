<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Antecedent extends Model
{
    //
      protected $table = 'emp_antecedent_dtl';


        public static function Antecedent_view()
    {
        $Antecedent_view = DB::table('emp_antecedent_dtl')->get();
        return $Antecedent_view;
    }
}
