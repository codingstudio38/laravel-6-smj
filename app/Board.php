<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Board extends Model
{
    //
      protected $table = 'board';
    protected $fillable = ['board_name'];
       protected $hidden = array('updated_at', 'created_at');

    public static function Board_view()
    {
        $board = DB::table('board')->get();

        return $board;
    }
}
