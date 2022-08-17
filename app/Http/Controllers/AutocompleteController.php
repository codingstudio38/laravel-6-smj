<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AutocompleteController extends Controller
{
    //for create controller - php artisan make:controller AutocompleteController

    function index()
    {
     return view('autocomplete');
    }

    function fetch(Request $request)
    {
    

    $res=array();
    $query = $request->get('query'); 
    $data = DB::table('board')    
           ->get();
     $res[]="<option value =''>Select</option>";  
      foreach($data as $row)
      {
        $res[]="<option style='color:black;font-size:12px;' value='$row->board_name'>".$row->board_name."</option>";
      }
     echo json_encode($res);
      exit();
     }



}
