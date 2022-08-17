<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
class Employee_Master extends Model
{
    //
    protected $table = 'emp_mst';
    protected $fillable = ['emp_no','emp_name','emp_type','dept_no','desg_code',
    'DOB','DOJ','DOP','retirement_date','emp_type','active_type','inactive_reason','catg','wrok_place','image'];

  public static function Employee_Master_view()
    {
        $Employee_view = DB::table('emp_mst')
                        ->orderBy('id','DESC')
                        ->get();

        return $Employee_view;
  }

  public static function Employee_Master_Last_record_view()
    {
        $Employee_Last_record_view = DB::table('emp_mst')
                        ->orderBy('id','DESC')
                        ->limit(1)
                        ->first();
        $emp_no =  $Employee_Last_record_view->emp_no;            
        return $emp_no;
  }
  public static function Employee_Master_first_record_view()
    {
        $Employee_first_record_view = DB::table('emp_mst')->orderBy('id','ASC')->first();
        $empfirst_no =  $Employee_first_record_view->emp_no;            
        return $empfirst_no;
  }
    public static function Employee_Master_delete_record_view($request)
    {
      $empno = $request->input('search_emp');
      $Employee_id =DB::table('emp_mst')->where('emp_no',$empno)->first();
      $emp_id =  $Employee_id->id;  
      $emp_no =  $Employee_id->emp_no; 
      if(\File::exists(public_path('/image/'.$Employee_id->image))){
        \File::delete(public_path('/image/'.$Employee_id->image));
      }
      $empmst_official = DB::table('empmst_official')->where('emp_no',$emp_no)->delete(); 
      $dependent = DB::table('emp_dependent_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($dependent) > 0){
      foreach($dependent as $key => $val){
            if(\File::exists(public_path('/dependent/'.$val->upload_adhara))){
                \File::delete(public_path('/dependent/'.$val->upload_adhara));
            }
        }
      }
      $emp_dependent_dtl = DB::table('emp_dependent_dtl')->where('emp_no',$emp_no)->delete(); 
      $empnext_no = DB::table('emp_nominee_dtl')->where('emp_no',$emp_no)->delete();
      $qualification = DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($qualification) > 0){
      foreach($qualification as $key => $val){
            if(\File::exists(public_path('/qualification/'.$val->upload))){
                \File::delete(public_path('/qualification/'.$val->upload));
            }
        }
      }
      $emp_qualification_dtl = DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->delete();
      $experience = DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($experience) > 0){
      foreach($experience as $key => $val){
            if(\File::exists(public_path('/experience/'.$val->upload))){
                \File::delete(public_path('/experience/'.$val->upload));
            }
        }
      }
      $emp_experience_dtl = DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->delete();
      $trnasfer = DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($trnasfer) > 0){
      foreach($trnasfer as $key => $val){
            if(\File::exists(public_path('/transfer/'.$val->upload))){
                \File::delete(public_path('/transfer/'.$val->upload));
            }
        }
      } 
      $emp_trnasfer_dtl = DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->delete();
      $promotion = DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($promotion) > 0){
      foreach($promotion as $key => $val){
            if(\File::exists(public_path('/promotion/'.$val->upload))){
                \File::delete(public_path('/promotion/'.$val->upload));
            }
        }
      } 
      $employee_promotion_dtl = DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->delete();
      $probation = DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($probation) > 0){
      foreach($probation as $key => $val){
            if(\File::exists(public_path('/probation/'.$val->upload))){
                \File::delete(public_path('/probation/'.$val->upload));
            }
        }
      }    
      $emp_probation_dtl = DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->delete();
      $contract = DB::table('emp_contract_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($contract) > 0){
      foreach($contract as $key => $val){
            if(\File::exists(public_path('/contract/'.$val->upload))){
                \File::delete(public_path('/contract/'.$val->upload));
            }
        }
      }
      $emp_contract_dtl = DB::table('emp_contract_dtl')->where('emp_no',$emp_no)->delete();
      $antecedent = DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($antecedent) > 0){
      foreach($antecedent as $key => $val){
            if(\File::exists(public_path('/antecedent/'.$val->upload))){
                \File::delete(public_path('/antecedent/'.$val->upload));
            }
        }
      }
      $emp_antecedent_dtl = DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->delete();
      $revocation = DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($revocation) > 0){
      foreach($revocation as $key => $val){
            if(\File::exists(public_path('/revocation/'.$val->upload))){
                \File::delete(public_path('/revocation/'.$val->upload));
            }
        }
      }
      $emp_revocation_dtl = DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->delete(); 
      $achievement = DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($achievement) > 0){
      foreach($achievement as $key => $val){
            if(\File::exists(public_path('/achievement/'.$val->upload))){
                \File::delete(public_path('/achievement/'.$val->upload));
            }
        }
      }
      $emp_achievement_dtl = DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->delete();
      $reward = DB::table('emp_reward')->where('emp_no',$emp_no)->get(); 
      if(count($reward) > 0){
      foreach($reward as $key => $val){
            if(\File::exists(public_path('/reward/'.$val->upload))){
                \File::delete(public_path('/reward/'.$val->upload));
            }
        }
      }
      $emp_reward = DB::table('emp_reward')->where('emp_no',$emp_no)->delete(); 
      $appreciation = DB::table('emp_appreciation')->where('emp_no',$emp_no)->get(); 
      if(count($appreciation) > 0){
      foreach($appreciation as $key => $val){
            if(\File::exists(public_path('/appreciation/'.$val->upload))){
                \File::delete(public_path('/appreciation/'.$val->upload));
            }
        }
      }
      $emp_appreciation = DB::table('emp_appreciation')->where('emp_no',$emp_no)->delete(); 
      $remark = DB::table('emp_remark_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($remark) > 0){
      foreach($remark as $key => $val){
            if(\File::exists(public_path('/remark/'.$val->remark_attachment))){
                \File::delete(public_path('/remark/'.$val->remark_attachment));
            }
        }
      }
      $emp_remark_dtl = DB::table('emp_remark_dtl')->where('emp_no',$emp_no)->delete(); 
      $initiation = DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->get(); 
      if(count($initiation) > 0){
      foreach($initiation as $key => $val){
            if(\File::exists(public_path('/Initiative/'.$val->upload))){
                \File::delete(public_path('/Initiative/'.$val->upload));
            }
        }
      }
      $emp_initiation_dtl = DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->delete(); 
      $emp_mst = DB::table('emp_mst')->where('id',$emp_id)->delete();           
      return $emp_mst;
    }
    
    public static function Employee_Master_next_record_view($request)
    {
        $empno = $request->input('search_emp');
     
        $Employee_id =DB::table('emp_mst')
                                    ->select('id')
                                    ->where('emp_no',$empno)
                                    ->first();
        $id = $Employee_id->id;

       $empnext_no = DB::table('emp_mst')
                       ->where('id', '>', $id)
                       ->select('emp_no')
                       ->min('id');
      if($empnext_no>0)
       {
           $Empno_next =DB::table('emp_mst')
                            ->select('emp_no')                      
                            ->where('id',$empnext_no)
                            ->first();
           return $Empno_next->emp_no;
      }
       else
       {
            return $Empno_next="";
       }               
    }
    public static function Employee_Master_previous_record_view($request)
    {
        $empno = $request->input('search_emp');
     
        $Employee_id =DB::table('emp_mst')
                                    ->select('id')
                                    ->where('emp_no',$empno)
                                    ->first();
        $id = $Employee_id->id;
  //$previous = User::where('id', '<', $user->id)->max('id');
       $empnext_no = DB::table('emp_mst')
                       ->where('id', '<', $id)
                       ->select('emp_no')
                       ->max('id');
      if($empnext_no>0)
       {
           $Empno_next =DB::table('emp_mst')
                            ->select('emp_no')                      
                            ->where('id',$empnext_no)
                            ->first();
           return $Empno_next->emp_no;
      }
       else
       {
            return $Empno_next="";
       }               
    }
   


   public function getAllEmployeeInfo($employee_number) 
     {
 
      $employeeListing = DB::table('emp_mst')            
        ->where('emp_no',$employee_number)
        ->first();      
       //echo"<pre>";print_r($employeeListing );echo"</pre>";exit();

    return $employeeListing;
        }
    public function getAllEmployeeOfficialInfo($employee_number) 
     {
      // $OfficialListing= DB::table('emp_mst')
      //       ->select('id')            
      //       ->where('emp_no',$employee_number)
      //       ->first();
      //       $off_id = $OfficialListing->id;

      $official_user_info = DB::table('empmst_official')->where('emp_no',$employee_number)->first(); 
       // echo"<pre>";print_r($OfficialListing );echo"</pre>";exit();
      return $official_user_info;
        }
    public function getAllNomineeInfo($employee_number) 
     {
      $NomineeListing= DB::table('emp_mst')
            ->select('id')            
            ->where('emp_no',$employee_number)
            ->first();
      $nom_id = $NomineeListing->id;

      $Nominee_user_info = DB::table('emp_nominee_dtl')->where('emp_no',$nom_id)->first(); 
       // echo"<pre>";print_r($Nominee_user_info );echo"</pre>";exit();
      return $Nominee_user_info;
        }

   public function getDependentInfo($employee_number) 
      {
        $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
        $emp_no = $user->emp_no;
        $emp_id = $user->id;
        $check =  DB::table('emp_dependent_dtl')->where('emp_no',$emp_no)->count();
        if($check > 0){
          $slno_check =  DB::table('emp_dependent_dtl')->where('emp_no',$emp_no)->where('SL_NO','!=',"")->count();
          $date_check =  DB::table('emp_dependent_dtl')->where('emp_no',$emp_no)->where('depd_dob','!=',"")->count();
          if($slno_check == 0 && $date_check == 0){
            $dependent_user_info = DB::table('emp_dependent_dtl')->orderBy('id','DESC')->where('emp_no',$emp_no)->get();  
          } else {
            if($slno_check > 0 && $date_check > 0){
              $dependent_user_info = DB::table('emp_dependent_dtl')->orderBy('SL_NO','ASC')->where('emp_no',$emp_no)->get();  
            } else {
              if($slno_check > 0 ){
                $dependent_user_info = DB::table('emp_dependent_dtl')->orderBy('SL_NO','ASC')->where('emp_no',$emp_no)->get(); 
              } elseif($date_check > 0){ 
                $dependent_user_info = DB::table('emp_dependent_dtl')->orderBy('depd_dob','ASC')->where('emp_no',$emp_no)->get(); 
              }else{
                $dependent_user_info = DB::table('emp_dependent_dtl')->orderBy('id','DESC')->where('emp_no',$emp_no)->get();  
              }
            }
          }
        } else {
          $dependent_user_info = DB::table('emp_dependent_dtl')->orderBy('id','DESC')->where('emp_no',$emp_no)->get();  
        }
        return $dependent_user_info;
        }



      public function getAllQualificationInfo($employee_number) 
      {
        $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
        $emp_no = $user->emp_no;
        $emp_id = $user->id;
        $check =  DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->count();
        if($check > 0){
          $slno_check =  DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->where('SL_NO','!=',"")->count();
          $date_check =  DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->where('year_passing','!=',"")->count();
          if($slno_check == 0 && $date_check == 0){
            $Qualification_user_info = DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
          } else { 
            if($slno_check > 0 && $date_check > 0){
              $Qualification_user_info = DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->orderBy('SL_NO','ASC')->get(); 
            } else {
              if($slno_check > 0 ){
                $Qualification_user_info = DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->orderBy('SL_NO','ASC')->get();
              } elseif($date_check > 0){
                $Qualification_user_info = DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->orderBy('year_passing','ASC')->get();
              }else{
                $Qualification_user_info = DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
              }
            }
          }
        } else {
          $Qualification_user_info = DB::table('emp_qualification_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
        }  
      return $Qualification_user_info;
      }  

     public function getExperienceInfo($employee_number) 
      {
        $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
        $emp_no = $user->emp_no;
        $emp_id = $user->id;
        $check =  DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->count();
        if($check > 0){
          $slno_check =  DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->where('SL_NO','!=',"")->count();
          $date_check =  DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->where('start_date','!=',"")->count();
          if($slno_check == 0 && $date_check == 0){
            $Experience_user_info = DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
          } else {
            if($slno_check > 0 && $date_check > 0){
              $Experience_user_info = DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->orderBy('SL_NO','ASC')->get(); 
            } else {
              if($slno_check > 0 ){
                $Experience_user_info = DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->orderBy('SL_NO','ASC')->get();
              } elseif($date_check > 0){
                $Experience_user_info = DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->orderBy('start_date','ASC')->get();
              }else{
                $Experience_user_info = DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
              }
            }
          }
        } else {
          $Experience_user_info = DB::table('emp_experience_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
        }
      return $Experience_user_info;
      }

      public function getTransferInfo($employee_number) 
      {
        $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
        $emp_no = $user->emp_no;
        $emp_id = $user->id;
        $check =  DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->count();
        if($check > 0){
          $slno_check =  DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->where('SL_NO','!=',"")->count();
          $date_check =  DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->where('trans_date','!=',"")->count();
          if($slno_check == 0 && $date_check == 0){
            $Transfer_user_info = DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
          } else {
            if($slno_check > 0 && $date_check > 0){
              $Transfer_user_info = DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->orderBy('SL_NO','ASC')->get(); 
            } else {
              if($slno_check > 0 ){
                $Transfer_user_info = DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->orderBy('SL_NO','ASC')->get();
              } elseif($date_check > 0){
                $Transfer_user_info = DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->orderBy('trans_date','ASC')->get();
              }else{
                $Transfer_user_info = DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
              }
            }
          }
        } else {
          $Transfer_user_info = DB::table('emp_trnasfer_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
        }
      return $Transfer_user_info;
      }  

      public function getPromotionInfo($employee_number) 
      {
        $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
        $emp_no = $user->emp_no;
        $emp_id = $user->id;
        $check =  DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->count();
        if($check > 0){
          $slno_check =  DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->where('SL_NO','!=',"")->count();
          $date_check =  DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->where('promotion_date','!=',"")->count();
          if($slno_check == 0 && $date_check == 0){
            $Promotion_user_info = DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
          } else {
            if($slno_check > 0 && $date_check > 0){
              $Promotion_user_info = DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->orderBy('SL_NO','ASC')->get(); 
            } else {
              if($slno_check > 0 ){
                $Promotion_user_info = DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->orderBy('SL_NO','ASC')->get();
              } elseif($date_check > 0){
                $Promotion_user_info = DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->orderBy('promotion_date','ASC')->get();
              }else{
                $Promotion_user_info = DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
              }
            }
          }
        } else {
          $Promotion_user_info = DB::table('employee_promotion_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
        }
      return $Promotion_user_info;
      } 


    public function getProbationInfo($employee_number) 
    {
      $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
      $emp_no = $user->emp_no;
      $emp_id = $user->id;
      $check =  DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->count();
      if($check > 0){
        $slno_check =  DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->where('SL_NO','!=',"")->count();
        $date_check =  DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->where('prob_start_date','!=',"")->count();
        if($slno_check == 0 && $date_check == 0){
          $Probation_user_info = DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
        } else {
          if($slno_check > 0 && $date_check > 0){
            $Probation_user_info = DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->orderBy('SL_NO','ASC')->get(); 
          } else {
            if($slno_check > 0 ){
              $Probation_user_info = DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->orderBy('SL_NO','ASC')->get();
            } elseif($date_check > 0){
              $Probation_user_info = DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->orderBy('prob_start_date','ASC')->get();
            }else{
              $Probation_user_info = DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
            }
          }
        }
      } else {
        $Probation_user_info = DB::table('emp_probation_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get();  
      }
      return $Probation_user_info;
    } 

 

      public function getContractInfo($employee_number) 
      {
        $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
        $emp_no = $user->emp_no;
        $emp_id = $user->id;
        $check =  DB::table('emp_contract_dtl')->where('emp_no',$emp_no)->count();
        if($check > 0){
          $slno_check =  DB::table('emp_contract_dtl')->where('emp_no',$emp_no)->where('Sl_NO','!=',"")->count();
          $date_check =  DB::table('emp_contract_dtl')->where('emp_no',$emp_no)->where('cont_start_date','!=',"")->count();
          if($slno_check == 0 && $date_check == 0){
            $Contract_user_info = DB::table('emp_contract_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
          } else { 
            if($slno_check > 0 && $date_check > 0){
              $Contract_user_info = DB::table('emp_contract_dtl')->where('emp_no',$emp_no)->orderBy('Sl_NO','ASC')->get(); 
            } else {
              if($slno_check > 0 ){
                $Contract_user_info = DB::table('emp_contract_dtl')->where('emp_no',$emp_no)->orderBy('Sl_NO','ASC')->get();
              } elseif($date_check > 0) {
                $Contract_user_info = DB::table('emp_contract_dtl')->where('emp_no',$emp_no)->orderBy('cont_start_date','ASC')->get();
              } else {
                $Contract_user_info = DB::table('emp_contract_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
              }
            }
          }
        } else {
          $Contract_user_info = DB::table('emp_contract_dtl')->where('emp_no',$employee_number)->orderBy('id','DESC')->get();   
        } 
      return $Contract_user_info;
      } 


 
    public function getAntecedentInfo($employee_number) 
      {
      $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
      $emp_no = $user->emp_no;
      $emp_id = $user->id;
      $check =  DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->count();
      if($check > 0){
        $slno_check =  DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->where('slno','!=',"")->count();
        $date_check =  DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->where('order_date','!=',"")->count();
        if($slno_check == 0 && $date_check == 0){
          $Antecedent_user_info = DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
        } else {
          if($slno_check > 0 && $date_check > 0){
            $Antecedent_user_info = DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get(); 
          } else {
            if($slno_check > 0 ){
              $Antecedent_user_info = DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get();
            } elseif($date_check > 0){
              $Antecedent_user_info = DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->orderBy('order_date','ASC')->get();
            }else{
              $Antecedent_user_info = DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
            }
          }
        }
      } else {
        $Antecedent_user_info = DB::table('emp_antecedent_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
      } 
      return $Antecedent_user_info;
        } 


   public function getRevocationInfo($employee_number) 
      {
        $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
        $emp_no = $user->emp_no;
        $emp_id = $user->id;
        $check =  DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->count();
        if($check > 0){
          $slno_check =  DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->where('slno','!=',"")->count();
          $date_check =  DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->where('revocation_order_date','!=',"")->count();
          if($slno_check == 0 && $date_check == 0){
            $Revocation_user_info = DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
          } else {
            if($slno_check > 0 && $date_check > 0){
              $Revocation_user_info = DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get(); 
            } else {
              if($slno_check > 0 ){
                $Revocation_user_info = DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get();
              } elseif($date_check > 0){
                $Revocation_user_info = DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->orderBy('revocation_order_date','ASC')->get();
              }else{
                $Revocation_user_info = DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
              }
            }
          }
        } else {
          $Revocation_user_info = DB::table('emp_revocation_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
        } 
        return $Revocation_user_info;
        } 

    /**/
       public function getIntitionInfo($employee_number) 
      {
        $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
        $emp_no = $user->emp_no;
        $emp_id = $user->id;
        $check =  DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->count();
        if($check > 0){
          $slno_check =  DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->where('slno','!=',"")->count();
          $date_check =  DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->where('initiative_date','!=',"")->count();
          if($slno_check == 0 && $date_check == 0){
            $Intition_user_info = DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
          } else {
            if($slno_check > 0 && $date_check > 0){
              $Intition_user_info = DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get(); 
            } else {
              if($slno_check > 0 ){
                $Intition_user_info = DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get();
              } elseif($date_check > 0){
                $Intition_user_info = DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->orderBy('initiative_date','ASC')->get();
              }else{
                $Intition_user_info = DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
              }
            }
          }
        } else {
          $Intition_user_info = DB::table('emp_initiation_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get();  
        } 
      return $Intition_user_info;
        }

    public function getAchievementInfo($employee_number) 
      {
        $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
        $emp_no = $user->emp_no;
        $emp_id = $user->id;
        $check =  DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->count();
        if($check > 0){
          $slno_check =  DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->where('slno','!=',"")->count();
          $date_check =  DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->where('achievement_date','!=',"")->count();
          if($slno_check == 0 && $date_check == 0){
            $Achievement_user_info = DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
          } else {
            if($slno_check > 0 && $date_check > 0){
              $Achievement_user_info = DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get(); 
            } else {
              if($slno_check > 0 ){
                $Achievement_user_info = DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get();
              } elseif($date_check > 0){
                $Achievement_user_info = DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->orderBy('achievement_date','ASC')->get();
              }else{
                $Achievement_user_info = DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
              }
            }
          }
        } else {
          $Achievement_user_info = DB::table('emp_achievement_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get();   
        } 
      return $Achievement_user_info;
      }
      public function getappreciationInfo($employee_number) 
        { 
          $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
          $emp_no = $user->emp_no;
          $emp_id = $user->id;
          $check =  DB::table('emp_appreciation')->where('emp_no',$emp_no)->count();
          if($check > 0){
            $slno_check =  DB::table('emp_appreciation')->where('emp_no',$emp_no)->where('slno','!=',"")->count();
            $date_check =  DB::table('emp_appreciation')->where('emp_no',$emp_no)->where('order_date','!=',"")->count();
            if($slno_check == 0 && $date_check == 0){
              $appreciation_user_info = DB::table('emp_appreciation')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
            } else {
              if($slno_check > 0 && $date_check > 0){
                $appreciation_user_info = DB::table('emp_appreciation')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get(); 
              } else {
                if($slno_check > 0 ){
                  $appreciation_user_info = DB::table('emp_appreciation')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get();
                } elseif($date_check > 0){
                  $appreciation_user_info = DB::table('emp_appreciation')->where('emp_no',$emp_no)->orderBy('order_date','ASC')->get();
                }else{
                  $appreciation_user_info = DB::table('emp_appreciation')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
                }
              }
            }
          } else {
            $appreciation_user_info = DB::table('emp_appreciation')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
          } 
        return $appreciation_user_info;
        }

       public function getRewardInfo($employee_number) 
          {
            $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
            $emp_no = $user->emp_no;
            $emp_id = $user->id;
            $check =  DB::table('emp_reward')->where('emp_no',$emp_no)->count();
            if($check > 0){
              $slno_check =  DB::table('emp_reward')->where('emp_no',$emp_no)->where('slno','!=',"")->count();
              $date_check =  DB::table('emp_reward')->where('emp_no',$emp_no)->where('reorder_date','!=',"")->count();
              if($slno_check == 0 && $date_check == 0){
                $reward_user_info = DB::table('emp_reward')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
              } else {
                if($slno_check > 0 && $date_check > 0){
                  $reward_user_info = DB::table('emp_reward')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get(); 
                } else {
                  if($slno_check > 0 ){
                    $reward_user_info = DB::table('emp_reward')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get();
                  } elseif($date_check > 0){
                    $reward_user_info = DB::table('emp_reward')->where('emp_no',$emp_no)->orderBy('reorder_date','ASC')->get();
                  }else{
                    $reward_user_info = DB::table('emp_reward')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
                  }
                }
              }
            } else {
              $reward_user_info = DB::table('emp_reward')->where('emp_no',$emp_no)->orderBy('id','DESC')->get();  
            } 
           return $reward_user_info;
          }  

          public function getRemark($employee_number) 
          {
            $user = DB::table('emp_mst')->where('emp_no',$employee_number)->first();
            $emp_no = $user->emp_no;
            $emp_id = $user->id;
            $check =  DB::table('emp_remark_dtl')->where('emp_no',$emp_no)->count();
            if($check > 0){
              $slno_check =  DB::table('emp_remark_dtl')->where('emp_no',$emp_no)->where('slno','!=',"")->count();
              if($slno_check == 0 ){
                $remark_dtl = DB::table('emp_remark_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get(); 
              } else {
                $remark_dtl = DB::table('emp_remark_dtl')->where('emp_no',$emp_no)->orderBy('slno','ASC')->get(); 
              }
            } else {
              $remark_dtl = DB::table('emp_remark_dtl')->where('emp_no',$emp_no)->orderBy('id','DESC')->get();  
            } 
           return $remark_dtl;
          }

          













          
}
