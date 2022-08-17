<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Pay_grade_master extends Model
{
    //
    protected $table = 'pay_grade_mst';
    protected $fillable = ['pay_grade_code','pay_grade_desc','pay_scale'];
    public static function Pay_grade_Master_view()
      {
        $Pay_grade_view = DB::table('pay_grade_mst')->get();
        return $Pay_grade_view;
      }
}
