<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Workplace extends Model
{
    //
      protected $table = 'workplace';
    protected $fillable = ['workplace_name'];
       //protected $hidden = array('updated_at', 'created_at');

    public static function workplace_master_view()
    {
        $workplace_view = DB::table('workplace')->get();

        return $workplace_view;
    }
}
