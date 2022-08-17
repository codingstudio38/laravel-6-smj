<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Category extends Model
{
    //
    protected $table = 'category';
   
       

    public static function category_view()
    {
        $category = DB::table('category')->get();
        return $category;
    }
}
