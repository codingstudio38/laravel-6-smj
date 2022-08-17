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
use Excel;
use PDF;
use App\Exports\EmployeelistCategoryExport; 
use App\Exports\EmployeelistDepartmentExport; 
use App\Exports\EmployeelistPaygradeExport; 
use App\Exports\EmployeelistEmailExport; 
use App\Exports\EmployeelistPanExport; 
use App\Exports\EmployeelistMasterExport; 
use App\Exports\EmployeeMasterlistwithJoindateExport; 
use App\Exports\EmployeeBirthdayExport; 
use App\Exports\EmployeeContractCompletionExport; 
use App\Exports\EmployeeProbationCompletionExport; 
use App\Exports\EmployeeRetirementDueExport;
use App\Exports\EmployeeRetirementDetailExport; 
use App\Exports\EmployeeOfficialInformationExport; 
use App\Exports\EmployeePersonalInformationExport; 
use App\Exports\EmployeeContractRenewalExport; 
use App\Exports\EmployeeMasterDataReportExport; 
use App\Exports\EmployeeQualiExperienceExport; 
use App\Exports\EmployeeYearofServiceExport; 
use App\Exports\EmployeeBasicePayppExport;  
use App\Exports\EmployeeQualiPanBankExport;  
use App\Exports\EmployeeLifeInsuranceExport;  
use App\Exports\EmployeeQualiExpeRemunerationExport;  

class ReportsControllerExcel extends Controller
{

  public function pager($items, $perPage = null, $page = null, $options = [])
  {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
  }
 


    public function index(Request $request)
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
     
      if(isset($_GET['category'])){
        $category = $request->category ;
      } else {
        $category = "";
      }
      if(isset($_GET['type'])){
        $type = $request->type;
      } else {
        $type ="";
      }
    if(isset($_GET['active_type'])){
        $active_type= $_GET['active_type'];
    } else {
        $active_type= "all";
    }
    if(isset($_GET['page'])){
      $page=$request->page;
    } else {
      $page= 1;
    } 
    $i = 0;

if($category=="" && $type=="" && $active_type=="all"){
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')
      ->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOJ','emp_no','id')
      ->where('catg', "=", $val->category_code)
      ->where('emp_type', "=", $ty->emp_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data =  $setquery->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type=="all"){
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOJ','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type', "=", $ty->emp_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data =  $setquery->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type=="all"){


    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOJ','emp_no','id')->where('catg', "=", $category)->where('emp_type', "=", $ty->emp_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  
  $data =  $setquery->get();
  

} else if($category=="all_cat" && $type!=="all_type" && $active_type=="all"){

  foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOJ','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type', "=", $type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data =  $setquery->get();
  
} else if($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
  
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOJ','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type', "=", $ty->emp_type)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data =  $setquery->get();
  
} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
    foreach($get_categories as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOJ','emp_no','id')->where('catg', "=", $ty->category_code)->where('emp_type', "=", $type)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  $data =  $setquery->get();
} else if($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $list = DB::table('emp_mst')
  ->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOJ','emp_no','id')
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
  $data =  $list;
}else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $list = DB::table('emp_mst')
  ->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOJ','emp_no','id')
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.catg','=',$category)
  ->get(); 
  $data =  $list;
} else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){

    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOJ','emp_no','id')->where('catg', "=", $category)->where('emp_type', "=", $ty->emp_type)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  $data = $setquery->get();

} else { 
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOJ','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type', "=", $ty->emp_type);
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
$date = date('d-m-Y');
if(isset($_GET['page'])){
  $page=$request->page;
  if($page==""){
    $employee_data=$data;
    $serial = 0;
    $filename = "employee-list-category-wise-all";    
  } else{
    $employee_data=ReportsControllerExcel::pager($data,30,$page);  
    $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
    $filename = "employee-list-category-wise-$date-page-$page";
  }
} else {
  $serial = 0;    
  $employee_data=$data;  
  if(count($employee_data) <= 30){
    $filename = "employee-list-category-wise-$date-page-1";
  } else {
    $filename = "employee-list-category-wise-$date-all";
  }
}   
      $send = [
        'slno'=>$serial+1,
        'categories'=>$get_categories,
        'employee_type'=>$employee_type,
        'employee_list'=>$employee_data
      ];
      ob_end_clean();
      ob_start();
      return Excel::download(new EmployeelistCategoryExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);   
    } 
    
   
    public function emp_department_report(Request $request)
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
      $departmment = DB::table('emp_mst')->select('emp_mst.dept_no')
      ->where('emp_mst.dept_no','!=',NULL)
      ->groupBy('emp_mst.dept_no')
      ->get();
      $get_departmment = array();
      foreach($departmment as $key1 => $val1){
        $get_departmment[] = DB::table('dept_master')->where('dept_no','=',$val1->dept_no)->first();
      }
      
    if(isset($_GET['department'])){
        $department= $request->department;
    } else {
        $department= "";
    }
    if(isset($_GET['category'])){
      $category= $request->category;
    } else {
        $category= "";
    }
    if(isset($_GET['type'])){
        $type= $request->type;
    } else {
        $type= "";
    }
  if(isset($_GET['active_type'])){
      $active_type= $_GET['active_type'];
  } else {
      $active_type= "all";
  }
 
  $i = 0;
