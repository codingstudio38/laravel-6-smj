<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
    //
    protected $table = 'user_roles';

      public static function Employee_Role_view()
    {
        $Employee_view = DB::table('user_roles')
                        ->orderBy('id','DESC')
                        ->get();

        return $Employee_view;
  }

}
