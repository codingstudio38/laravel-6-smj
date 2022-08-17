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
class ExcelhealperFunction extends Controller
{

  public function GetType($var)
  {
    if($var==""){
      return "";
    } else{
      $data = DB::table('employee_type')->where('emp_type_code','=',$var)->first();
      return $data->employee_type_name;
    }
  }
  public function GetCategory($var)
  {
    if($var==""){
      return "";
    } else{
      $data = DB::table('category')->where('category_code','=',$var)->first();
      return $data->category_name;
    }
  }
  public function Getdesignation($var)
  {
    if($var==""){
      return "";
    } else{
      $data = DB::table('desg_mst')->where(['desg_code'=>$var])->first();
      return $data->desg_name;
    }
  }
  public function GetDepartment($var)
  {
    if($var==""){
      return "";
    } else{
      $data = DB::table('dept_master')->where(['dept_no'=>$var])->first();
      return $data->dept_name;
    }
  }
  public function GetModifydate($var){
    if($var==""){
      return "";
    } else{
      return date('d/m/Y', strtotime($var));
    }
  }

  public function GetActiveType($var)
  {
    if($var==""){
      return "";
    } else{
      if($var=="I"){
        return "Inactive";
      } else if($var=="A"){
        return "Active";
      } else{
        return "";
      }
    }
  }

  public function GetPaygrade($var)
  {
    if($var==""){
      return "";
    } else{
      if(DB::table('pay_grade_mst')->where(['pay_grade_code'=>$var])->count() > 0){
        $data = DB::table('pay_grade_mst')->where(['pay_grade_code'=>$var])->first();
        return $data->pay_grade_code;
      } else {
        return "";
      }
    }
  }
  