if($department=="" && $category=="" && $type=="" && $active_type=="all"){
  foreach ($get_departmment as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $val->dept_no)->where('emp_type', "=", $ty->emp_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
}else if($department=="All" && $category=="All" && $type=="All" && $active_type=="all"){
  foreach ($get_departmment as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $val->dept_no)->where('emp_type', "=", $ty->emp_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($department!=="All" && $category=="All" && $type=="All" && $active_type=="all"){

    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $department)->where('emp_type', "=", $ty->emp_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
 
  $data = $setquery->get();
} else if($department=="All" && $category!=="All" && $type=="All" && $active_type=="all"){
  foreach ($get_departmment as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $val->dept_no)->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($department=="All" && $category=="All" && $type!=="All" && $active_type=="all"){
  foreach ($get_departmment as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $val->dept_no)->where('emp_type', "=", $type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
} else if($department=="All" && $category=="All" && $type=="All" && $active_type!=="all"){
  foreach ($get_departmment as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $val->dept_no)->where('emp_type', "=", $ty->emp_type)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($department=="All" && $category=="All" && $type!=="All" && $active_type!=="all"){
  foreach ($get_departmment as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $val->dept_no)->where('emp_type', "=", $type)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
}else if($department=="All" && $category!=="All" && $type!=="All" && $active_type!=="all"){
  foreach ($get_departmment as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $val->dept_no)->where('emp_type', "=", $type)->where('catg','=',$category)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
}else if($department!=="All" && $category!=="All" && $type!=="All" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')
  ->where('emp_mst.dept_no','=',$department)
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.active_type','=',$active_type)
  ->get(); 
  $data = $employee_list;
}else if($department!=="All" && $category!=="All" && $type=="All" && $active_type=="all"){
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $department)->where('emp_type', "=", $ty->emp_type)->where('catg','=',$category);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  $data = $setquery->get();
}else if($department!=="All" && $category!=="All" && $type!=="All" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')
  ->where('emp_mst.dept_no','=',$department)
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.catg','=',$category)
  ->get(); 
  $data = $employee_list;
}else if($department!=="All" && $category=="All" && $type!=="All" && $active_type=="all"){

  $data = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $department)->where('emp_type', "=", $type)->get();

}else if($department=="All" && $category!=="All" && $type=="All" && $active_type!=="all"){
  foreach ($get_departmment as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $val->dept_no)->where('emp_type', "=", $ty->emp_type)->where('catg','=',$category)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
}else if($department!=="All" && $category=="All" && $type!=="All" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')
  ->where('emp_mst.dept_no','=',$department)
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.active_type','=',$active_type)
  ->get(); 
  $data = $employee_list;
}else if($department!=="All" && $category!=="All" && $type=="All" && $active_type!=="all"){
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $department)->where('emp_type', "=", $ty->emp_type)->where('catg','=',$category)->where('emp_mst.active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  $data = $setquery->get();
}else if($department=="All" && $category!=="All" && $type!=="All" && $active_type=="all"){
  foreach ($get_departmment as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $val->dept_no)->where('emp_type', "=", $type)->where('catg','=',$category);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
}else if($department!=="All" && $category=="All" && $type=="All" && $active_type!=="all"){
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $department)->where('emp_type', "=", $ty->emp_type)->where('emp_mst.active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  $data = $setquery->get();
} else {
  foreach ($get_departmment as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','emp_no','id')->where('dept_no', "=", $val->dept_no)->where('emp_type', "=", $ty->emp_type);
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
  $date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$data;
      $serial = 0;
      $filename = "employee-list-department-wise-all";    
    } else{
      $employee_data=ReportsControllerExcel::pager($data,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employee-list-department-wise-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$data;  
    if(count($employee_data) <= 30){
      $filename = "employee-list-department-wise-$date-page-1";
    } else {
      $filename = "employee-list-department-wise-$date-all";
    }
  }   
  $send = [
    'categories'=>$get_categories,
    'employee_type'=>$employee_type,
    'departmment'=>$get_departmment,
    'employee_list'=>$employee_data,
    'slno'=>$serial+1
  ];
       
        ob_end_clean();
        ob_start();
        return Excel::download(new EmployeelistDepartmentExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);   

    }


    public function emp_pay_report(Request $request){
      $all_pay_grade = DB::table('emp_mst')
      ->select('emp_mst.PAY_GRADE_CODE')
      ->where('emp_mst.PAY_GRADE_CODE','!=',NULL)
      ->groupBy('emp_mst.PAY_GRADE_CODE')
      ->get();
      $paygrade = DB::table('emp_mst')->select('emp_mst.PAY_GRADE_CODE')->groupBy('emp_mst.PAY_GRADE_CODE')->orderBy('PAY_GRADE_CODE','ASC')->get();
      //->orderByRaw('CONVERT(PAY_GRADE_CODE, INT) ASC')
      $employee_type = DB::table('emp_mst')
      ->select('emp_mst.emp_type')
      ->where('emp_mst.emp_type','!=',NULL)
      ->groupBy('emp_mst.emp_type')
      ->orderBy('emp_mst.type_store_by', 'ASC')
      ->get();
      $get_pay_grade = array();
      foreach($all_pay_grade as $key => $vals){
        $check_pay_grade = DB::table('pay_grade_mst')->where('pay_grade_code','=',$vals->PAY_GRADE_CODE)->count();
        if($check_pay_grade!==0){
          $get_pay_grade[] = DB::table('pay_grade_mst')->where('pay_grade_code','=',$vals->PAY_GRADE_CODE)->first();
        }
      }
      $all_categories_data = DB::table('emp_mst')->select('emp_mst.catg')->where('emp_mst.catg','!=',NULL)->groupBy('emp_mst.catg')->get();
      $get_categories = array();
      foreach($all_categories_data as $key => $val){
        $get_categories[] = DB::table('category')->where('category_code','=',$val->catg)->first();
      }

if(isset($_GET['grade'])){
  $grade = $request->grade ;
} else {
  $grade = "";
}
if(isset($_GET['type'])){
  $type = $request->type;
} else {
  $type = "";
}
if(isset($_GET['active_type'])){
    $active_type= $request->active_type;
} else {
    $active_type= "all";
}
$i = 0;
   
if($grade=="" && $type=="" && $active_type=="all"){
  foreach ($get_categories as $val) {
    foreach($employee_type as $type){
      foreach($paygrade as $pay){
          $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type', "=", $type->emp_type)->where('PAY_GRADE_CODE', "=", $pay->PAY_GRADE_CODE);
          if($i < 1){
              $setquery = $query;
          }else{
              $setquery->union($query);
          }
          $i++;
      }
    }
  }
  $data = $setquery->get();
} else if($grade=="all_grade" && $type=="all_type" && $active_type=="all"){
  foreach ($get_categories as $val) {
    foreach($employee_type as $type){
      foreach($paygrade as $pay){
        $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type', "=", $type->emp_type)->where('PAY_GRADE_CODE', "=", $pay->PAY_GRADE_CODE);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
  }
  $data = $setquery->get();
} else if($grade!=="all_grade" && $type=="all_type" && $active_type=="all"){
  foreach ($get_categories as $val) {
    foreach($employee_type as $type){
      foreach($paygrade as $pay){
        $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type', "=", $type->emp_type)->where('PAY_GRADE_CODE', "=", $grade);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
  }
  $data = $setquery->get();
} else if($grade=="all_grade" && $type!=="all_type" && $active_type=="all"){
  foreach ($get_categories as $val) {
    foreach($paygrade as $pay){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('PAY_GRADE_CODE', "=", $pay->PAY_GRADE_CODE)->where('emp_type','=',$type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($grade=="all_grade" && $type=="all_type" && $active_type!=="all"){
  foreach ($get_categories as $val) {
    foreach($employee_type as $type){
      foreach($paygrade as $pay){
        $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type', "=", $type->emp_type)->where('PAY_GRADE_CODE', "=", $pay->PAY_GRADE_CODE)->where('active_type','=',$active_type);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
  }
  $data = $setquery->get();
} else if($grade=="all_grade" && $type!=="all_type" && $active_type!=="all"){
  foreach ($get_categories as $val) {
    foreach($paygrade as $pay){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('PAY_GRADE_CODE', "=", $pay->PAY_GRADE_CODE)->where('emp_type', "=", $type)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($grade!=="all_grade" && $type!=="all_type" && $active_type!=="all"){
  foreach ($get_categories as $val) {
    foreach($paygrade as $pay){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('PAY_GRADE_CODE', "=", $grade)->where('emp_type', "=", $type)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($grade!=="all_grade" && $type!=="all_type" && $active_type=="all"){
  foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('PAY_GRADE_CODE', "=", $grade)->where('emp_type', "=", $type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
} else if($grade=="all_grade" && $type!=="all_type" && $active_type!=="all"){
  foreach ($get_categories as $val) {
    foreach($paygrade as $pay){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('PAY_GRADE_CODE', "=", $pay->PAY_GRADE_CODE)->where('emp_type', "=", $type)->where('active_type', "=", $active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($grade!=="all_grade" && $type=="all_type" && $active_type!=="all"){
  foreach ($get_categories as $val) {
    foreach($employee_type as $type){
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type', "=", $type->emp_type)->where('PAY_GRADE_CODE', "=", $grade)->where('active_type', "=", $active_type);
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
  foreach ($get_categories as $val) {
    foreach($employee_type as $type){
      foreach($paygrade as $pay){
        $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','PAY_GRADE_CODE','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type', "=", $type->emp_type)->where('PAY_GRADE_CODE', "=", $pay->PAY_GRADE_CODE);
        if($i < 1){
            $setquery = $query;
        }else{
            $setquery->union($query);
        }
        $i++;
      }
    }
  } 
  $data = $setquery->get();
}

  $date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$data;
      $serial = 0;
      $filename = "employee-list-pay-grade-wise-all";    
    } else{
      $employee_data=ReportsControllerExcel::pager($data,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employee-list-pay-grade-wise-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$data;  
    if(count($employee_data) <= 30){
      $filename = "employee-list-pay-grade-wise-$date-page-1";
    } else {
      $filename = "employee-list-pay-grade-wise-$date-all";
    }
  }   
    $send = [
      'slno'=>$serial+1,
      'categories'=>$get_categories,
      'pay_grade'=>$get_pay_grade,
      'employee_type'=>$employee_type,
      'employee_list'=>$employee_data 
    ]; 
    ob_end_clean();
    ob_start();
    return Excel::download(new EmployeelistPaygradeExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);   
    }   


    public function emp_email_report(Request $request){ 
      $employee_type = DB::table('emp_mst')
      ->select('emp_mst.emp_type')
      ->where('emp_mst.emp_type','!=',NULL)
      ->groupBy('emp_mst.emp_type')
      ->get();
      $all_categories_data = DB::table('emp_mst')->select('emp_mst.catg')->where('emp_mst.catg','!=',NULL)->groupBy('emp_mst.catg')->get();
      $get_categories = array();
      foreach($all_categories_data as $key => $val){
        $get_categories[] = DB::table('category')->where('category_code','=',$val->catg)->first();
      }
      if(count($_GET)==0){
        $type= "all";
        $email= "all";
        $code= "all";
    } else {
      if(isset($_GET['type'])){
        $type= $request->type;
      } else {
        $type= "all";
      }
      if(isset($_GET['email'])){
        $email = $request->email;
      } else {
        $email = "all";
      }
      if(isset($_GET['code'])){
        $code =$request->code;
      } else {
        $code ="all";
      }
    }
    if(isset($_GET['active_type'])){
      $active_type =$request->active_type;
    } else {
      $active_type ="all";
    }
    if($email=="y"){
      $cemail = "!=";
    } else if($email=="n"){
      $cemail = "=";
    }
    if($code=="y"){
      $ccode = "!=";
    } else if($code=="n"){
      $ccode = "=";
    }
    if(isset($_GET['page'])){
      $page=$request->page;
    } else {
      $page= 1;
    } 
    $i = 0;
if($type=="" && $code=="" && $email=="" && $active_type==""){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
} else if($type=="all" && $code=="all" && $email=="all" && $active_type=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
} else if($type!=="all" && $code=="all" && $email=="all" && $active_type=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
} else if($type=="all" && $code!=="all" && $email=="all" && $active_type=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('employee_code',$ccode,null);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type=="all" && $code=="all" && $email!=="all" && $active_type=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('email',$cemail,null);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type=="all" && $code=="all" && $email=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type=="all" && $code=="all" && $email!=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('email',$cemail,null)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type=="all" && $code!=="all" && $email!=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('employee_code',$ccode,null)->where('email',$cemail,null)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type!=="all" && $code!=="all" && $email!=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type)->where('email',$cemail,null)->where('employee_code',$ccode,null)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type!=="all" && $code!=="all" && $email!=="all" && $active_type=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('email',$cemail,null)->where('employee_code',$ccode,null)->where('emp_type','=',$type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type=="all" && $code=="all" && $email!=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('email',$cemail,null)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type!=="all" && $code!=="all" && $email=="all" && $active_type=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type)->where('employee_code',$ccode,null);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type!=="all" && $code!=="all" && $email=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type)->where('employee_code',$ccode,null)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type!=="all" && $code=="all" && $email!=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type)->where('email',$cemail,null)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type=="all" && $code!=="all" && $email=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('employee_code',$ccode,null)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type!=="all" && $code=="all" && $email=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  }else if($type=="all" && $code!=="all" && $email!=="all" && $active_type=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('employee_code',$ccode,null)->where('email',$cemail,null);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else if($type!=="all" && $code=="all" && $email!=="all" && $active_type=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type)->where('email',$cemail,null);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
  } else {
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','email','ph_no','emp_no','id')->where('catg', "=", $val->category_code);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
}

    $date = date('d-m-Y');
    if(isset($_GET['page'])){
      $page=$request->page;
      if($page==""){
        $employee_data=$data;
        $serial = 0;
        $filename = "employee-list-email-category-wise-all";    
      } else{
        $employee_data=ReportsControllerExcel::pager($data,30,$page);  
        $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
        $filename = "employee-list-email-category-wise-$date-page-$page";
      }
    } else {
      $serial = 0;    
      $employee_data=$data;  
      if(count($employee_data) <= 30){
        $filename = "employee-list-email-category-wise-$date-page-1";
      } else {
        $filename = "employee-list-email-category-wise-$date-all";
      }
    }   
      $send = [
        'slno'=>$serial+1,
        'categories' => $get_categories,
        'employee_type'=>$employee_type,
        'employee_list'=>$employee_data
      ];
    ob_end_clean();
    ob_start();
    return Excel::download(new EmployeelistEmailExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);      



  }



  public function emp_pan_report(Request $request){
    $employee_type = DB::table('emp_mst')
    ->select('emp_mst.emp_type')
    ->where('emp_mst.emp_type','!=',NULL)
    ->groupBy('emp_mst.emp_type')
    ->get();
    $all_categories_data = DB::table('emp_mst')->select('emp_mst.catg')->where('emp_mst.catg','!=',NULL)->groupBy('emp_mst.catg')->get();
      $get_categories = array();
      foreach($all_categories_data as $key => $val){
        $get_categories[] = DB::table('category')->where('category_code','=',$val->catg)->first();
      }
    if(count($_GET)==0){
      $type= "all";
      $pan= "all";
  } else {
    if(isset($_GET['pan'])){
      $pan = $request->pan;
    } else {
      $pan = "all";
    }
    if(isset($_GET['type'])){
      $type = $request->type;
    } else {
      $type ="all";
    }
  }
     
  if($pan=="y"){
    $cpan = "!=";
  } else if($pan=="n"){
    $cpan = "=";
  }
  if(isset($_GET['active_type'])){
    $active_type= $_GET['active_type'];
} else {
    $active_type= "all";
}
if(isset($_GET['page'])){
  $page=$request->page;
} else {
  $page= 1;
} 
$i = 0;
  if($type=="" && $pan=="" && $active_type==""){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOB','DOJ','pan_no','emp_no','id')->where('catg', "=", $val->category_code);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
    $data = $setquery->get();
  } else if($type=="all" && $pan=="all" && $active_type=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOB','DOJ','pan_no','emp_no','id')->where('catg', "=", $val->category_code);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
    $data = $setquery->get();
  } else if($type!=="all" && $pan=="all" && $active_type=="all"){
  foreach ($get_categories as $val) {
    $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOB','DOJ','pan_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
  }
  $data = $setquery->get();
  } else if($type=="all" && $pan!=="all" && $active_type=="all"){
  foreach ($get_categories as $val) {
    $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOB','DOJ','pan_no','emp_no','id')->where('catg', "=", $val->category_code)->where('pan_no',$cpan,NULL);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
  }
  $data = $setquery->get();
  } else if($type=="all" && $pan=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOB','DOJ','pan_no','emp_no','id')->where('catg', "=", $val->category_code)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
    $data = $setquery->get();
  }else if($type=="all" && $pan!=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOB','DOJ','pan_no','emp_no','id')->where('catg', "=", $val->category_code)->where('pan_no',$cpan,NULL)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
    $data = $setquery->get();
  } else if($type!=="all" && $pan!=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOB','DOJ','pan_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type) ->where('pan_no',$cpan,NULL)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
    $data = $setquery->get();
  } else if($type!=="all" && $pan=="all" && $active_type!=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOB','DOJ','pan_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type)->where('active_type','=',$active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
    $data = $setquery->get();
  } else if($type!=="all" && $pan!=="all" && $active_type=="all"){
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOB','DOJ','pan_no','emp_no','id')->where('catg', "=", $val->category_code)->where('emp_type','=',$type)->where('pan_no',$cpan,NULL);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
    $data = $setquery->get();
  } else {
    foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('emp_type','catg','employee_code','emp_name','desg_code','dept_no','active_type','DOB','DOJ','pan_no','emp_no','id')->where('catg', "=", $val->category_code);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
    $data = $setquery->get();
  }
    $date = date('d-m-Y');
    if(isset($_GET['page'])){
      $page=$request->page;
      if($page==""){
        $employee_data=$data;
        $serial = 0;
        $filename = "employee-list-pan-category-wise-all";    
      } else{
        $employee_data=ReportsControllerExcel::pager($data,30,$page);  
        $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
        $filename = "employee-list-pan-category-wise-$date-page-$page";
      }
    } else {
      $serial = 0;    
      $employee_data=$data;  
      if(count($employee_data) <= 30){
        $filename = "employee-list-pan-category-wise-$date-page-1";
      } else {
        $filename = "employee-list-pan-category-wise-$date-all";
      }
    }   
      $send = [
        'slno'=>$serial+1,
        'categories' => $get_categories,
        'employee_type'=>$employee_type,
        'employee_list'=>$employee_data
      ];
    ob_end_clean();
    ob_start();
    return Excel::download(new EmployeelistPanExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);

  }


  public function emp_master_list(Request $request)
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
      if(isset($_GET['category'])){
        $category = $request->category ;
      } else {
        $category = "";
      }
      if(isset($_GET['type'])){
        $type = $request->type;
      } else {
        $type ="";
      }
    }
  if(isset($_GET['active_type'])){
      $active_type= $_GET['active_type'];
  } else {
      $active_type= "all";
  }
  if(isset($_GET['page'])){
    $page=$request->page;
  } else {
    $page= 1;
  } 
  $i = 0;
  
if($category=="" && $type=="" && $active_type=="all"){

foreach ($get_categories as $val) {
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')
    ->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')
    ->where('emp_type', "=", $ty->emp_type)
    ->where('catg', "=", $val->category_code);
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
foreach ($get_categories as $val) {
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
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
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
  }
$data = $setquery->get();

} else if($category=="all_cat" && $type!=="all_type" && $active_type=="all"){

foreach ($get_categories as $val) {
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('catg', "=", $val->category_code)->where('emp_type', "=", $type);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
}
$data = $setquery->get();

} else if($category=="all_cat" && $type=="all_type" && $active_type!=="all"){

foreach ($get_categories as $val) {
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('active_type','=',$active_type);
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

foreach ($get_categories as $val) {
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $type)->where('catg', "=", $val->category_code)->where('active_type','=',$active_type);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
}
$data = $setquery->get();

} else if($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
$list = DB::table('emp_mst')
->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')
->where('emp_mst.emp_type','=',$type)
->where('emp_mst.catg','=',$category)
->where('emp_mst.active_type','=',$active_type)
->get();
$data =  $list;
}else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
$list = DB::table('emp_mst')
->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')
->where('emp_mst.emp_type','=',$type)
->where('emp_mst.catg','=',$category)
->get(); 
$data =  $list;
} else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category)->where('active_type','=',$active_type);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
  }
$data = $setquery->get();

} else { 
foreach ($get_categories as $val) {
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
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
  $date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$data;
      $serial = 0;
      $filename = "employee-master-list-all";    
    } else{
      $employee_data=ReportsControllerExcel::pager($data,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employee-master-list-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$data;  
    if(count($employee_data) <= 30){
      $filename = "employee-master-list-$date-page-1";
    } else {
      $filename = "employee-master-list-$date-all";
    }
  }   
    $send = [
      'slno'=>$serial+1,
      'categories'=>$get_categories,
      'employee_type'=>$employee_type,
      'employee_list'=>$employee_data
    ];
    ob_end_clean();
    ob_start();
    return Excel::download(new EmployeelistMasterExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);
  } 



  public function emp_master_list_joining_period(Request $request)
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
   

  if(isset($_GET['category'])){
    $category = $request->category ;
  } else {
    $category = "";
  }
  if(isset($_GET['type'])){
    $type = $request->type;
  } else {
    $type ="";
  }
  if(isset($_GET['active_type'])){
      $active_type= $_GET['active_type'];
  } else {
      $active_type= "";
  }
  if(isset($_GET['to'])){
    $to= $_GET['to'];
} else {
    $to= "";
}
if(isset($_GET['from'])){
  $from= $_GET['from'];
} else {
  $from= "";
}

  if(isset($_GET['page'])){
    $page=$request->page;
  } else {
    $page= 1;
  } 
  $i = 0;
if($category=="" && $type=="" && $active_type=="" && $from=="" && $to==""){
  // echo 1; exit;
foreach ($get_categories as $val) {
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')
    ->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
    if($i < 1){
        $setquery = $query;
    } else {
        $setquery->union($query);
    }
    $i++;
  }
}
$data = $setquery->get();
}  else if($category=="all_cat" && $type=="all_type" && $active_type=="all" && $from=="" && $to==""){
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();

} else if($category!=="all_cat" && $type=="all_type" && $active_type=="all" && $from=="" && $to==""){
  
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  $data = $setquery->get();
}else if($category=="all_cat" && $type!=="all_type" && $active_type=="all" && $from=="" && $to==""){
  
  foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $type)->where('catg', "=", $val->category_code);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
$data = $setquery->get();
}else if($category=="all_cat" && $type=="all_type" && $active_type!=="all" && $from=="" && $to==""){
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('active_type', "=", $active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
$data = $setquery->get();
}else if($category=="all_cat" && $type=="all_type" && $active_type=="all" && $from!=="" && $to==""){
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('DOJ', "=", $from);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
$data = $setquery->get();
}else if($category=="all_cat" && $type=="all_type" && $active_type=="all" && $from=="" && $to!==""){
  exit;
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('DOJ', "=", $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
$data = $setquery->get();
}else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all" && $from=="" && $to==""){

$data = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $type)->where('catg', "=", $category)->get();

}else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all" && $from=="" && $to==""){
  foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $type)->where('catg', "=", $val->category_code);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
$data = $setquery->get();
}else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all" && $from=="" && $to==""){
  foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('catg', "=", $val->category_code)->where('active_type', "=", $active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
$data = $setquery->get();
}else if($category=="all_cat" && $type=="all_type" && $active_type!=="all" && $from!=="" && $to==""){
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('active_type', "=", $active_type)->where('DOJ', "=", $from);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
$data = $setquery->get();
}else if($category=="all_cat" && $type=="all_type" && $active_type!=="all" && $from=="" && $to!==""){
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('active_type', "=", $active_type)->where('DOJ', "=", $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
$data = $setquery->get();
}else if($category=="all_cat" && $type!=="all_type" && $active_type=="all" && $from=="" && $to!==""){
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $type)->where('catg', "=", $val->category_code)->where('DOJ', "=", $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
$data = $setquery->get();
}else if($category!=="all_cat" && $type=="all_type" && $active_type=="all" && $from=="" && $to!==""){
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category)->where('DOJ', "=", $to);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
  }
$data = $setquery->get();
}else if($category!=="all_cat" && $type=="all_type" && $active_type=="all" && $from!=="" && $to==""){
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category)->where('DOJ', "=", $from);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
  }
$data = $setquery->get();
}else if($category=="all_cat" && $type!=="all_type" && $active_type=="all" && $from!=="" && $to==""){
  foreach ($get_categories as $val) {
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $type)->where('catg', "=", $val->category_code)->where('DOJ', "=", $from);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
  }
$data = $setquery->get();
}else if($category=="all_cat" && $type=="all_type" && $active_type!=="all" && $from!=="" && $to==""){
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('DOJ', '=', $from)->where('active_type', '=', $active_type);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
$data = $setquery->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type=="all" && $from!=="" && $to!==""){
foreach ($get_categories as $val) {
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('DOJ', '>=', $from)->where('DOJ', '<=', $to);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
  }
}
$data = $setquery->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type=="all" && $from==$to){
  // echo 3; exit;
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('DOJ', '=', $from)->where('DOJ', '=', $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type=="all" && $to==$from){
  // echo 4; exit;
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('DOJ', '=', $from)->where('DOJ', '=', $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type=="all" && $from==$to){
  // echo 5; exit;
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', '=', $category)->where('DOJ', '=', $from)->where('DOJ', '=', $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  $data = $setquery->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type=="all" && $from==$to){
  // echo 6; exit;
  foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('catg', "=", $val->category_code)->where('emp_type', '=', $type)->where('DOJ', '=', $from)->where('DOJ', '=', $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type!=="all" && $from==$to){
  // echo 7; exit;
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('active_type', '=', $active_type)->where('DOJ', '=', $from)->where('DOJ', '=', $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type=="all" && $from!=="" && $to!==""){
  // echo 8; exit;
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', '=', $category)->where('DOJ', '>=', $from)->where('DOJ', '<=', $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
    $data = $setquery->get();    
} else if($category=="all_cat" && $type!=="all_type" && $active_type=="all" && $from!=="" && $to!==""){
  // echo 9; exit;
  foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', '=', $type)->where('catg', "=", $val->category_code)->where('DOJ', '>=', $from)->where('DOJ', '<=', $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type!=="all" && $from!=="" && $to!==""){
  // echo 10; exit;
  foreach ($get_categories as $val) {
    foreach($employee_type as $ty){
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('active_type', '=', $active_type)->where('DOJ', '>=', $from)->where('DOJ', '<=', $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
    }
  }
  $data = $setquery->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all" && $from!=="" && $to!==""){
  // echo 11; exit;
  foreach ($get_categories as $val) {
      $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', '=', $type)->where('catg', "=", $val->category_code)->where('active_type', '=', $active_type)->where('DOJ', '>=', $from)->where('DOJ', '<=', $to);
      if($i < 1){
          $setquery = $query;
      }else{
          $setquery->union($query);
      }
      $i++;
  }
  $data = $setquery->get();
} else if($category!=="all_cat" && $type!=="all_type" && $active_type!=="all" && $from!=="" && $to!==""){
  // echo 12; exit;
  $data = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', '=', $type)->where('catg', "=", $category)->where('active_type', '=', $active_type)->where('DOJ', '>=', $from)->where('DOJ', '<=', $to)->get();

} else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all" && $from!=="" && $to!==""){
  // echo 13; exit;
  $data = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', '=', $type)->where('catg', "=", $category)->where('DOJ', '>=', $from)->where('DOJ', '<=', $to)->get();

} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all" && $from!=="" && $to!==""){
  // echo 14; exit;
  foreach ($get_categories as $val) {
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', '=', $type)->where('catg', "=", $val->category_code)->where('active_type', "=", $active_type)->where('DOJ', '>=', $from)->where('DOJ', '<=', $to);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
}
$data = $setquery->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all" && $from!=="" && $to!==""){
  foreach ($employee_type as $ty) {
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category)->where('active_type', "=", $active_type)->where('DOJ', '>=', $from)->where('DOJ', '<=', $to);
    if($i < 1){
        $setquery = $query;
    }else{
        $setquery->union($query);
    }
    $i++;
}
$data = $setquery->get();
} else { 
foreach ($get_categories as $val) {
  foreach($employee_type as $ty){
    $query = DB::table('emp_mst')->select('id', 'emp_type','employee_code','emp_name','emp_no','active_type','DOJ','confirm_date','retirement_date','DOB','reason_desc','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
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
 
  $date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$data;
      $serial = 0;
      $filename = "employee-master-list-with-joindate-all";    
    } else{
      $employee_data=ReportsControllerExcel::pager($data,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employee-master-list-with-joindate-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$data;  
    if(count($employee_data) <= 30){
      $filename = "employee-master-list-with-joindate-$date-page-1";
    } else {
      $filename = "employee-master-list-with-joindate-$date-all";
    }
  }   
    $send = [
      'slno'=>$serial+1,
      'categories'=>$get_categories,
      'employee_type'=>$employee_type,
      'employee_list'=>$employee_data
    ];
    ob_end_clean();
    ob_start();
    return Excel::download(new EmployeeMasterlistwithJoindateExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);

  } 



  public function emp_birthday_report(Request $request){
    if(count($_GET)==0){
      $cto_date= "";
      $cfrom_date= "";
    } else {
      if(isset($_GET['to_date'])){
        $cto_date= $request->to_date;
      } else {
        $cto_date= "";
      }
      if(isset($_GET['from_date'])){
        $cfrom_date= $request->from_date;
      } else {
        $cfrom_date= "";
      }
    }
  if(isset($_GET['active_type'])){
      $active_type=$request->active_type;
  } else {
      $active_type= "all";
  }  
    if($cfrom_date=="" && $cto_date=="" && $active_type==""){
      $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
  ->get();
    } else if($cfrom_date==$cto_date  && $active_type=="all" ){
      $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.DOB','LIKE',"%$cfrom_date%")
  ->get();  
    } else if($cfrom_date==$cto_date  && $active_type!=="all" ){
      $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.DOB','LIKE',"%$cfrom_date%")
  ->get();
    } else if($cfrom_date!=="" && $cto_date!==""  && $active_type!=="all" ){
      $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.active_type','=',$active_type)
  ->whereBetween(DB::raw("(DATE_FORMAT(emp_mst.DOB,'%Y-%m-%d'))"), [Carbon::createFromFormat('Y-m-d', $cfrom_date)->startOfDay(), Carbon::createFromFormat('Y-m-d', $cto_date)->endOfDay()])
  ->get();
    } else if($cfrom_date!=="" && $cto_date!==""  && $active_type=="all" ){
      $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
  ->whereBetween(DB::raw("(DATE_FORMAT(emp_mst.DOB,'%Y-%m-%d'))"), [Carbon::createFromFormat('Y-m-d', $cfrom_date)->startOfDay(), Carbon::createFromFormat('Y-m-d', $cto_date)->endOfDay()])
  ->get();
    } else { 
      $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
  ->get();
    }

    $date = date('d-m-Y');
    if(isset($_GET['page'])){
      $page=$request->page;
      if($page==""){
        $employee_data=$employee_list;
        $serial = 0;
        $filename = "birthday-fall-report-all";    
      } else{
        $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
        $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
        $filename = "birthday-fall-report-$date-page-$page";
      }
    } else {
      $serial = 0;    
      $employee_data=$employee_list;  
      if(count($employee_data) <= 30){
        $filename = "birthday-fall-report-$date-page-1";
      } else {
        $filename = "birthday-fall-report-$date-all";
      }
    }   
      $send = [
        'slno'=>$serial+1,
        'employee_list'=>$employee_data
      ];
      ob_end_clean();
      ob_start();
      return Excel::download(new EmployeeBirthdayExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);
   }

   public function emp_completion_report(Request $request){
    if(count($_GET)==0){
      $cto_date= "";
      $cfrom_date= "";
    } else {
      if(isset($_GET['to_date'])){
        $cto_date= $request->to_date;
      } else {
        $cto_date= "";
      }
      if(isset($_GET['from_date'])){
        $cfrom_date= $request->from_date;
      } else {
        $cfrom_date= "";
      }
    }
  if(isset($_GET['active_type'])){
      $active_type=$request->active_type;
  } else {
      $active_type= "all";
  } 
    if($cfrom_date=="" && $cto_date==""  && $active_type=="all"){
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_contract_dtl.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no','emp_mst.new_basic_pay')
      ->groupBy('emp_contract_dtl.emp_no')
      ->get();
    } else if($cfrom_date==$cto_date && $active_type=="all"){
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_contract_dtl.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no','emp_mst.new_basic_pay')
      ->groupBy('emp_contract_dtl.emp_no')
      ->orWhere('emp_contract_dtl.cont_start_date','=',$cfrom_date)
      ->orWhere('emp_contract_dtl.cont_end_date','=',$cto_date)
      ->get();
    } else if($cfrom_date==$cto_date && $active_type!=="all"){
      $employee_list = DB::table('emp_contract_dtl')
        ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
        ->select('emp_contract_dtl.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no','emp_mst.new_basic_pay')
        ->groupBy('emp_contract_dtl.emp_no')
        ->where('emp_mst.active_type','=',$active_type)
        ->orWhere('emp_contract_dtl.cont_start_date','=',$cfrom_date)
        ->orWhere('emp_contract_dtl.cont_end_date','=',$cto_date)
        ->get();
    } else if($cfrom_date!=="" && $cto_date!=="" && $active_type!=="all"){
      $employee_list = DB::table('emp_contract_dtl')
        ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
        ->select('emp_contract_dtl.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no','emp_mst.new_basic_pay')
        ->groupBy('emp_contract_dtl.emp_no')
        ->where('emp_contract_dtl.cont_start_date','>=', Carbon::createFromFormat('Y-m-d', $cfrom_date)->startOfDay())
        ->where('emp_contract_dtl.cont_end_date','<=', Carbon::createFromFormat('Y-m-d', $cto_date)->endOfDay())
        ->where('emp_mst.active_type','=',$active_type)
        ->get();
    } else if($cfrom_date!=="" && $cto_date!=="" && $active_type=="all"){
      $employee_list = DB::table('emp_contract_dtl')
        ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
        ->select('emp_contract_dtl.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no','emp_mst.new_basic_pay')
        ->groupBy('emp_contract_dtl.emp_no')
        ->where('emp_contract_dtl.cont_start_date','>=', Carbon::createFromFormat('Y-m-d', $cfrom_date)->startOfDay())
        ->where('emp_contract_dtl.cont_end_date','<=', Carbon::createFromFormat('Y-m-d', $cto_date)->endOfDay())
        ->get();
    } else {
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_contract_dtl.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no','emp_mst.new_basic_pay')
      ->groupBy('emp_contract_dtl.emp_no')
      ->get();
    } 

    $date = date('d-m-Y');
    if(isset($_GET['page'])){
      $page=$request->page;
      if($page==""){
        $employee_data=$employee_list;
        $serial = 0;
        $filename = "contract-completion-report-all";    
      } else{
        $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
        $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
        $filename = "contract-completion-report-$date-page-$page";
      }
    } else {
      $serial = 0;    
      $employee_data=$employee_list;  
      if(count($employee_data) <= 30){
        $filename = "contract-completion-report-$date-page-1";
      } else {
        $filename = "contract-completion-report-$date-all";
      }
    }   
      $send = [
        'slno'=>$serial+1,
        'employee_list'=>$employee_data
      ];
      ob_end_clean();
      ob_start();
      return Excel::download(new EmployeeContractCompletionExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);


  }
  
  public function emp_probation_completion_report(Request $request)
  {
    if(count($_GET)==0){
      $cto_date= "";
      $cfrom_date= "";
    } else {
      if(isset($_GET['to_date'])){
        $cto_date= $request->to_date;
      } else {
        $cto_date= "";
      }
      if(isset($_GET['from_date'])){
        $cfrom_date= $request->from_date;
      } else {
        $cfrom_date= "";
      }
    }
    if(isset($_GET['active_type'])){
      $active_type=$request->active_type;
  } else {
      $active_type= "all";
  }
    if($cfrom_date=="" && $cto_date=="" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->select('employee_code','emp_name','desg_code','dept_no','active_type','DOJ','catg','new_basic_pay','DOP','emp_no','id')
      ->where('emp_mst.emp_type','=','PR')
      ->get();
    } else if($cfrom_date==$cto_date && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->select('employee_code','emp_name','desg_code','dept_no','active_type','DOJ','catg','new_basic_pay','DOP','emp_no','id')
      ->where('emp_mst.emp_type','=','PR')
      ->where('emp_mst.DOP','=',$cto_date)
      ->get();
    } else if($cfrom_date==$cto_date && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->select('employee_code','emp_name','desg_code','dept_no','active_type','DOJ','catg','new_basic_pay','DOP','emp_no','id')
      ->where('emp_mst.emp_type','=','PR')
      ->where('emp_mst.DOP','=',$cto_date)
      ->where('emp_mst.active_type','=',$active_type)
      ->get();
    }  else if($cfrom_date!=="" && $cto_date!=="" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->select('employee_code','emp_name','desg_code','dept_no','active_type','DOJ','catg','new_basic_pay','DOP','emp_no','id')  
      ->where('emp_mst.emp_type','=','PR')
      ->whereBetween('emp_mst.DOP', [new Carbon($cfrom_date), new Carbon($cto_date)])
      ->where('emp_mst.active_type','=',$active_type)
      ->get();
    }   else if($cfrom_date!=="" && $cto_date!=="" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->select('employee_code','emp_name','desg_code','dept_no','active_type','DOJ','catg','new_basic_pay','DOP','emp_no','id','new_basic_pay')
      ->where('emp_mst.emp_type','=','PR')
      ->whereBetween('emp_mst.DOP', [new Carbon($cfrom_date), new Carbon($cto_date)])
      ->get();
    } else {
      $employee_list = DB::table('emp_mst')
      ->select('employee_code','emp_name','desg_code','dept_no','active_type','DOJ','catg','new_basic_pay','DOP','emp_no','id','new_basic_pay')
      ->where('emp_mst.emp_type','=','PR')
      ->get();
    }
    $date = date('d-m-Y');
    if(isset($_GET['page'])){
      $page=$request->page;
      if($page==""){
        $employee_data=$employee_list;
        $serial = 0;
        $filename = "probation-completion-report-all";    
      } else{
        $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
        $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
        $filename = "probation-completion-report-$date-page-$page";
      }
    } else {
      $serial = 0;    
      $employee_data=$employee_list;  
      if(count($employee_data) <= 30){
        $filename = "probation-completion-report-$date-page-1";
      } else {
        $filename = "probation-completion-report-$date-all";
      }
    }   
      $send = [
        'slno'=>$serial+1,
        'employee_list'=>$employee_data
      ];
      ob_end_clean();
      ob_start();
      return Excel::download(new EmployeeProbationCompletionExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);
  }


  public function emp_retirement_due_report(Request $request)
  {
    if(count($_GET)==0){
      $cto_date= "";
      $cfrom_date= "";
    } else {
      if(isset($_GET['to_date'])){
        $cto_date= $request->to_date;
      } else {
        $cto_date= "";
      }
      if(isset($_GET['from_date'])){
        $cfrom_date= $request->from_date;
      } else {
        $cfrom_date= "";
      }
    }
    if(isset($_GET['active_type'])){
      $active_type=$request->active_type;
  } else {
      $active_type= "all";
  }
    if($cfrom_date=="" && $cto_date=="" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('category','emp_mst.catg','=','category.category_code')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('category.category_name','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.retirement_date','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
      ->where('emp_mst.emp_type','=','PE')
      ->get();
    } else if($cfrom_date==$cto_date && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('category','emp_mst.catg','=','category.category_code')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('category.category_name','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.retirement_date','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
      ->where('emp_mst.emp_type','=','PE')
      ->where('emp_mst.retirement_date','=',$cfrom_date)
      ->get();
    } else if($cfrom_date!=="" && $cto_date!=="" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('category','emp_mst.catg','=','category.category_code')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('category.category_name','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.retirement_date','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
      ->where('emp_mst.emp_type','=','PE')
      ->where(DB::raw("(DATE_FORMAT(emp_mst.retirement_date,'%Y-%m-%d'))"), ">=", $cfrom_date)
      ->where(DB::raw("(DATE_FORMAT(emp_mst.retirement_date,'%Y-%m-%d'))"), "<=", $cto_date)
      ->get();
    } else if($cfrom_date!=="" && $cto_date!=="" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('category','emp_mst.catg','=','category.category_code')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('category.category_name','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.retirement_date','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
      ->where('emp_mst.emp_type','=','PE')
      ->where(DB::raw("(DATE_FORMAT(emp_mst.retirement_date,'%Y-%m-%d'))"), ">=", $cfrom_date)
      ->where(DB::raw("(DATE_FORMAT(emp_mst.retirement_date,'%Y-%m-%d'))"), "<=", $cto_date)
      ->where('emp_mst.active_type','=',$active_type)
      ->get();
    }  else {
      $employee_list = DB::table('emp_mst')
      ->leftJoin('category','emp_mst.catg','=','category.category_code')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('category.category_name','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.retirement_date','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
      ->where('emp_mst.emp_type','=','PE')
      ->get();
    }
    $date = date('d-m-Y');
    if(isset($_GET['page'])){
      $page=$request->page;
      if($page==""){
        $employee_data=$employee_list;
        $serial = 0;
        $filename = "retirement-due-report-all";    
      } else{
        $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
        $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
        $filename = "retirement-due-report-$date-page-$page";
      }
    } else {
      $serial = 0;    
      $employee_data=$employee_list;  
      if(count($employee_data) <= 30){
        $filename = "retirement-due-report-$date-page-1";
      } else {
        $filename = "retirement-due-report-$date-all";
      }
    }   
      $send = [
        'slno'=>$serial+1,
        'employee_list'=>$employee_data
      ];
      ob_end_clean();
      ob_start();
      return Excel::download(new EmployeeRetirementDueExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);
  }



  public function emp_retired_report(Request $request)
{

  if(count($_GET)==0){
    $cto_date= "";
    $cfrom_date= "";
  } else {
    if(isset($_GET['to_date'])){
      $cto_date= $request->to_date;
    } else {
      $cto_date= "";
    }
    if(isset($_GET['from_date'])){
      $cfrom_date= $request->from_date;
    } else {
      $cfrom_date= "";
    }
  }
if(isset($_GET['active_type'])){
    $active_type=$request->active_type;
} else {
    $active_type= "all";
}
  if($cfrom_date=="" && $cto_date=="" && $active_type=="all"){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('category','emp_mst.catg','=','category.category_code')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('category.category_name','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.retirement_date','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
    ->where('emp_mst.emp_type','=','PE')
    ->get();
  } else if($cfrom_date==$cto_date && $active_type=="all"){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('category','emp_mst.catg','=','category.category_code')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('category.category_name','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.retirement_date','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
    ->where('emp_mst.emp_type','=','PE')
    ->where('emp_mst.retirement_date','=',$cfrom_date)
    ->get();
  } else if($cfrom_date!=="" && $cto_date!=="" && $active_type=="all"){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('category','emp_mst.catg','=','category.category_code')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('category.category_name','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.retirement_date','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
    ->where('emp_mst.emp_type','=','PE')
    ->where(DB::raw("(DATE_FORMAT(emp_mst.retirement_date,'%Y-%m-%d'))"), ">=", $cfrom_date)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.retirement_date,'%Y-%m-%d'))"), "<=", $cto_date)
    ->get();
  } else if($cfrom_date!=="" && $cto_date!=="" && $active_type!=="all"){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('category','emp_mst.catg','=','category.category_code')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('category.category_name','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.retirement_date','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
    ->where('emp_mst.emp_type','=','PE')
    ->where(DB::raw("(DATE_FORMAT(emp_mst.retirement_date,'%Y-%m-%d'))"), ">=", $cfrom_date)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.retirement_date,'%Y-%m-%d'))"), "<=", $cto_date)
    ->where('emp_mst.active_type','=',$active_type)
    ->get();
  } else {
    $employee_list = DB::table('emp_mst')
    ->leftJoin('category','emp_mst.catg','=','category.category_code')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('category.category_name','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','emp_mst.retirement_date','emp_mst.DOB','emp_mst.employee_code','emp_mst.active_type')
    ->where('emp_mst.emp_type','=','PE')
    ->get();
  }
  $date = date('d-m-Y');
    if(isset($_GET['page'])){
      $page=$request->page;
      if($page==""){
        $employee_data=$employee_list;
        $serial = 0;
        $filename = "retired-employees-detail-report-all";    
      } else{
        $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
        $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
        $filename = "retired-employees-detail-report-$date-page-$page";
      }
    } else {
      $serial = 0;    
      $employee_data=$employee_list;  
      if(count($employee_data) <= 30){
        $filename = "retired-employees-detail-report-$date-page-1";
      } else {
        $filename = "retired-employees-detail-report-$date-all";
      }
    }   
      $send = [
        'slno'=>$serial+1,
        'employee_list'=>$employee_data
      ];
      ob_end_clean();
      ob_start();
      return Excel::download(new EmployeeRetirementDetailExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);
}


public function emp_official_dtl_report(Request $request)
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
        $category = $request->category;
      } else {
        $category ="";
      }
      if(isset($_GET['type'])){
        $type = $request->type;
      } else {
        $type ="";
      }
  if(isset($_GET['active_type'])){
        $active_type=$request->active_type;
    } else {
        $active_type= "all";
    }     
if($category=="" && $type=="" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','pay_grade_mst.pay_grade_code','emp_mst.UAN','emp_mst.esi_ac_no','emp_mst.pan_no','emp_mst.bank_ac_no','emp_mst.employee_code','emp_mst.active_type','emp_mst.DOB','emp_mst.confirm_date','emp_mst.retirement_date')
  ->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','pay_grade_mst.pay_grade_code','emp_mst.UAN','emp_mst.esi_ac_no','emp_mst.pan_no','emp_mst.bank_ac_no','emp_mst.employee_code','emp_mst.active_type','emp_mst.DOB','emp_mst.confirm_date','emp_mst.retirement_date')
  ->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','pay_grade_mst.pay_grade_code','emp_mst.UAN','emp_mst.esi_ac_no','emp_mst.pan_no','emp_mst.bank_ac_no','emp_mst.employee_code','emp_mst.active_type','emp_mst.DOB','emp_mst.confirm_date','emp_mst.retirement_date')
  ->where('emp_mst.catg','=',$category)
  ->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','pay_grade_mst.pay_grade_code','emp_mst.UAN','emp_mst.esi_ac_no','emp_mst.pan_no','emp_mst.bank_ac_no','emp_mst.employee_code','emp_mst.active_type','emp_mst.DOB','emp_mst.confirm_date','emp_mst.retirement_date')
  ->where('emp_mst.emp_type','=',$type)
  ->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','pay_grade_mst.pay_grade_code','emp_mst.UAN','emp_mst.esi_ac_no','emp_mst.pan_no','emp_mst.bank_ac_no','emp_mst.employee_code','emp_mst.active_type','emp_mst.DOB','emp_mst.confirm_date','emp_mst.retirement_date')
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','pay_grade_mst.pay_grade_code','emp_mst.UAN','emp_mst.esi_ac_no','emp_mst.pan_no','emp_mst.bank_ac_no','emp_mst.employee_code','emp_mst.active_type','emp_mst.DOB','emp_mst.confirm_date','emp_mst.retirement_date')
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else if($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','pay_grade_mst.pay_grade_code','emp_mst.UAN','emp_mst.esi_ac_no','emp_mst.pan_no','emp_mst.bank_ac_no','emp_mst.employee_code','emp_mst.active_type','emp_mst.DOB','emp_mst.confirm_date','emp_mst.retirement_date')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','pay_grade_mst.pay_grade_code','emp_mst.UAN','emp_mst.esi_ac_no','emp_mst.pan_no','emp_mst.bank_ac_no','emp_mst.employee_code','emp_mst.active_type','emp_mst.DOB','emp_mst.confirm_date','emp_mst.retirement_date')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.emp_type','=',$type)
  ->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','pay_grade_mst.pay_grade_code','emp_mst.UAN','emp_mst.esi_ac_no','emp_mst.pan_no','emp_mst.bank_ac_no','emp_mst.employee_code','emp_mst.active_type','emp_mst.DOB','emp_mst.confirm_date','emp_mst.retirement_date')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else {
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('category.category_name','emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.DOJ','pay_grade_mst.pay_grade_code','emp_mst.UAN','emp_mst.esi_ac_no','emp_mst.pan_no','emp_mst.bank_ac_no','emp_mst.employee_code','emp_mst.active_type','emp_mst.DOB','emp_mst.confirm_date','emp_mst.retirement_date')
  ->get();
}

  $date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$employee_list;
      $serial = 0;
      $filename = "employee-official-information-details-report-all";    
    } else {
      $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employee-official-information-details-report-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$employee_list;  
    if(count($employee_data) <= 30){
      $filename = "employee-official-information-details-report-$date-page-1";
    } else {
      $filename = "employee-official-information-details-report-$date-all";
    }
  }   
    $send = [
        'slno'=>$serial+1,
        'categories'=>$get_categories,
        'employee_type'=>$employee_type,
        'employee_list'=>$employee_data
    ]; 
    ob_end_clean();
    ob_start();  
    return Excel::download(new EmployeeOfficialInformationExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);
}


public function emp_personal_dtl_report(Request $request)
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
        $category = $request->category;
      } else {
        $category ="";
      }
      if(isset($_GET['type'])){
        $type = $request->type;
      } else {
        $type ="";
      }
    if(isset($_GET['active_type'])){
        $active_type=$request->active_type;
    } else {
        $active_type= "all";
    }       
if($category=="" && $type=="" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.catg','=',$category)
  ->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.emp_type','=',$type)
  ->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else if($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.emp_type','=',$type)
  ->get();
} else {
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.sex','emp_mst.spouse_name','emp_mst.father_name','emp_mst.mother_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','emp_mst.email','emp_mst.blood_group','emp_mst.marital_status','emp_mst.employee_code','emp_mst.active_type')
  ->get();
}
   
  $date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$employee_list;
      $serial = 0;
      $filename = "employee-personal-information-details-report-all";    
    } else {
      $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employee-personal-information-details-report-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$employee_list;  
    if(count($employee_data) <= 30){
      $filename = "employee-personal-information-details-report-$date-page-1";
    } else {
      $filename = "employee-personal-information-details-report-$date-all";
    }
  }   
    $send = [
        'slno'=>$serial+1,
        'categories'=>$get_categories,
        'employee_type'=>$employee_type,
        'employee_list'=>$employee_data
    ]; 
    ob_end_clean();
    ob_start();  
    return Excel::download(new EmployeePersonalInformationExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);






}

public function emp_contract_renewal_report(Request $request)
  {
    $all_categories_data = DB::table('emp_mst')
    ->leftJoin('category','emp_mst.catg','=','category.category_code')
    ->select('emp_mst.catg')
    ->where('emp_mst.catg','!=',NULL)
    ->groupBy('emp_mst.catg')
    ->get();
    $get_categories = array();
    foreach($all_categories_data as $key => $val){
      $get_categories[] = DB::table('category')->where('category_code','=',$val->catg)->first();
    }
    if(isset($_GET['category'])){
      $category = $request->category;
    } else {
      $category =NULL;
    }
    if(isset($_GET['from_date'])){
      $from_date = $request->from_date;
    } else {
      $from_date = NULL;
    }
    if(isset($_GET['to_date'])){
      $to_date = $request->to_date;
    } else {
      $to_date = NULL;
    }
  if(isset($_GET['active_type'])){
      $active_type=$request->active_type;
  } else {
      $active_type= "all";
  } 
    if($category=="" && $from_date=="" && $to_date=="" && $active_type=="all"){
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_mst.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no')
      ->groupBy('emp_contract_dtl.emp_no')
      ->get(); 
    } elseif($category=="all_cat" &&  $active_type=="all" && $from_date!=="" && $to_date!=="") {
        $employee_list = DB::table('emp_contract_dtl')
        ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
        ->select('emp_mst.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no')
        ->groupBy('emp_contract_dtl.emp_no')
        ->where('emp_contract_dtl.cont_start_date', '>=', $from_date)
        ->where('emp_contract_dtl.cont_end_date', '<=', $to_date)
        ->get();
    } elseif($category!=="all_cat" &&  $active_type=="all" && $from_date!=="" && $to_date!=="") {
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_mst.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no')
      ->groupBy('emp_contract_dtl.emp_no')
      ->where('emp_contract_dtl.cont_start_date', '>=', $from_date)
      ->where('emp_contract_dtl.cont_end_date', '<=', $to_date)
      ->where('emp_mst.catg','=',$category)
      ->get();
    } elseif($category!=="all_cat" &&  $active_type!=="all" && $from_date!=="" && $to_date!=="") {
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_mst.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no')
      ->groupBy('emp_contract_dtl.emp_no')
      ->where('emp_contract_dtl.cont_start_date', '>=', $from_date)
      ->where('emp_contract_dtl.cont_end_date', '<=', $to_date)
      ->where('emp_mst.catg','=',$category)
      ->where('emp_mst.active_type','=',$active_type)
      ->get();
    } elseif($category=="all_cat" &&  $active_type!=="all" && $from_date!=="" && $to_date!=="") {
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_mst.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no')
      ->groupBy('emp_contract_dtl.emp_no')
      ->where('emp_contract_dtl.cont_start_date', '>=', $from_date)
      ->where('emp_contract_dtl.cont_end_date', '<=', $to_date)
      ->where('emp_mst.active_type','=',$active_type)
      ->get();
    } elseif($category=="all_cat" &&  $active_type!=="all" && $from_date==$to_date) {
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_mst.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no')
      ->groupBy('emp_contract_dtl.emp_no')
      ->where('emp_contract_dtl.cont_start_date','=', $from_date)
      ->where('emp_contract_dtl.cont_end_date','=', $to_date)
      ->where('emp_mst.active_type','=',$active_type)
      ->get();
    } elseif($category!=="all_cat" &&  $active_type=="all" && $from_date==$to_date) {
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_mst.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no')
      ->groupBy('emp_contract_dtl.emp_no')
      ->orWhere('emp_contract_dtl.cont_start_date','=', $from_date)
      ->orWhere('emp_contract_dtl.cont_end_date','=', $to_date)
      ->where('emp_mst.catg','=',$category)
      ->get();
    } elseif($category!=="all_cat" &&  $active_type!=="all" && $from_date==$to_date) {
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_mst.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no')
      ->groupBy('emp_contract_dtl.emp_no')
      ->where('emp_mst.catg','=',$category)
      ->where('emp_mst.active_type','=',$active_type)
      ->orWhere('emp_contract_dtl.cont_start_date','=', $from_date)
      ->orWhere('emp_contract_dtl.cont_end_date','=', $to_date)
      ->get();
    }elseif($category=="all_cat" &&  $active_type=="all" && $from_date==$to_date) {
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_mst.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no')
      ->groupBy('emp_contract_dtl.emp_no')
      ->orWhere('emp_contract_dtl.cont_start_date','=', $from_date)
      ->orWhere('emp_contract_dtl.cont_end_date','=', $to_date)
      ->get();
    } else {
      $employee_list = DB::table('emp_contract_dtl')
      ->leftJoin('emp_mst','emp_contract_dtl.emp_no','=','emp_mst.emp_no')
      ->select('emp_mst.emp_no','emp_mst.emp_type','emp_mst.employee_code','emp_mst.emp_name','emp_mst.active_type','emp_mst.DOJ','emp_mst.catg','emp_mst.desg_code','emp_mst.dept_no')
      ->groupBy('emp_contract_dtl.emp_no')
      ->get();
    }
    
    $date = date('d-m-Y');
    if(isset($_GET['page'])){
      $page=$request->page;
      if($page==""){
        $employee_data=$employee_list;
        $serial = 0;
        $filename = "employee-contract-renewal-details-report-all";    
      } else {
        $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
        $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
        $filename = "employee-contract-renewal-details-report-$date-page-$page";
      }
    } else {
      $serial = 0;    
      $employee_data=$employee_list;  
      if(count($employee_data) <= 30){
        $filename = "employee-contract-renewal-details-report-$date-page-1";
      } else {
        $filename = "employee-contract-renewal-details-report-$date-all";
      }
    }   
      $send = [
          'slno'=>$serial+1,
          'categories'=>$get_categories,
          'employee_list'=>$employee_data
      ]; 
      ob_end_clean();
      ob_start();  
      return Excel::download(new EmployeeContractRenewalExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);





  }  



  public function emp_data_dtl_report(Request $request)
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
      $category = $request->category;
    } else {
      $category = NULL;
    }
    if(isset($_GET['type'])){
      $type = $request->type;
    } else {
      $type = NULL;
    }
    if(isset($_GET['active_type'])){
      $active_type= $request->active_type;
  } else {
      $active_type= "all";
  } 
if($category=="" && $type=="" && $active_type=="all"){
$employee_list = DB::table('emp_mst')
->leftJoin('category','emp_mst.catg','=','category.category_code')
->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.emp_type','category.category_name','emp_mst.retirement_date','emp_mst.employee_code','emp_mst.active_type','emp_mst.confirm_date') 
 ->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type=="all"){
$employee_list = DB::table('emp_mst')
->leftJoin('category','emp_mst.catg','=','category.category_code')
->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.emp_type','category.category_name','emp_mst.retirement_date','emp_mst.employee_code','emp_mst.active_type','emp_mst.confirm_date')
 ->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type=="all"){
$employee_list = DB::table('emp_mst')
->leftJoin('category','emp_mst.catg','=','category.category_code')
->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.emp_type','category.category_name','emp_mst.retirement_date','emp_mst.employee_code','emp_mst.active_type','emp_mst.confirm_date')
->where('emp_mst.catg','=',$category)
 ->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type=="all"){
$employee_list = DB::table('emp_mst')
->leftJoin('category','emp_mst.catg','=','category.category_code')
->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.emp_type','category.category_name','emp_mst.retirement_date','emp_mst.employee_code','emp_mst.active_type','emp_mst.confirm_date')
->where('emp_mst.emp_type','=',$type)
 ->get();
} else if($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.emp_type','category.category_name','emp_mst.retirement_date','emp_mst.employee_code','emp_mst.active_type','emp_mst.confirm_date')
  ->where('emp_mst.active_type','=',$active_type)
   ->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.emp_type','category.category_name','emp_mst.retirement_date','emp_mst.employee_code','emp_mst.active_type','emp_mst.confirm_date')
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.active_type','=',$active_type)
   ->get();
} else if($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.emp_type','category.category_name','emp_mst.retirement_date','emp_mst.employee_code','emp_mst.active_type','emp_mst.confirm_date')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.emp_type','category.category_name','emp_mst.retirement_date','emp_mst.employee_code','emp_mst.active_type','emp_mst.confirm_date')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.emp_type','=',$type)
  ->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('category','emp_mst.catg','=','category.category_code')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.emp_type','category.category_name','emp_mst.retirement_date','emp_mst.employee_code','emp_mst.active_type','emp_mst.confirm_date')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else { 
$employee_list = DB::table('emp_mst')
->leftJoin('category','emp_mst.catg','=','category.category_code')
->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
->select('emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.PERM_ADDRESS1','emp_mst.PERM_ADDRESS2','emp_mst.PERM_ADDRESS3','emp_mst.ph_no','dept_master.dept_name','emp_mst.DOJ','emp_mst.DOB','emp_mst.emp_type','category.category_name','emp_mst.retirement_date','emp_mst.employee_code','emp_mst.active_type','emp_mst.confirm_date')
 ->get();
}

    $date = date('d-m-Y');
    if(isset($_GET['page'])){
      $page=$request->page;
      if($page==""){
        $employee_data=$employee_list;
        $serial = 0;
        $filename = "employee-master-data-report-all";    
      } else {
        $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
        $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
        $filename = "employee-master-data-report-$date-page-$page";
      }
    } else {
      $serial = 0;    
      $employee_data=$employee_list;  
      if(count($employee_data) <= 30){
        $filename = "employee-master-data-report-$date-page-1";
      } else {
        $filename = "employee-master-data-report-$date-all";
      }
    }   
      $send = [
          'slno'=>$serial+1,
          'categories'=>$get_categories,
          'employee_type'=>$employee_type,
          'employee_list'=>$employee_data
      ]; 
      ob_end_clean();
      ob_start();  
      return Excel::download(new EmployeeMasterDataReportExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);
  }





public function emp_qualification_experience_dtl_report(Request $request){
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
      $category = $request->category;
    } else {
      $category =NULL;
    }
    if(isset($_GET['type'])){
      $type = $request->type;
    } else {
      $type =NULL;
    }
  if(isset($_GET['active_type'])){
      $active_type= $request->active_type;
  } else {
      $active_type= "all";
  } 
    if($category=="" && $type=="" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.active_type')
    ->get();
    } else if($category=="all_cat" && $type=="all_type" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.active_type')
    ->get();
    } else if($category!=="all_cat" && $type=="all_type" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.active_type')
    ->where('emp_mst.emp_type','=',$type)
    ->where('emp_mst.catg','=',$category)
    ->get();
    } else if($category=="all_cat" && $type!=="all_type" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.active_type')
    ->where('emp_mst.emp_type','=',$type)
    ->get();
    } else if($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.active_type')
    ->where('emp_mst.active_type','=',$active_type)
    ->get();
    } else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.active_type')
    ->where('emp_mst.active_type','=',$active_type)
    ->where('emp_mst.emp_type','=',$type)
    ->get();
    } else if($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.active_type')
    ->where('emp_mst.catg','=',$category)
    ->where('emp_mst.active_type','=',$active_type)
    ->where('emp_mst.emp_type','=',$type)
    ->get();
    } else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.active_type')
    ->where('emp_mst.catg','=',$category)
    ->where('emp_mst.emp_type','=',$type)
    ->get();
    } else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.active_type')
    ->where('emp_mst.catg','=',$category)
    ->where('emp_mst.active_type','=',$active_type)
    ->get();
    }  else { 
      $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.active_type')
    ->where('emp_mst.emp_type','=',$type)
    ->where('emp_mst.catg','=',$category)
    ->get();
    }
 
   $date = date('d-m-Y');
   if(isset($_GET['page'])){
     $page=$request->page;
     if($page==""){
       $employee_data=$employee_list;
       $serial = 0;
       $filename = "employee-qualification-experience-details-all";    
     } else {
       $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
       $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
       $filename = "employee-qualification-experience-details-$date-page-$page";
     }
   } else {
     $serial = 0;    
     $employee_data=$employee_list;  
     if(count($employee_data) <= 30){
       $filename = "employee-qualification-experience-details-$date-page-1";
     } else {
       $filename = "employee-qualification-experience-details-$date-all";
     }
   }   
     $send = [
        'slno'=>$serial+1,
        'categories'=>$get_categories,
        'employee_type'=>$employee_type,
        'employee_list'=>$employee_data,
     ]; 
     ob_end_clean();
     ob_start();  
     return Excel::download(new EmployeeQualiExperienceExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);



  }



  public function emp_service_pay_dtl_report(Request $request){ 
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
      $category= $request->category;
      } else {
          $category= "";
      }
  if(isset($_GET['type'])){
          $type= $request->type;
      } else {
          $type= "";
      }
  if(isset($_GET['active_type'])){
          $active_type= $request->active_type;
      } else {
          $active_type= "all";
      }
  if(isset($_GET['to'])){
      $to= $request->to;
  } else {
      $to= "";
  }
  if(isset($_GET['from'])){
      $from = $request->from;
  } else {
      $from = "";
  }

  if($category=="" && $type=="" && $active_type=="all" && $from=="" && $to==""){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.employee_code','pay_grade_mst.pay_grade_code','emp_mst.DOB','emp_mst.DOJ','emp_mst.active_type','emp_mst.confirm_date','emp_mst.retirement_date')
    ->get();
  }elseif($category=="all_cat" && $type=="all_type" && $active_type=="all" && $from!=="" && $to!==""){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.employee_code','pay_grade_mst.pay_grade_code','emp_mst.DOB','emp_mst.DOJ','emp_mst.active_type','emp_mst.confirm_date','emp_mst.retirement_date')
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), ">=", $from)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), "<=", $to)
    ->get();
  }elseif($category!=="all_cat" && $type=="all_type" && $active_type=="all" && $from!=="" && $to!==""){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.employee_code','pay_grade_mst.pay_grade_code','emp_mst.DOB','emp_mst.DOJ','emp_mst.active_type','emp_mst.confirm_date','emp_mst.retirement_date')
    ->where('emp_mst.catg','=',$category)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), ">=", $from)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), "<=", $to)
    ->get();
  }elseif($category!=="all_cat" && $type!=="all_type" && $active_type=="all" && $from!=="" && $to!==""){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.employee_code','pay_grade_mst.pay_grade_code','emp_mst.DOB','emp_mst.DOJ','emp_mst.active_type','emp_mst.confirm_date','emp_mst.retirement_date')
    ->where('emp_mst.emp_type','=',$type)
    ->where('emp_mst.catg','=',$category)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), ">=", $from)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), "<=", $to)
    ->get();
  }elseif($category!=="all_cat" && $type!=="all_type" && $active_type!=="all" && $from!=="" && $to!==""){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.employee_code','pay_grade_mst.pay_grade_code','emp_mst.DOB','emp_mst.DOJ','emp_mst.active_type','emp_mst.confirm_date','emp_mst.retirement_date')
    ->where('emp_mst.emp_type','=',$type)
    ->where('emp_mst.catg','=',$category)
    ->where('emp_mst.active_type','=',$active_type)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), ">=", $from)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), "<=", $to)
    ->get();
  }elseif($category=="all_cat" && $type!=="all_type" && $active_type!=="all" && $from!=="" && $to!==""){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.employee_code','pay_grade_mst.pay_grade_code','emp_mst.DOB','emp_mst.DOJ','emp_mst.active_type','emp_mst.confirm_date','emp_mst.retirement_date')
    ->where('emp_mst.emp_type','=',$type)
    ->where('emp_mst.active_type','=',$active_type)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), ">=", $from)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), "<=", $to)
    ->get();
  }elseif($category=="all_cat" && $type=="all_type" && $active_type!=="all" && $from!=="" && $to!==""){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.employee_code','pay_grade_mst.pay_grade_code','emp_mst.DOB','emp_mst.DOJ','emp_mst.active_type','emp_mst.confirm_date','emp_mst.retirement_date')
    ->where('emp_mst.active_type','=',$active_type)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), ">=", $from)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), "<=", $to)
    ->get();
  }elseif($category=="all_cat" && $type!=="all_type" && $active_type=="all" && $from!=="" && $to!==""){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.employee_code','pay_grade_mst.pay_grade_code','emp_mst.DOB','emp_mst.DOJ','emp_mst.active_type','emp_mst.confirm_date','emp_mst.retirement_date')
    ->where('emp_mst.emp_type','=',$type)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), ">=", $from)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), "<=", $to)
    ->get();
  }elseif($category!=="all_cat" && $type=="all_type" && $active_type!=="all" && $from!=="" && $to!==""){
    $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.employee_code','pay_grade_mst.pay_grade_code','emp_mst.DOB','emp_mst.DOJ','emp_mst.active_type','emp_mst.confirm_date','emp_mst.retirement_date')
    ->where('emp_mst.catg','=',$category)
    ->where('emp_mst.active_type','=',$active_type)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), ">=", $from)
    ->where(DB::raw("(DATE_FORMAT(emp_mst.DOJ,'%Y-%m-%d'))"), "<=", $to)
    ->get();
  }else{
    $employee_list = DB::table('emp_mst')
    ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
    ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
    ->leftJoin('pay_grade_mst','emp_mst.grade_code','=','pay_grade_mst.pay_grade_code')
    ->select('emp_mst.emp_type','emp_mst.emp_no','emp_mst.emp_name','desg_mst.desg_name','dept_master.dept_name','emp_mst.employee_code','pay_grade_mst.pay_grade_code','emp_mst.DOB','emp_mst.DOJ','emp_mst.active_type','emp_mst.confirm_date','emp_mst.retirement_date')
    ->get();
  }


