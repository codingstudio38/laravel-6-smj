<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Workplace;
use App\Department_master;
use App\Designation;
use App\Pay_grade_master;
use App\Bank;
use App\Employee_Master;
use App\emp_official;
use App\Category;
use App\Employee_type;
use App\Nominee;
use App\Dependent;
use App\Qualification;
use App\Experience;
use App\Promotion;
use App\Transfer;
use App\Probation;
use App\Contract;
use App\Antecedent;
use App\Revocation;
use App\Intiation;
use App\Achievement;
use App\Appriciation;
use App\Reward;
use App\Qual_lvl;
use App\Remark;
use Response;
use DB;
use Carbon\Carbon;
use Cache;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class Reports2Controller extends Controller
{


  public function pager($items, $perPage = null, $page = null, $options = [])
  {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
  }
  public function bsp_pp1_pp2_all(Request $request)
{
  $all_categories_data = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->select('emp_mst.catg')
  ->where('emp_mst.catg','!=',NULL)
  ->groupBy('emp_mst.catg')
  ->get(); 
  $employee_type = DB::table('emp_mst')
  ->select('emp_mst.emp_type')
  ->where('emp_mst.emp_type','!=',NULL)
  ->groupBy('emp_mst.emp_type')
  ->orderBy('emp_mst.type_store_by', 'ASC')
  ->get();
  $get_categories = array();
  foreach($all_categories_data as $key => $val){
    $get_categories[] = DB::table('category')->where('category_code','=',$val->catg)->first();
  }
 
  if(count($_GET)==0){
    $category = NULL;
    $type = NULL;
  } else {
    if(isset($_GET['category']) && isset($_GET['type'])){
      $category = $request->category;
      $type = $request->type;
    } else {
      $category =NULL;
    }
    if(isset($_GET['type'])){
      $type = $request->type;
    } else {
      $type =NULL;
    }
  }
  if(isset($_GET['page'])){
    $getpage = $request->page;
  } else {
    $getpage =1;
  }
  if(isset($_GET['active_type'])){
    $active_type=$request->active_type;
} else {
    $active_type= "all";
} 
if(isset($_GET['page'])){
  $page=$request->page;
} else {
  $page= 1;
} 

$i=0;
  if($category=="" && $type=="" && $active_type=="all"){

    foreach ($employee_type as $ty) {
      foreach($get_categories as $val){
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
    $data = $setquery->get();

  } else if($category=="all_cat" && $type=="all_type" && $active_type=="all"){

    foreach ($employee_type as $ty) {
      foreach($get_categories as $val){
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
    $data = $setquery->get();

  } else if($category!=="all_cat" && $type=="all_type" && $active_type=="all"){

    foreach ($employee_type as $ty) {
      foreach($get_categories as $val){
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
    $data = $setquery->get();

  } else if($category=="all_cat" && $type!=="all_type" && $active_type=="all"){

    foreach ($employee_type as $ty) {
      foreach($get_categories as $val){
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow')->where('emp_type', "=", $type)->where('catg', "=", $val->category_code);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
    $data = $setquery->get();

  } else if($category=="all_cat" && $type=="all_type" && $active_type!=="all"){

    foreach ($employee_type as $ty) {
      foreach($get_categories as $val){
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('active_type','=',$active_type);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
    $data = $setquery->get();
  
  } else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){

    foreach ($employee_type as $ty) {
      foreach($get_categories as $val){
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow')->where('emp_type', "=", $type)->where('catg', "=", $val->category_code)->where('active_type','=',$active_type);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
    $data = $setquery->get();

  } else if($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){

    $contract_list_A = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow')
    ->where('catg','=',$category)
    ->where('active_type','=',$active_type)
    ->where('emp_type','=',$type)->get();
      $data =  $contract_list_A;

  } else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
    $contract_list_A = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow')
    ->where('catg','=',$category)
    ->where('emp_type','=',$type)->get();
      $data =  $contract_list_A;

  } else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){

    foreach ($employee_type as $ty) {
      foreach($get_categories as $val){
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category)->where('active_type','=',$active_type);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
    $data = $setquery->get();

  } else { 

    foreach ($employee_type as $ty) {
      foreach($get_categories as $val){
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
    $data = $setquery->get();
  }
  
  $employee_list=Reports2Controller::pager($data,30,$page);    
  $data = [ 
    'categories'=>$get_categories,
    'employee_type'=>$employee_type,
   'employee_list'=>$employee_list,
  ];
  
  return view('Frontend.employees-basic-pay-pp1-pp2-allowance-list',$data);
}
 
    public function bankdetails(Request $request)
    {
      $all_categories_data = DB::table('emp_mst')
      ->leftJoin('category','emp_mst.catg','=','category.category_code')
      ->select('emp_mst.catg')
      ->where('emp_mst.catg','!=',NULL)
      ->groupBy('emp_mst.catg')
      ->get();
      $employee_type = DB::table('emp_mst')
      ->select('emp_mst.emp_type')
      ->where('emp_mst.emp_type','!=',NULL)
      ->groupBy('emp_mst.emp_type')
      ->get();
      $get_categories = array();
      foreach($all_categories_data as $key => $val){
        $get_categories[] = DB::table('category')->where('category_code','=',$val->catg)->first();
      }
      if(isset($_GET['active_type'])){
        $active_type=$request->active_type;
    } else {
        $active_type= "";
    } 
    if(isset($_GET['category'])){
        $category=$request->category;
    } else {
        $category= "";
    } 
    if(isset($_GET['type'])){
        $type=$request->type;
    } else {
        $type= "";
    }  
if($category=="" && $type=="" && $active_type==""){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','emp_mst.desg_code','desg_mst.desg_code','desg_mst.desg_name','emp_mst.DOJ','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_grade_code','pay_grade_mst.pay_scale')
  ->paginate(30);
}elseif($category=="all_cat" && $type=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','emp_mst.desg_code','desg_mst.desg_code','desg_mst.desg_name','emp_mst.DOJ','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_grade_code','pay_grade_mst.pay_scale')
  ->paginate(30);
}elseif($category!=="all_cat" && $type=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','emp_mst.desg_code','desg_mst.desg_code','desg_mst.desg_name','emp_mst.DOJ','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_grade_code','pay_grade_mst.pay_scale')
  ->where('emp_mst.catg','=',$category)
  ->paginate(30);
}elseif($category=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','emp_mst.desg_code','desg_mst.desg_code','desg_mst.desg_name','emp_mst.DOJ','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_grade_code','pay_grade_mst.pay_scale')
  ->where('emp_mst.emp_type','=',$type)
  ->paginate(30);
}elseif($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','emp_mst.desg_code','desg_mst.desg_code','desg_mst.desg_name','emp_mst.DOJ','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_grade_code','pay_grade_mst.pay_scale')
  ->where('emp_mst.active_type','=',$active_type)
  ->paginate(30);
}elseif($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','emp_mst.desg_code','desg_mst.desg_code','desg_mst.desg_name','emp_mst.DOJ','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_grade_code','pay_grade_mst.pay_scale')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.emp_type','=',$type)
  ->paginate(30);
}elseif($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','emp_mst.desg_code','desg_mst.desg_code','desg_mst.desg_name','emp_mst.DOJ','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_grade_code','pay_grade_mst.pay_scale')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.emp_type','=',$type)
  ->paginate(30);
}elseif($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','emp_mst.desg_code','desg_mst.desg_code','desg_mst.desg_name','emp_mst.DOJ','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_grade_code','pay_grade_mst.pay_scale')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.emp_type','=',$type)
  ->paginate(30);
}elseif($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','emp_mst.desg_code','desg_mst.desg_code','desg_mst.desg_name','emp_mst.DOJ','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_grade_code','pay_grade_mst.pay_scale')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.active_type','=',$active_type)
  ->paginate(30);
}else{
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','emp_mst.desg_code','desg_mst.desg_code','desg_mst.desg_name','emp_mst.DOJ','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_grade_code','pay_grade_mst.pay_scale')
  ->paginate(30);
}

      $data = [
        'categories'=> $get_categories,
        'employee_type'=> $employee_type,
        'employee_list'=> $employee_list
      ];
      return view('Frontend.employees-address-qualification-pan-account-remuneration-year',$data);
    } 
   

    public function life_insurance(Request $request) 
    {
      $all_categories_data = DB::table('emp_mst')
      ->leftJoin('category','emp_mst.catg','=','category.category_code')
      ->select('emp_mst.catg')
      ->where('emp_mst.catg','!=',NULL)
      ->groupBy('emp_mst.catg')
      ->get();
      $employee_type = DB::table('emp_mst')
      ->select('emp_mst.emp_type')
      ->where('emp_mst.emp_type','!=',NULL)
      ->groupBy('emp_mst.emp_type')
      ->get();
      $get_categories = array();
      foreach($all_categories_data as $key => $val){
        $get_categories[] = DB::table('category')->where('category_code','=',$val->catg)->first();
      }
    if(isset($_GET['type'])){
        $type=$request->type;
    } else {
        $type= "";
    }
    if(isset($_GET['active_type'])){
        $active_type=$request->active_type;
    } else {
        $active_type= "";
    }
    if(isset($_GET['category'])){
        $category=$request->category;
    } else {
        $category= "";
    }
    if($category=="" && $type=="" && $active_type==""){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->paginate(30);
    } elseif($category=="all_cat" && $type=="all_type" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->paginate(30);
    } elseif($category!=="all_cat" && $type=="all_type" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.catg','=',$category)
      ->paginate(30);
    }elseif($category=="all_cat" && $type!=="all_type" && $active_type=="all"){
       $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.emp_type','=',$type)
      ->paginate(30);
    }elseif($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.active_type','=',$active_type)
      ->paginate(30);
    }elseif($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.emp_type','=',$type)
      ->where('emp_mst.active_type','=',$active_type)
      ->paginate(30);
    }elseif($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.catg','=',$category)
      ->where('emp_mst.active_type','=',$active_type)
      ->where('emp_mst.emp_type','=',$type)
      ->paginate(30);
    }elseif($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.active_type','=',$active_type)
      ->where('emp_mst.emp_type','=',$type)
      ->paginate(30);
    }elseif($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.catg','=',$category)
      ->where('emp_mst.emp_type','=',$type)
      ->paginate(30);
    }elseif($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.catg','=',$category)
      ->where('emp_mst.active_type','=',$active_type)
      ->paginate(30);
    } else {
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','desg_mst.desg_code','emp_mst.intial_basic','emp_mst.current_basic','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->paginate(30);
    } 
    $data = [ 
      'categories'=> $get_categories,
      'employee_type'=>$employee_type,
     'employee_list'=>$employee_list,
    ];
      return view('Frontend.employee-life-insurance-scheme',$data);
    }



 public function rpmsbcd(Request $request)
{
    $all_categories_data = DB::table('emp_mst')
    ->leftJoin('category','emp_mst.catg','=','category.category_code')
    ->select('emp_mst.catg')
    ->where('emp_mst.catg','!=',NULL)
    ->groupBy('emp_mst.catg')
    ->get();
    $employee_type = DB::table('emp_mst')
    ->select('emp_mst.emp_type')
    ->where('emp_mst.emp_type','!=',NULL)
    ->groupBy('emp_mst.emp_type')
    ->get();
    $get_categories = array();
    foreach($all_categories_data as $key => $val){
      $get_categories[] = DB::table('category')->where('category_code','=',$val->catg)->first();
    }     

if(isset($_GET['category'])){
    $category=$request->category;
} else {
    $category= "";
} 
if(isset($_GET['type'])){
    $type=$request->type;
} else {
    $type= "";
}
if(isset($_GET['active_type'])){
    $active_type=$request->active_type;
} else {
    $active_type= "";
}

  if($category=="" && $type=="" && $active_type==""){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->paginate(30);
} else if($category=="all_cat" && $type=="all_active" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->paginate(30);
} else if($category!=="all_cat" && $type=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.catg','=',$category)
  ->paginate(30);
} else if($category=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.emp_type','=',$type)
  ->paginate(30);
}  else if($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.active_type','=',$active_type)
  ->paginate(30);
} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.emp_type','=',$type)
  ->paginate(30);
} else if($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.catg','=',$category)
  ->paginate(30);
} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.emp_type','=',$type)
  ->paginate(30);
}else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.catg','=',$category)
  ->paginate(30);
}else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.catg','=',$category)
  ->paginate(30);
} else { 
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','pay_grade_mst.special_allowance','emp_mst.basic_pay','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->paginate(30);
}
  $data = [ 
    'categories'=>$get_categories,
    'employee_type'=>$employee_type,
   'employee_list'=>$employee_list,
  ];
  return view('Frontend.employee-qualification-experience-remuneration',$data);
}





}