  public function GetContractEnddate($emp_no)
  {
    $check = DB::table('emp_contract_dtl')->where(['emp_no'=>$emp_no])->count();
    if($check > 0){
        $data = DB::table('emp_contract_dtl')->where(['emp_no'=>$emp_no])->orderBy('id','DESC')->first();
        if($data->cont_end_date==null){
          return "";
        } else {
          return date('d/m/Y', strtotime($data->cont_end_date));
        }
    } else {
        return "";
    }
  }

public function GetModifydateDaywise($var)
{
  if($var==""){
    return "";
  } else{
    return date('d-M', strtotime($var));
  }
}

public function GetContractDate($num,$type){
    $check = DB::table('emp_contract_dtl')->where(['emp_no'=>$num])->count();
    if($check > 0){
        $data = DB::table('emp_contract_dtl')->where(['emp_no'=>$num])->get();
        $store = array();
        $i=1;
        if($type=="START"){
          foreach($data as $key => $val){
            if($val->cont_start_date!==null){
              $store[]=$i."- ".date('d/m/Y', strtotime($val->cont_start_date)).", ";
              $i++;
            }
          }
          $send_store = implode(" ",$store);
        } else {
          foreach($data as $key => $val){
            if($val->cont_end_date!==null){
              $store[]=$i."- ".date('d/m/Y', strtotime($val->cont_end_date)).", ";
              $i++;
            }
          }
          $send_store = implode(" ",$store);
        }
        return $send_store;
    } else {
        return "";
    }
}
public function GetContractDetails($num,$type){
  $check = DB::table('emp_contract_dtl')->where(['emp_no'=>$num])->count();
  if($check > 0){
      $data = DB::table('emp_contract_dtl')->where(['emp_no'=>$num])->get();
      $store = array();
      $i=1;
      if($type=="SALARY"){
        foreach($data as $key => $val){
          if($val->sal!==null){
            $store[]=$i."- ".$val->sal.", ";
            $i++;
          }
        }
        $send_store = implode(" ",$store);
      }else if($type=="REMARK"){
        foreach($data as $key => $val){
          if($val->remarks!==null){
            $store[]=$i."- ".$val->remarks.", ";
            $i++;
          }
        }
        $send_store = implode(" ",$store);
      } else {
        $send_store = "";
      }
      return $send_store;
  } else {
      return "";
  }
}

public function GetDepend($num,$type){
  $check = DB::table('emp_dependent_dtl')->where(['emp_no'=>$num])->count();
  if($check > 0){
      $data = DB::table('emp_dependent_dtl')->where(['emp_no'=>$num])->get();
      $store = array();
      $i=1;
      if($type=="NAME"){
        foreach($data as $key => $val){
          if($val->depd_name!==null){
            $store[]=$i."- ".$val->depd_name.", ";
            $i++;
          }
        }
        $send_store = implode(" ",$store);
      } else {
        foreach($data as $key => $val){
            if($val->depd_dob!==null){
              $store[]=$i."- ".date('d/m/Y', strtotime($val->depd_dob)).", ";
              $i++;
            }
        }
        $send_store = implode(" ",$store);
      }
      return $send_store;
  } else {
      return "";
  }
}

public function GetQualification($num,$type){
  $check = DB::table('emp_qualification_dtl')->where(['emp_no'=>$num])->count();
  if($check > 0){
      $data = DB::table('emp_qualification_dtl')->where(['emp_no'=>$num])->get();
      $store = array();
      $i=1;
      if($type=="ACADEMIC"){
        foreach($data as $key => $val){
          if($val->qualification_type=="A"){
            if($val->emp_quali!==null){
              $store[]=$i."- ".$val->emp_quali.", ";
              $i++;
            }
          }
        }
        $send_store = implode(" ",$store);
      } else {
        foreach($data as $key => $val){
          if($val->qualification_type=="T"){
            if($val->emp_quali!==null){
              $store[]=$i."- ".$val->emp_quali.", ";
              $i++;
            }
          }
        }
        $send_store = implode(" ",$store);
      }
      return $send_store;
  } else {
      return "";
  }
}


public function counter($from, $to){
    if($to==""){
        return 0;
    } else if($from==""){
        return 0;
    } else {
        $date = Carbon::parse($from)->diff($to)->format('%yY');
        return $date;
    }
}
public function Emp_experience($num,$type){
  $check =  DB::table('emp_experience_dtl')->where(['emp_no'=>$num])->count(); 
  if($check > 0){
      $data = DB::table('emp_experience_dtl')->where(['emp_no'=>$num])->get();
      $store = array();
      $i=1;
      if($type=="SECTOR"){
        foreach($data as $key => $val){
          if($val->sector!==null){
            $store[]=$i."- ".$val->sector.", ";
            $i++;
          }
        }
        $send_store = implode(" ",$store);
      } elseif($type=="START"){
          foreach($data as $key => $val){
            if($val->start_date!==null){
              $store[]=$i."- ".date('d/m/Y', strtotime($val->start_date)).", ";
              $i++;
            }
          }
          $send_store = implode(" ",$store);
      } elseif($type=="END"){
        foreach($data as $key => $val){
          if($val->end_date!==null){
            $store[]=$i."- ".date('d/m/Y', strtotime($val->end_date)).", ";
            $i++;
          }
        }
        $send_store = implode(" ",$store);
      } elseif($type=="POSITION"){
        foreach($data as $key => $val){
          if($val->position!==null){
            $store[]=$i."- ".$val->position.", ";
            $i++;
          }
        }
        $send_store = implode(" ",$store);
      } elseif($type=="ORGANISATION"){
        foreach($data as $key => $val){
          if($val->orgn_name!==null){
            $store[]=$i."- ".$val->orgn_name.", ";
            $i++;
          }
        }
        $send_store = implode(" ",$store);
      } else {
        foreach($data as $key => $val){
          if($val->sector!==null){
            $store[]=$i."- ".$this->counter($val->start_date,$val->end_date).", ";
            $i++;
          } 
        }
        $send_store = implode(" ",$store);
      }
      return $send_store;
  } else {
      return "";
  }
}

public function Emp_probation($num,$type){
    $check = DB::table('emp_probation_dtl')->where(['emp_no'=>$num])->count();
    if($check > 0){
        $data = DB::table('emp_probation_dtl')->where(['emp_no'=>$num])->get();
        $store = array();
        $i=1;
        if($type=="START"){
          foreach($data as $key => $val){
            if($val->prob_start_date!==null){
              $store[]=$i."- ".date('d/m/Y', strtotime($val->prob_start_date)).", ";
              $i++;
            }
          }
          $send_store = implode(" ",$store);
        } else {
          foreach($data as $key => $val){
            if($val->prob_end_date!==null){
              $store[]=$i."- ".date('d/m/Y', strtotime($val->prob_end_date)).", ";
              $i++;
            }
          }
          $send_store = implode(" ",$store);
        }
        return $send_store;
    } else {
        return "";
    }
}
public function GetYearofService($from,$to){
  if($from==""){
      return "0";
  } else {
      if($to==""){
          $date = Carbon::parse(date('Y-m-d', strtotime($from)))->diff(Carbon::now())->format('%y.%m');
          return $date;
      } else {
          $date = Carbon::parse(date('Y-m-d', strtotime($from)))->diff(date('Y-m-d', strtotime($to)))->format('%y.%m');
          return $date;
      }
  }
}
public function GetRemark($num,$type){
  $store = array();
  $i=1;
  if($type=="REMARK"){
    $count2 = DB::table('emp_remark_dtl')->where(['emp_no'=>$num])->count();
        if($count2 > 0){
        $data = DB::table('emp_remark_dtl')->where(['emp_no'=>$num])->get();
        foreach($data as $key => $val){
          if($val->remark_text!==null){
            $store[]=$i."- ".$val->remark_text.", ";
            $i++;
          }
        }
          $send_store = implode(" ",$store);
        } else {
          $send_store = "";
        }
        return $send_store;
   } else {
      return "";
   }
 }


