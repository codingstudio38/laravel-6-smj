<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Designation extends Model
{
    //
     protected $table = 'desg_mst';
    protected $fillable = ['desg_code','desg_name'];
  public static function Designation_Master_view()
    {
        $Designation_view = DB::table('desg_mst')->get();
        return $Designation_view;
    }
}