$date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$employee_list;
      $serial = 0;
      $filename = "employee-yr-of-service-qualification-pay-grade-details-all";    
    } else {
      $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employee-yr-of-service-qualification-pay-grade-details-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$employee_list;  
    if(count($employee_data) <= 30){
      $filename = "employee-yr-of-service-qualification-pay-grade-details-$date-page-1";
    } else {
      $filename = "employee-yr-of-service-qualification-pay-grade-details-$date-all";
    }
  }   
    $send = [
        'slno'=>$serial+1,
        'categories'=>$get_categories,
        'employee_type'=>$employee_type,
        'employee_list'=>$employee_data
    ]; 
    ob_end_clean();
    ob_start();  
    return Excel::download(new EmployeeYearofServiceExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);
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


  if(isset($_GET['category'])){
    $category = $request->category;
  } else {
    $category =NULL;
  }

  if(isset($_GET['type'])){
    $type = $request->type;
  } else {
    $type =NULL;
  }

if(isset($_GET['active_type'])){
    $active_type=$request->active_type;
} else {
    $active_type= "all";
} 


$i=0;
  if($category=="" && $type=="" && $active_type=="all"){

    foreach ($employee_type as $ty) {
      foreach($get_categories as $val){
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow','pay_grade_code','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
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
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow','pay_grade_code','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
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
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow','pay_grade_code','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category);
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
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow','pay_grade_code','desg_code','dept_no')->where('emp_type', "=", $type)->where('catg', "=", $val->category_code);
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
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow','pay_grade_code','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code)->where('active_type','=',$active_type);
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
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow','pay_grade_code','desg_code','dept_no')->where('emp_type', "=", $type)->where('catg', "=", $val->category_code)->where('active_type','=',$active_type);
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

    $contract_list_A = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow','pay_grade_code','desg_code','dept_no')
    ->where('catg','=',$category)
    ->where('active_type','=',$active_type)
    ->where('emp_type','=',$type)->get();
      $data =  $contract_list_A;

  } else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
    $contract_list_A = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow','pay_grade_code','desg_code','dept_no')
    ->where('catg','=',$category)
    ->where('emp_type','=',$type)->get();
      $data =  $contract_list_A;

  } else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){

    foreach ($employee_type as $ty) {
      foreach($get_categories as $val){
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow','pay_grade_code','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $category)->where('active_type','=',$active_type);
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
        $query = DB::table('emp_mst')->select('id', 'emp_type', 'catg', 'employee_code','emp_name','basic_pay','pp1','pp2','emp_no','active_type','CONT_SAL','new_basic_pay','spl_allow','conv_allow','pay_grade_code','desg_code','dept_no')->where('emp_type', "=", $ty->emp_type)->where('catg', "=", $val->category_code);
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

  $date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$data;
      $serial = 0;
      $filename = "employees-basic-pay-pp1-pp2-allowance-report-all";    
    } else {
      $employee_data=ReportsControllerExcel::pager($data,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employees-basic-pay-pp1-pp2-allowance-report-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$data;  
    if(count($employee_data) <= 30){
      $filename = "employees-basic-pay-pp1-pp2-allowance-report-$date-page-1";
    } else {
      $filename = "employees-basic-pay-pp1-pp2-allowance-report-$date-all";
    }
  }   
    $send = [
        'slno'=>$serial+1,
        'categories'=>$get_categories,
        'employee_type'=>$employee_type,
        'employee_list'=>$employee_data,
    ]; 
    ob_end_clean();
    ob_start();
    return Excel::download(new EmployeeBasicePayppExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);
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
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_scale')
  ->get();
}elseif($category=="all_cat" && $type=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_scale')
  ->get();
}elseif($category!=="all_cat" && $type=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_scale')
  ->where('emp_mst.catg','=',$category)
  ->get();
}elseif($category=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_scale')
  ->where('emp_mst.emp_type','=',$type)
  ->get();
}elseif($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.catg','emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_scale')
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
}elseif($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_scale')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.emp_type','=',$type)
  ->get();
}elseif($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_scale')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.emp_type','=',$type)
  ->get();
}elseif($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_scale')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.emp_type','=',$type)
  ->get();
}elseif($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_scale')
  ->where('emp_mst.catg','=',$category)
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
}else{
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('bank_mst','emp_mst.bank_code','=','bank_mst.bank_code')
  ->leftJoin('pay_grade_mst','emp_mst.PAY_GRADE_CODE','=','pay_grade_mst.pay_grade_code')
  ->select('emp_mst.emp_no','emp_mst.emp_name','emp_mst.active_type','desg_mst.desg_name','emp_mst.present_address1','emp_mst.present_address2','emp_mst.present_address3','emp_mst.bank_ac_no','emp_mst.pan_no','bank_mst.bank_code','bank_mst.bank_name','bank_mst.ifsc_code','bank_mst.addrerss','pay_grade_mst.pay_scale')
  ->get();
}
  $date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$employee_list;
      $serial = 0;
      $filename = "employees-address-qualification-pan-account-remuneration-year-all";    
    } else {
      $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employees-address-qualification-pan-account-remuneration-year-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$employee_list;  
    if(count($employee_data) <= 30){
      $filename = "employees-address-qualification-pan-account-remuneration-year-$date-page-1";
    } else {
      $filename = "employees-address-qualification-pan-account-remuneration-year-$date-all";
    }
  }   
    $send = [
        'slno'=>$serial+1,
        'categories'=> $get_categories,
        'employee_type'=> $employee_type,
        'employee_list'=> $employee_data
    ]; 
    ob_end_clean();
    ob_start();  
    return Excel::download(new EmployeeQualiPanBankExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);

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
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->get();
    } elseif($category=="all_cat" && $type=="all_type" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->get();
    } elseif($category!=="all_cat" && $type=="all_type" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.catg','=',$category)
      ->get();
    }elseif($category=="all_cat" && $type!=="all_type" && $active_type=="all"){
       $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.emp_type','=',$type)
      ->get();
    }elseif($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.active_type','=',$active_type)
      ->get();
    }elseif($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.emp_type','=',$type)
      ->where('emp_mst.active_type','=',$active_type)
      ->get();
    }elseif($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.catg','=',$category)
      ->where('emp_mst.active_type','=',$active_type)
      ->where('emp_mst.emp_type','=',$type)
      ->get();
    }elseif($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.active_type','=',$active_type)
      ->where('emp_mst.emp_type','=',$type)
      ->get();
    }elseif($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.catg','=',$category)
      ->where('emp_mst.emp_type','=',$type)
      ->get();
    }elseif($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->where('emp_mst.catg','=',$category)
      ->where('emp_mst.active_type','=',$active_type)
      ->get();
    } else {
      $employee_list = DB::table('emp_mst')
      ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
      ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
      ->select('desg_mst.desg_name','emp_mst.emp_name','emp_mst.DOB','emp_mst.emp_no','emp_mst.active_type','emp_mst.new_basic_pay')
      ->get();
    }  
  $date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$employee_list;
      $serial = 0;
      $filename = "employee-life-insurance-scheme-all";    
    } else {
      $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employee-life-insurance-scheme-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$employee_list;  
    if(count($employee_data) <= 30){
      $filename = "employee-life-insurance-scheme-$date-page-1";
    } else {
      $filename = "employee-life-insurance-scheme-$date-all";
    }
  }   
    $send = [
        'slno'=>$serial+1,
        'categories'=> $get_categories,
        'employee_type'=>$employee_type,
       'employee_list'=>$employee_data,
    ]; 
    ob_end_clean();
    ob_start();
    return Excel::download(new EmployeeLifeInsuranceExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);
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
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->get();
} else if($category=="all_cat" && $type=="all_active" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->get();
} else if($category!=="all_cat" && $type=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.catg','=',$category)
  ->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.emp_type','=',$type)
  ->get();
}  else if($category=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.active_type','=',$active_type)
  ->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.emp_type','=',$type)
  ->get();
} else if($category!=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.catg','=',$category)
  ->get();
} else if($category=="all_cat" && $type!=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.emp_type','=',$type)
  ->get();
}else if($category!=="all_cat" && $type!=="all_type" && $active_type=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.emp_type','=',$type)
  ->where('emp_mst.catg','=',$category)
  ->get();
}else if($category!=="all_cat" && $type=="all_type" && $active_type!=="all"){
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->where('emp_mst.active_type','=',$active_type)
  ->where('emp_mst.catg','=',$category)
  ->get();
} else { 
  $employee_list = DB::table('emp_mst')
  ->leftJoin('desg_mst','emp_mst.desg_code','=','desg_mst.desg_code')
  ->leftJoin('dept_master','emp_mst.dept_no','=','dept_master.dept_no')
  ->leftJoin('pay_grade_mst','emp_mst.pay_grade_code','=','pay_grade_mst.pay_grade_code')
  ->select('desg_mst.desg_name','emp_mst.intial_basic','emp_mst.emp_name','dept_master.dept_name','emp_mst.DOB','emp_mst.DOJ','emp_mst.emp_no','emp_mst.active_type','emp_mst.spl_allow','emp_mst.new_basic_pay')
  ->get();
}
  

  $date = date('d-m-Y');
  if(isset($_GET['page'])){
    $page=$request->page;
    if($page==""){
      $employee_data=$employee_list;
      $serial = 0;
      $filename = "employee-qualification-experience-remuneration-all";    
    } else {
      $employee_data=ReportsControllerExcel::pager($employee_list,30,$page);  
      $serial=$employee_data->perPage() * ($employee_data->currentPage() - 1);
      $filename = "employee-qualification-experience-remuneration-$date-page-$page";
    }
  } else {
    $serial = 0;    
    $employee_data=$employee_list;  
    if(count($employee_data) <= 30){
      $filename = "employee-qualification-experience-remuneration-$date-page-1";
    } else {
      $filename = "employee-qualification-experience-remuneration-$date-all";
    }
  }   
    $send = [
        'slno'=>$serial+1,
        'categories'=> $get_categories,
        'employee_type'=> $employee_type,
        'employee_list'=> $employee_data
    ]; 
    ob_end_clean(); 
    ob_start();  
    return Excel::download(new EmployeeQualiExpeRemunerationExport($send),"$filename.xlsx",\Maatwebsite\Excel\Excel::XLSX);

}





}