 public function GetQualificationFildWise($num,$type){
  $check = DB::table('emp_qualification_dtl')->where(['emp_no'=>$num])->count();
  if($check > 0){
      $data = DB::table('emp_qualification_dtl')->where(['emp_no'=>$num])->get();
      $academic = array();
      $tech = array();
      $i=1;
      $x=1;
      if($type=="institution"){
        foreach($data as $key => $val){
          if($val->qualification_type=="A"){
            if($val->institution!==null){
              $academic[]=$i."- ".$val->institution.", ";
              $i++;
            }
          } else {
            if($val->institution!==null){
              $tech[]=$x."- ".$val->institution.", ";
              $x++;
            }
          }
        } 
        $academic_im = implode(" ",$academic);
        $tech_im = implode(" ",$tech);
        $alldata = "Technical-> ".$tech_im." Academic-> ".$academic_im." ";
      } elseif($type=="year_passing"){
        foreach($data as $key => $val){
          if($val->qualification_type=="A"){
            if($val->year_passing!==null){
              $academic[]=$i."- ".$val->year_passing.", ";
              $i++;
            }
          } else { 
            if($val->year_passing!==null){
              $tech[]=$x."- ".$val->year_passing.", ";
              $x++;
            }
          }
        }
        $academic_im = implode(" ",$academic);
        $tech_im = implode(" ",$tech);
        $alldata = "Technical-> ".$tech_im." Academic-> ".$academic_im." ";
      }elseif($type=="mark_perc"){
        foreach($data as $key => $val){
          if($val->qualification_type=="A"){
            if($val->mark_perc!==null){
              $academic[]=$i."- ".$val->mark_perc."%, ";
              $i++;
            }
          } else {
            if($val->mark_perc!==null){
              $tech[]=$x."- ".$val->mark_perc."%, ";
              $x++;
            }
          }
        }
        $academic_im = implode(" ",$academic);
        $tech_im = implode(" ",$tech);
        $alldata = "Technical-> ".$tech_im." Academic-> ".$academic_im." ";
      } else {
        $alldata = "";
      }
      return $alldata;
  } else {
      return "";
  }
}

}