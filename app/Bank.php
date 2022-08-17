<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Bank extends Model
{
    //
    protected $table = 'bank_mst';
    protected $fillable = ['bank_code','bank_name','ifsc_code','address'];
       protected $hidden = array('updated_at', 'created_at');



}
