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
use File;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        Cache::flush();
        return view('home');
    } 
/*Department Master detail(master page)*/
    public function Department_Master_view(Request $request)
       {
        $Department_view = DB::table('dept_master')
        ->orderby('id','desc')
        ->paginate(10);
    return view('Frontend.department-master', ['Department_view' => $Department_view ]);
       }
    public function employee_list(Request $request)
       { 
    $Employee_fetch = Employee_Master::Employee_Master_view();
    $pre_employee = Employee_Master::orderBy('id','DESC')->first();
    $next_employee = Employee_Master::orderBy('id','ASC')->first();     
    $Employee_fetch = Employee_Master::Employee_Master_view();
    return view('Frontend.employee-list', ['Employee_fetch' => $Employee_fetch,"pre_employee"=> $pre_employee,"next_employee"=> $next_employee,"Employee_fetch" =>$Employee_fetch]);
       }


    public function Add_Department(Request $request)
       {
         $Add_Department1 = new Department_master();
         $Add_Department_deptno = $request->dept_no;
         $Add_Department = $request->dept_name;
         $add_dept_zero = "0{$Add_Department_deptno}";
         $Add_Department1->dept_no = $add_dept_zero;
         $Add_Department1->dept_name =$Add_Department;
         $isExist = Department_master::select("*")
                        ->where("dept_name", $Add_Department)
                        ->exists();
                if ($isExist ) {
                return redirect()->back()->with('alert', 'the department is already exsits');
                        }
                        else
                        {
                           $Add_Department1->save();
                        }
         
         return redirect('/department-master');
       }

    public function Update_Department_Data(Request $request)
     {
         $dept_id = $request->dept_id;
         $dept_no= $request->dept_no; 
         $dept_name= $request->dept_name; 
         $dept_fetch =array(
                        'dept_no' => $dept_no,
                        'dept_name' => $dept_name
                            );
         $update_Data=DB::table('dept_master')
                      ->where('id',$dept_id)
                      ->update($dept_fetch); 
                      return redirect('/department-master');
     }
     public function Delete_Department_data($id)
    {
     $Department_data_all = Department_master::find($id);
     $Department_data_all->delete();
     return redirect('/department-master');
    }

  /*Designation detail(master page)*/
    public function Designation_Master_view(Request $request)
       {
       $Designation_view = DB::table('desg_mst')->orderby('id','desc')->paginate(10);
        return view('Frontend.designation-master',["Designation_view"=>$Designation_view]);
       }

    public function Add_Designation_Master(Request $request)
       {
          $Add_Designation = new Designation();
          $Add_Designation_code = $request->desg_code;
          $Add_Designation_name = $request->desg_name;
          $Add_Designation->desg_code =  $Add_Designation_code;
          $Add_Designation->desg_name =$Add_Designation_name;
          $isExist = Designation::select("*")->where("desg_name", $Add_Designation_name)->exists();
          if ($isExist ) {
          return redirect()->back()->with('alert', 'the designation is already exsits');
          } else {
            $Add_Designation->save();
          }
          return redirect('/designation-master');
       }
    public function Update_Designation_data(Request $request)
       {
         $desg_id = $request->desg_id;
         $desg_code = $request->desg_code;
         $desg_name= $request->desg_name; 
         $desg_fetch =array(
                        'desg_code' => $desg_code,
                        'desg_name' => $desg_name
                            );

         $update_Data=DB::table('desg_mst')
                      ->where('id',  $desg_id)
                      ->update($desg_fetch); 
                      return redirect('/designation-master');

        }
        
      public function Delete_Designation_data($id)
          {
           $Designation_data_all = Designation::find($id);
           $Designation_data_all->delete();
           return redirect('/designation-master');
          }




  /*Board/university detail(master page)*/

  public function Board_view(Request $request)
  {
  $Board_view = DB::table('board')->paginate(10);

   return view('Frontend.board-university',["Board_view"=>$Board_view]);
  }

    public function AddBoard(Request $request)
       {
         $AddBoard = new Board();
         $AddBoardName = $request->board_name;
         $AddBoard->board_name =  $AddBoardName;
         $isExist = Board::select("*")
                        ->where("board_name", $AddBoardName)
                        ->exists();
                if ($isExist ) {
                return redirect()->back()->with('alert', 'the Board/University is already exsits');
                        }
                        else
                        {
                          $AddBoard->save();
                        }
        
         return redirect('/board-university');
       }

    public function Update_Board_data(Request $request)
    {

         $board_id = $request->board_id;
         $board_name= $request->board_name; 
         $board_fetch =array(
                        'board_name' => $board_name,
                            );

         $update_Data=DB::table('board')
                      ->where('id',  $board_id)
                      ->update($board_fetch); 
                      return redirect('/board-university');

    }
    
    public function Delete_Board_data($id)
    {
     $Board_data_all = Board::find($id);
     $Board_data_all->delete();
     return redirect('/board-university');
    }

/*Workplace detail(master page)*/

    public function Work_place_view(Request $request)
       {
        $workplace_master_view = DB::table('workplace')->orderby('id','desc')->paginate(10);
        return view('Frontend.workplace',["workplace_master_view"=>$workplace_master_view]);
       }

    public function AddWorkplace(Request $request)
       {
         $Workplace = new Workplace();
         $Workplace_name  = $request->workplace_name;
         $Workplace->workplace_name =  $Workplace_name;
         $isExist = Workplace::select("*")
                        ->where("workplace_name", $Workplace_name)
                        ->exists();
                if ($isExist )
                 {
                return redirect()->back()->with('alert', 'the workplace is already exsits');
                        }
                        else
                        {
                              $Workplace->save();
                        }
        
   
         return redirect('/workplace');
       }

    public function Update_WorkPlace_data(Request $request)
    {

         $work_id = $request->work_id;
         $workplace_name= $request->workplace_name; 
         $workplace_fetch =array(
                        'workplace_name' => $workplace_name,
                            );

         $update_Data=DB::table('workplace')
                      ->where('id',  $work_id)
                      ->update($workplace_fetch); 
                      return redirect('/workplace');

    }
    public function Delete_WorkPlace_data($id)
      {
       $workplace_data_all = Workplace::find($id);
       $workplace_data_all->delete();
       return redirect('/workplace');
      }

  /*Paygrade detail(master page)*/
    public function Paygrade_view(Request $request)
       {
        $Paygrade_view = DB::table('pay_grade_mst')->orderby('id','desc')->paginate(10);
        return view('Frontend.pay-grade-master',["Paygrade_view"=>$Paygrade_view]);
       }
     public function AddPaygrade(Request $request)
       {
         $Paygrade = new Pay_grade_master();
         $grade_code  = $request->grade_code;
         $pay_grade_desc  = $request->pay_grade_desc;
         $pay_scale  = $request->pay_scale;
         $special_allowance  = $request->special_allowance;
         $other_special_allowance  = $request->other_special_allowance;
         $Paygrade->pay_grade_code =  $grade_code;
         $Paygrade->pay_grade_desc =  $pay_grade_desc;
         $Paygrade->pay_scale =  $pay_scale;
         $Paygrade->special_allowance =  $special_allowance;
         $Paygrade->other_special_allowance =  $other_special_allowance;
         $Paygrade->save();
         return redirect('/pay-grade-master');
       }
      public function Update_Paygrade_Data(Request $request)
       {
         $Paygrade_id = $request->scale_id;
         $gradecode = $request->grade_code;
         $description= $request->description; 
         $payscale_detail= $request->pay_scale; 
         $special_allowance  = $request->special_allowance;
         $other_special_allowance  = $request->other_special_allowance;
         $Paygrade_fetch =array(
                        'pay_grade_code' => $gradecode,
                        'pay_grade_desc' => $description,
                        'pay_scale' => $payscale_detail,
                        'special_allowance' =>  $special_allowance ,
                        'other_special_allowance'=>$other_special_allowance
                            );

         $update_Data=DB::table('pay_grade_mst')
                      ->where('id',  $Paygrade_id)
                      ->update($Paygrade_fetch); 
                      return redirect('/pay-grade-master');

        }
     public function Delete_Paygrade_data($id)
      {
       $Paygrade_data_all = Pay_grade_master::find($id);
       $Paygrade_data_all->delete();
       return redirect('/pay-grade-master');
      }
      public function fetch_paygrade_details($id)
      {
         $res = Pay_grade_master::find($id);
         echo "<pre>";
         print_r($res);
           echo "</pre>";
           exit();
         return $res;
      }

  /*Bank detail(master page)*/

    public function Bank_view(Request $request)
       {
        $Bank_view = DB::table('bank_mst')
                     ->orderby('id','desc')
                    ->paginate(10);
        return view('Frontend.bank',["Bank_view"=>$Bank_view]);
       }
    public function AddBank(Request $request)
       {
         $Bank = new Bank();
         $bank_code  = $request->bank_code;
         $bank_name = $request->bank_name;
         $ifsc_code  = $request->ifsc_code;
         $bank_address  = $request->address;
         $Bank->bank_code =  $bank_code;
         $Bank->bank_name =  $bank_name;
         $Bank->ifsc_code =  $ifsc_code;
         $Bank->addrerss =  $bank_address;
         $Bank->save();
         return redirect('/bank');
       }
      public function Update_Bank_Data(Request $request)
       {
         $Bank_id = $request->bank_id;
         $Bankcode = $request->bank_code;
         $Bankname= $request->bank_name; 
         $Bank_ifsc= $request->bank_ifsc; 
         $Bank_address= $request->address; 
         $Bank_fetch =array(
                        'bank_code' => $Bankcode,
                        'bank_name' => $Bankname,
                        'ifsc_code' => $Bank_ifsc,
                        'addrerss' => $Bank_address,
                            );

         $update_Data=DB::table('bank_mst')
                      ->where('id',  $Bank_id)
                      ->update($Bank_fetch); 
                      return redirect('/bank');

        }
      public function Delete_Bank_data($id)
      {
       $Bank_data_all = Bank::find($id);
       $Bank_data_all->delete();
       return redirect('/bank');
      }

/*Employee Master Page*/

    public function Employee_view(Request $request)
       { 
        //$Employee_master_fetch = Employee_Master::Employee_Master_view();
        $Board_view = Board::Board_view();
        $Bank_view = Bank::all();
        $Employee_fetch = Employee_Master::Employee_Master_view();
        $Department_fetch = Department_master::all();
        $qualification_level_mst =Qual_lvl::all();
        $Designation_fetch = Designation::all();
        $Workplace_fetch = Workplace::all();
        $Category_fetch = Category::all();
        $pay_grade_view = Pay_grade_master::Pay_grade_Master_view();
        $Employee_type_fetch =Employee_type::all();
        $Board_University_fetch =Board::all();
        $antecendent_fetch = Antecedent::all(); 
        $qualification_view = Qualification::Qualification_view();
        $pre_employee = Employee_Master::orderBy('id','DESC')->first();
        $next_employee = Employee_Master::orderBy('id','ASC')->first();
        return view('Frontend.employee-master',["Employee_fetch" =>$Employee_fetch,"Department_fetch"=>$Department_fetch,"Designation"=>$Designation_fetch,"Workplace_fetch" => $Workplace_fetch,"Category_fetch"=> $Category_fetch,"Employee_type_fetch"=>$Employee_type_fetch,'pay_grade_view' => $pay_grade_view,"Board_University_fetch"=>$Board_University_fetch,"antecendent_fetch" => $antecendent_fetch, "Board_view"=> $Board_view,"qualification_view"=>$qualification_view,"qualification_level_mst"=>$qualification_level_mst,"Bank_view"=> $Bank_view,"pre_employee"=> $pre_employee,"next_employee"=> $next_employee]);
       }

       public function AddEmployeeMaster(Request $request)
       {
         $Employee_Master = new Employee_Master();
         $Employee_Master_Official = new emp_official();
         $Employee_Master_Nominee = new Nominee();
          $employee_number = Employee_Master::max('EMP_NO');
                if($employee_number == null){
                  $employee_number=1;
                }else{
                  $employee_number+=1;
                }
           $active_type= $Employee_Master->active_type = $request->type; 
           if ($request->hasFile('image')) 
                {
                    $image = $request->file('image');
                    $name = rand().time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/image/');
                    $image->move($destinationPath, $name);
                    $img = file_get_contents(public_path().'/image/'.$name);
                    //force_download($img, $img);
                    $im = imagecreatefromstring($img);
                    $width = imagesx($im);
                    $height = imagesy($im);
                    $newwidth1 = 200;
                    $newheight1 = 205;
                    $old_x          =   $width;
                    $old_y          =   $height;
                    if($old_x > $old_y)
                    {
                        $thumb_w    =   $newwidth1;
                        $thumb_h    =   $old_y*($newheight1/$old_x);
                    }

                    if($old_x < $old_y)
                    {
                        $thumb_w    =   $old_x*($newwidth1/$old_y);
                        $thumb_h    =   $newheight1;
                    }

                    if($old_x == $old_y)
                    {
                        $thumb_w    =   $newwidth1;
                        $thumb_h    =   $newheight1;
                    }

                    if($width<200 && $height>205)
                    {
                        $thumb_w    =   $old_x*($newwidth1/$old_y);
                        $thumb_h    =   $newheight1;

                    }

                    if($width>200 && $height<205)
                    {
                        $thumb_w    =   $newwidth1;
                        $thumb_h    =   $old_y*($newheight1/$old_x);
                    }

                    if($width<200 && $height<205)
                    {
                        $thumb_w    =   $width;
                        $thumb_h    =   $height;
                    }
                    $thumb1 = imagecreatetruecolor($thumb_w, $thumb_h);
                    imagecopyresized($thumb1, $im, 0, 0, 0, 0, $thumb_w, $thumb_h, $width, $height);
                    imagepng($thumb1,public_path().'/image/'.$name); //save image as jpg
                    imagedestroy($thumb1);
                } else {
                  $name=null;
                }
                
              $storenum = DB::table('employee_type')->select("*")->where("emp_type_code",  $request->emp_type)->first();
              if($request->emp_type==""){
               $store_by_number = 0;
              } else {
               $store_by_number = $storenum->store_by;
              }
              

             if($active_type=="I")
             {
              $emp_no   =   $employee_number;
              $Employee_Master->type_store_by  =  $store_by_number;
              $Employee_Master->image  =  $name;
              $Employee_Master->CONT_SAL  =  $request->CONT_SAL;
              $Employee_Master->emp_name = $request->emp_name;
              $Employee_Master->dept_no  = $request->department;
              $Employee_Master->desg_code  = $request->designation;      
              $Employee_Master->catg  = $request->category;
              $Employee_Master->work_place = $request->workplace;
              $Employee_Master->DOB  = $request->DOB?date('Y-m-d', strtotime($request->DOB)):null;
              $Employee_Master->DOJ  = $request->DOJ?date('Y-m-d', strtotime($request->DOJ)):null;
              $Employee_Master->DOP  = $request->DOP?date('Y-m-d', strtotime($request->DOP)):null;
              $Employee_Master->confirm_date  = $request->DOC?date('Y-m-d', strtotime($request->DOC)):null;
              $Employee_Master->retirement_date  = $request->retirement_date?date('Y-m-d', strtotime($request->retirement_date)):null;   
              $Employee_Master->employee_code  = $request->emp_code;
              $Employee_Master->emp_type = $request->emp_type;
              $Employee_Master->pf_ded = $request->optradio;
              $Employee_Master->esi_ded = $request->optradio1;
              $Employee_Master->PAY_GRADE_CODE = $request->pay_grade_code_hdn;
              $Employee_Master->pf_ac_no = $request->pf;
              $Employee_Master->vp_perc = $request->vpf;
              $Employee_Master->esi_ac_no = $request->esi;
              $Employee_Master->pan_no = $request->PAN;
              $Employee_Master->UAN = $request->uan;
              $Employee_Master->AADHAAR_NO = $request->adhar;
              $Employee_Master->sex = $request->sex;
              $Employee_Master->marital_status = $request->marital;
              $Employee_Master->blood_group = $request->blood;
              $Employee_Master->id_mark = $request->id;
              $Employee_Master->spouse_name = $request->spouse;
              $Employee_Master->father_name = $request->father;
              $Employee_Master->present_address1 = $request->line_11;
              $Employee_Master->present_address2 = $request->line_22;
              $Employee_Master->present_address3 = $request->line_33;
              $Employee_Master->PERM_ADDRESS1 = $request->per_line1;
              $Employee_Master->PERM_ADDRESS2 = $request->per_line2;
              $Employee_Master->PERM_ADDRESS3 = $request->per_line3;
              $Employee_Master->ph_no = $request->contactnumber;
              $Employee_Master->email = $request->email;
              $Employee_Master->mother_name = $request->mother;
              $Employee_Master->spouse_dob = $request->spouse_dob;
              $Employee_Master->father_dob = $request->father_dob;
              $Employee_Master->mother_dob = $request->mother_dob;
              $Employee_Master->reason_desc=$request->reason_desc;
              $Employee_Master->inactive_reason =$request->inactive_reason;
              $Employee_Master->inactive_date =$request->inactive_date;
              $Employee_Master->payment_mode =$request->payment_bank_mode;
              $Employee_Master->bank_ac_no = $request->account_num;
              $Employee_Master->bank_code = $request->bank_name;
              $Employee_Master->incr_amt = $request->incr_amount;
              $Employee_Master->incr_due_date=$request->incr_date;
              $Employee_Master->intial_special = $request->intial;
              $Employee_Master->spl_allow = $request->current;
              //$Employee_Master->current_special = $request->current;
              $Employee_Master->intial_other_special = $request->initial_other;
              $Employee_Master->current_other_special = $request->current_other;
              $Employee_Master->conv_allow = $request->current_other;
              $Employee_Master->intial_basic=$request->intial_basic;
              $Employee_Master->new_basic_pay=$request->current_basic;

              $Employee_Master->pp1=$request->pp1;
              $Employee_Master->pp2=$request->pp2;
              $Employee_Master->initial_pp1=$request->initial_pp1;
              $Employee_Master->initial_pp2=$request->initial_pp2;
              $isExist = Employee_Master::select("*")->where("emp_no",  $emp_no )->exists();
              if ($isExist ) {
               return redirect()->back()->with('alert', 'the employee number is already exsits');
              } else {
                $Employee_Master->emp_no = $emp_no ;
                $Employee_Master->save();
                $employee_id = $Employee_Master->id;
              }










 //dependent table add//
        $depend_snno=$request->depend_snno;
        $name_arr=$request->name;
        $relation_arr = $request->relation;
        $age_arr = $request->age;
        $dob_arr = $request->dob1;
        $dependent_type_arr = $request->dependent_type;
        $dependent_addr_arr = $request->dependent_addr;
        $adhar_num_arr = $request->num;
        //$files=$request->file('dependent_file');
       // print_r( $files);exit();
         $images=array();
            if($files=$request->file('dependent_file'))
            {  $ctr_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_filename =$emp_no.date('ymdhis').$ctr_img.'.'.$file_extenxion;
                    $file->move(public_path().'/dependent/',$new_filename );  
                    $images[$key]=$new_filename;
                    $ctr_img++;
                }
            }

            //print_r($images);exit;
            if(count($name_arr)>0)
            {

                foreach($name_arr as $ky=>$val)
                {
                    if($name_arr[$ky]!="")
                    {//echo $name_arr[$ky].'<br>';

                       $Employee_Master_Dependent = new Dependent();
                       $Employee_Master_Dependent->SL_NO=  $depend_snno[$ky]  ;
                       $Employee_Master_Dependent->emp_no=  $emp_no  ;
                       $Employee_Master_Dependent->depd_name= $name_arr[$ky];
                       $Employee_Master_Dependent->relationship=$relation_arr[$ky];
                       $Employee_Master_Dependent->age=$age_arr[$ky];
                       $Employee_Master_Dependent->depd_dob=$dob_arr[$ky];
                       $Employee_Master_Dependent->type=$dependent_type_arr[$ky];
                       $Employee_Master_Dependent->address=$dependent_addr_arr[$ky];
                       $Employee_Master_Dependent->DEPD_AADHAAR_NO=$adhar_num_arr[$ky];
                       //$count = count($data);
                       if (!empty($images[$ky])) {
                          $Employee_Master_Dependent->upload_adhara =  $images[$ky];
                       }
                       else
                       {
                         $Employee_Master_Dependent->upload_adhara = null;
                       }
                     
                      

                       $Employee_Master_Dependent->save(); 
                     // echo   $Employee_Master_Dependent->upload_adhara;
                      //exit();
                    }

                }
            }
//qualification table add//

            $academic_snno=$request->academic_snno;
            $quali_arr=$request->academic;
            $qualification_arr=$request->qualification;
            $stream_arr = $request->stream;
            $board_arr = $request->board_name_ajax1;
            $year_arr = $request->year;
            $per_mark_arr = $request->per_mark;
            $division_quali_arr = $request->division_qualification;
            $type_qual =$request->type_qual;
            $remark_quali_arr = $request->remark_qualification;
            $data_qual=array();
            if($files=$request->file('qualification_file'))
            {$ctr_qual_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_file_qual_name =$emp_no.date('ymdhis').$ctr_qual_img.'.'.$file_extenxion;
                    $file->move(public_path().'/qualification/', $new_file_qual_name);  
                    $data_qual[$key]=$new_file_qual_name;

                    $data_qual++;
                }
            }

             if(count($quali_arr)>0)
            {
                foreach($quali_arr as $ky=>$val)
                {
                    if($qualification_arr[$ky]!="")
                    {
                  $Employee_Master_Qualification = new Qualification();
                  $Employee_Master_Qualification->SL_NO =   $academic_snno[$ky];
                  $Employee_Master_Qualification->emp_no =   $emp_no;
                  $Employee_Master_Qualification->qualification_level_code = $quali_arr[$ky];
                  $Employee_Master_Qualification->emp_quali = $qualification_arr[$ky];
                  $Employee_Master_Qualification->stream_subject =$stream_arr[$ky];
                  $Employee_Master_Qualification->institution =$board_arr[$ky];
                  $Employee_Master_Qualification->year_passing =$year_arr[$ky];
                   $Employee_Master_Qualification->qualification_type =$type_qual[$ky];
                  $Employee_Master_Qualification->mark_perc =$per_mark_arr[$ky];
                  $Employee_Master_Qualification->division =$division_quali_arr[$ky]; 
                  $Employee_Master_Qualification->remark_qualification =$remark_quali_arr[$ky]; 
                  if (!empty($data_qual[$ky])) {
                         $Employee_Master_Qualification->upload  =  $data_qual[$ky];
                       }
                       else
                       {
                         $Employee_Master_Qualification->upload = null;
                       }
                  //$Employee_Master_Qualification->upload =$upload[$ky];  
                  $Employee_Master_Qualification->save(); 

                    }
                    

                }

             }
//experience table add//

            $experience_snno=$request->experience_snno;
            $org_arr=$request->orgn;
            $sector_arr = $request->sect;
            $position_arr = $request->pos;
            $start_date_arr = $request->from;
            $end_date_arr = $request->to;
            $reson_arr =$request->area;
            $remark_arr =$request->remark_area;
            $upload_pic=array();
            if($files=$request->file('e_file'))
            { $ctr_exper_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_exper_filename =$emp_no.date('ymdhis').$ctr_exper_img.'.'.$file_extenxion;
                    $file->move(public_path().'/experience/', $new_exper_filename);  
                    $upload_pic[$key]=$new_exper_filename;

                     $ctr_exper_img++;
                }
            }

            if(count($org_arr)>0)
            {
                foreach($org_arr as $ky=>$val)
                {
                    if($org_arr[$ky]!="")
                    {
                  $Employee_Master_Experience = new Experience();
                  
                  $Employee_Master_Experience->SL_NO = $experience_snno[$ky];
                  $Employee_Master_Experience->emp_no =   $emp_no;
                  $Employee_Master_Experience->orgn_name = $org_arr[$ky];
                  $Employee_Master_Experience->sector =$sector_arr[$ky];
                  $Employee_Master_Experience->position =$position_arr[$ky];
                  $Employee_Master_Experience->start_date =$start_date_arr[$ky];
                  $Employee_Master_Experience->end_date =$end_date_arr[$ky];
                  $Employee_Master_Experience->reason =$reson_arr[$ky]; 
                  $Employee_Master_Experience->remark_area =$remark_arr[$ky];  
                  if (!empty($upload_pic[$ky])) {
                     $Employee_Master_Experience->upload  =  $upload_pic[$ky];
                   }
                   else
                   {
                     $Employee_Master_Experience->upload = null;
                   }
                  //$Employee_Master_Experience->upload =$upload_pic[$ky];  

                  $Employee_Master_Experience->save(); 

                    }
                    

                }

             }

//transfer table add//

            $transfer_snno=$request->transfer_snno;
            $trans_order_arr=$request->trans_order;
            $type_arr = $request->order_type;
            $transfer_ord_date_arr = $request->transfer_ord_date;
            $from_date_arr = $request->from_date;
            $to_date_arr = $request->to_date;
            $from_dept_arr =$request->f_dept;
            $to_dept_arr = $request->t_dept;
            $from_work_arr = $request->from_work;
            $to_work_arr = $request->to_work;
            $reson_arr =$request->ord_rea;
            $reamrks_arr = $request->reamrks;
            $upload_transfer=array();
            if($files=$request->file('trans_file'))
            {$ctr_trans_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                     $new_trans_filename =$emp_no.date('ymdhis').$ctr_trans_img.'.'.$file_extenxion;
                    $file->move(public_path().'/transfer/', $new_trans_filename);  
                    $upload_transfer[$key]=$new_trans_filename;

                  $ctr_trans_img++;
                }
            }
            if(count($trans_order_arr)>0)
            {
                foreach($trans_order_arr as $ky=>$val)
                {
                    if($trans_order_arr[$ky]!="")
                    {
                  $Employee_Master_Transfer = new Transfer();
                  $Employee_Master_Transfer->SL_NO = $transfer_snno[$ky]; 
                  $Employee_Master_Transfer->emp_no =   $emp_no;
                  $Employee_Master_Transfer->tranfer_order_no = $trans_order_arr[$ky];
                  $Employee_Master_Transfer->type =$type_arr[$ky];
                  $Employee_Master_Transfer->trans_date =$transfer_ord_date_arr[$ky];
                  $Employee_Master_Transfer->from_date =$from_date_arr[$ky];
                  $Employee_Master_Transfer->to_date =$to_date_arr[$ky];
                  $Employee_Master_Transfer->from_dept =$from_dept_arr[$ky];  
                  $Employee_Master_Transfer->to_dept =$to_dept_arr[$ky];
                  $Employee_Master_Transfer->from_work =$from_work_arr[$ky];
                  $Employee_Master_Transfer->to_work =$to_work_arr[$ky];
                  $Employee_Master_Transfer->reason =$reson_arr[$ky];  
                  $Employee_Master_Transfer->remark =$reamrks_arr[$ky];
                     if (!empty($upload_transfer[$ky])) 
                     {
                       $Employee_Master_Transfer->upload  =  $upload_transfer[$ky];
                     }
                     else
                     {
                       $Employee_Master_Transfer->upload = null;
                     } 
                   $Employee_Master_Transfer->save(); 

                    }
                    

                }

             }
//promotion table
         //promotion table
         
            $promo_slno=$request->promo_slno;
            $promo_order_arr=$request->promo_order_no;
            $promo_date_arr = $request->promo_date;
            $effect_date_arr = $request->effect_date;
            $from_grade_arr = $request->from_grade;
            $from_design_arr = $request->from_design;
            $from_basic_arr =$request->from_basic;
            $from_special_arr = $request->from_special;
            $from_other_special_arr = $request->from_other_special;
            $other_allowance_arr = $request->from_special;
            $to_grade_arr =$request->to_grade;
            $to_portion_arr = $request->to_portion;
            $to_basic_arr = $request->to_basic;
            $total_allow_arr = $request->total_allow;
            $to_other_allow_arr = $request->to_other_allowance;
            $remark_arr =$request->remark;
            $upload_promotion=array();
            if($files=$request->file('upload_promo'))
            {$ctr_promo_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                     $new_promo_filename =$emp_no.date('ymdhis').$ctr_promo_img.'.'.$file_extenxion;
                    $file->move(public_path().'/promotion/', $new_promo_filename);  
                    $upload_promotion[$key]=$new_promo_filename;

                    $ctr_promo_img++;
                }
            }

            if(count($promo_order_arr)>0)
            {
                foreach($promo_order_arr as $ky=>$val)
                {
                    if($promo_order_arr[$ky]!="")
                    {
                  $Employee_Master_Promotion = new Promotion();
                  $Employee_Master_Promotion->SL_NO = $promo_slno[$ky]; 
                  $Employee_Master_Promotion->emp_no =   $emp_no;
                  $Employee_Master_Promotion->promotion_order_no = $promo_order_arr[$ky];
                  $Employee_Master_Promotion->promotion_date =$promo_date_arr[$ky];
                  $Employee_Master_Promotion->promotion_effect_date =$effect_date_arr[$ky];
                  $Employee_Master_Promotion->from_grade_code =$from_grade_arr[$ky];
                  $Employee_Master_Promotion->from_desg_code =$from_design_arr[$ky];
                  $Employee_Master_Promotion->from_basic_pay =$from_basic_arr[$ky];
                  $Employee_Master_Promotion->special_allownace =$from_special_arr[$ky];
            $Employee_Master_Promotion->other_special_allownace =$from_other_special_arr[$ky];
                  $Employee_Master_Promotion->to_grade_code =$to_grade_arr[$ky];  
                  $Employee_Master_Promotion->to_portion =$to_portion_arr[$ky];  
                  $Employee_Master_Promotion->to_basic_pay =$to_basic_arr[$ky];
                  $Employee_Master_Promotion->total_allowance =$total_allow_arr[$ky];
                  $Employee_Master_Promotion->other_allowance =$to_other_allow_arr[$ky];
                  $Employee_Master_Promotion->remark =$remark_arr[$ky];
                   if (!empty($upload_promotion[$ky])) 
                     {
                       $Employee_Master_Promotion->upload  =  $upload_promotion[$ky];
                     }
                     else
                     {
                       $Employee_Master_Promotion->upload = null;
                     } 
                  //$Employee_Master_Promotion->upload =$upload_promotion[$ky];  
  

                  $Employee_Master_Promotion->save(); 

                    }
                    

                }

             }
//probation table//
          //probation table//
          
            $prob_slno=$request->prob_slno;
            $prob_order_arr=$request->prob_order;
            $prob_start_date_arr = $request->prob_start;
            $prob_end_date_arr = $request->prob_end;
            $pay_grade_arr = $request->pay_grade1;
            $initial_basic_arr = $request->initial;
            $special_allowance_arr =$request->special_allowance;
            $other_allownace_arr = $request->other_allownace;
            $remark_prob_arr =$request->remark_prob;
            $upload_prob=array();
            if($files=$request->file('prob_upload'))
            {$ctr_prob_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_prob_filename =$emp_no.date('ymdhis').$ctr_prob_img.'.'.$file_extenxion;
                    $file->move(public_path().'/probation/', $new_prob_filename);  
                    $upload_prob[$key]=$new_prob_filename;
                    $ctr_prob_img++;
                }
            }

      
            if(count($prob_order_arr)>0)
            {
              foreach($prob_order_arr as $ky=>$val)
              {
                if($prob_order_arr[$ky]!="")
                {
                $Employee_Master_Probation = new Probation();
                $Employee_Master_Probation->SL_NO =  $prob_slno[$ky];
                $Employee_Master_Probation->emp_no =   $emp_no;
                $Employee_Master_Probation->prob_order_no = $prob_order_arr[$ky];
                $Employee_Master_Probation->prob_start_date =$prob_start_date_arr[$ky];
                $Employee_Master_Probation->prob_end_date =$prob_end_date_arr[$ky];
                $Employee_Master_Probation->pay_grade =$pay_grade_arr[$ky];
                $Employee_Master_Probation->intial_basic =$initial_basic_arr[$ky];
                $Employee_Master_Probation->special_allowance =$special_allowance_arr[$ky];
                $Employee_Master_Probation->other_allowance = $other_allownace_arr[$ky];
                $Employee_Master_Probation->remarks =$remark_prob_arr[$ky]; 
                  if (!empty($upload_prob[$ky])) 
                    {
                      $Employee_Master_Probation->upload  =  $upload_prob[$ky];
                    }
                    else
                    {
                      $Employee_Master_Probation->upload = null;
                    } 
                $Employee_Master_Probation->save(); 
                }
              }
            }
//contract table//
           //contract table//
           
            $cont_slno=$request->cont_slno;
            $contract_order_arr=$request->cont_order;
            $contract_start_date_arr = $request->cont_start_date;
            $contract_end_date_arr = $request->cont_end_date;
            $con_pay_arr = $request->con_pay;
            $special_arr = $request->special;
            $other_arr =$request->other;
            $remarks_cont_arr = $request->remarks;

            $upload_cont=array();
            if($files=$request->file('cont_file'))
            {$ctr_cont_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_cont_filename =$emp_no.date('ymdhis').$ctr_cont_img.'.'.$file_extenxion;
                    $file->move(public_path().'/contract/', $new_cont_filename);  
                    $upload_cont[$key]=$new_cont_filename;


                    $ctr_cont_img++;
                }
            }
          if(count($contract_order_arr)>0)
            {
                foreach($contract_order_arr as $ky=>$val)
                {
                    if($contract_order_arr[$ky]!="")
                    {
                  $Employee_Master_Contract = new Contract();
                  $Employee_Master_Contract->Sl_NO = $cont_slno[$ky];
                  $Employee_Master_Contract->emp_no =   $emp_no;
                  $Employee_Master_Contract->cont_order_no = $contract_order_arr[$ky];
                  $Employee_Master_Contract->cont_start_date =$contract_start_date_arr[$ky];
                  $Employee_Master_Contract->cont_end_date =$contract_end_date_arr[$ky];
                  $Employee_Master_Contract->sal =$con_pay_arr[$ky];
                  $Employee_Master_Contract->special_allowance =$special_arr[$ky];
                  $Employee_Master_Contract->other_allowance =$other_arr[$ky];
                  $Employee_Master_Contract->remarks =$remarks_cont_arr[$ky];  

                  if (!empty($upload_cont[$ky])) 
                     {
                       $Employee_Master_Contract->upload  =  $upload_cont[$ky];
                     }
                     else
                     {
                       $Employee_Master_Contract->upload = null;
                     } 
                
                  //$Employee_Master_Contract->upload =$upload_cont[$ky];  

                  $Employee_Master_Contract->save(); 

                    }
                    

                }

            }
//antecendent table//

            $antecedent_slno=$request->antecedent_slno;
            $antecedent_order_arr=$request->ante_order_no;
            $antecedent_order_date_arr = $request->ante_order_date;
            $antecedent_type_arr = $request->ante_type;
            $w_e_e_arr = $request->ante_w_e_e;
            $w_e_t_arr = $request->ante_w_e_t;
            $remarks_ante_arr = $request->ante_remarks;
            $upload_ante_arr=array();
            if($files=$request->file('antecedent_upload'))
            {$ante_ante_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_ante_filename =$emp_no.date('ymdhis').$ante_ante_img.'.'.$file_extenxion;
                    $file->move(public_path().'/antecedent/', $new_ante_filename);  
                    $upload_ante_arr[$key]=$new_ante_filename;


                    $ante_ante_img++;
                }
            }
          if(count($antecedent_order_arr)>0)
            {
                foreach($antecedent_order_arr as $ky=>$val)
                {
                    if($antecedent_order_arr[$ky]!="")
                    {
                  $Employee_Master_antecedent = new Antecedent();
                  $Employee_Master_antecedent->slno =  $antecedent_slno[$ky];
                  $Employee_Master_antecedent->emp_no =  $emp_no ;
                  $Employee_Master_antecedent->order_no = $antecedent_order_arr[$ky];
                  $Employee_Master_antecedent->order_date =$antecedent_order_date_arr[$ky];
                  $Employee_Master_antecedent->type =$antecedent_type_arr[$ky];
                  $Employee_Master_antecedent->WEE_date =$w_e_e_arr[$ky];
                  $Employee_Master_antecedent->WET_date =$w_e_t_arr[$ky];
                  $Employee_Master_antecedent->remarks =$remarks_ante_arr[$ky]; 
                   if (!empty($upload_ante_arr[$ky])) 
                     {
                       $Employee_Master_antecedent->upload  =  $upload_ante_arr[$ky];
                     }
                     else
                     {
                       $Employee_Master_antecedent->upload = null;
                     } 
                     $Employee_Master_antecedent->save(); 

                    }
                    

                }

            }
//Revocation table add// 
 
            $revo_slno=$request->revo_slno;
            $revocation_order_arr=$request->revo_order_no;
            $revocation_order_date_arr = $request->revo_order_date;
            $ant_ord_no_arr = $request->ant_ord_no;
            $ant_ord_dat_arr = $request->ant_ord_dat; 
            $ant_ord_type_arr = $request->ant_ord_type;
            $ant_WEF_arr = $request->ant_WEF;
            $ant_WET_arr = $request->ant_WET;
            $revo_effected_date_arr = $request->revo_effected_date;
            $revo_remark_arr = $request->revo_remark;
            $upload_revo_arr=array();
                if($files=$request->file('revocation_upload'))
                {$ante_revo_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_revo_filename =$emp_no.date('ymdhis').$ante_revo_img.'.'.$file_extenxion;
                        $file->move(public_path().'/revocation/', $new_revo_filename);  
                        $upload_revo_arr[$key]=$new_revo_filename;


                        $ante_revo_img++;
                    }
                }
             
          if(count($revocation_order_arr)>0)
            {
                foreach($revocation_order_arr as $ky=>$val)
                {
                    if($revocation_order_arr[$ky]!="")
                    {
                  $Employee_Master_revocation = new Revocation();
                  
          $Employee_Master_revocation->slno = $revo_slno[$ky];
          $Employee_Master_revocation->emp_no =   $emp_no ;
          $Employee_Master_revocation->revocation_order_no = $revocation_order_arr[$ky];
          $Employee_Master_revocation->revocation_order_date =$revocation_order_date_arr[$ky]; 
          $Employee_Master_revocation->antecedent_order_no =$ant_ord_no_arr[$ky];
          $Employee_Master_revocation->antecedent_order_date =$ant_ord_dat_arr[$ky];
          $Employee_Master_revocation->antecedent_type =$ant_ord_type_arr[$ky];
          $Employee_Master_revocation->antecedent_WEE_date =$ant_WEF_arr[$ky]; 
          $Employee_Master_revocation->antecedent_WET_date =$ant_WET_arr[$ky];
          $Employee_Master_revocation->revocation_effected_date =$revo_effected_date_arr[$ky];
          $Employee_Master_revocation->remarks =$revo_remark_arr[$ky]; 
            if (!empty($upload_revo_arr[$ky])) 
               {
                 $Employee_Master_revocation->upload  =  $upload_revo_arr[$ky];
               }
               else
               {
                 $Employee_Master_revocation->upload = null;
               } 
          $Employee_Master_revocation->save(); 

                    }
                    

                }

            }
//INTIATION table add//  

            $intiation_slno=$request->intiation_slno;
            $initiative_date_arr=$request->initiative_date;
            $inti_type_arr = $request->inti_type;
            $inti_description_arr = $request->inti_description;
            $inti_remark_arr = $request->inti_remark; 
           // $Initiative_upload_arr = $request->Initiative_upload;
           
            $upload_Initiative_arr=array();
                if($files=$request->file('Initiative_upload'))
                {$ante_inti_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_inti_filename =$emp_no.date('ymdhis').$ante_inti_img.'.'.$file_extenxion;
                        $file->move(public_path().'/Initiative/', $new_inti_filename);  
                        $upload_inti_arr[$key]=$new_inti_filename;


                        $ante_inti_img++;
                    }
                }
            
          if(count($initiative_date_arr)>0)
            {
                foreach($initiative_date_arr as $ky=>$val)
                {
                    if($initiative_date_arr[$ky]!="")
                    {
          $Employee_Master_initiative = new Intiation();
          $Employee_Master_initiative->slno = $intiation_slno[$ky];             
          $Employee_Master_initiative->emp_no =    $emp_no ;
          $Employee_Master_initiative->initiative_date = $initiative_date_arr[$ky];
          $Employee_Master_initiative->type =$inti_type_arr[$ky]; 
          $Employee_Master_initiative->description =$inti_description_arr[$ky];
          $Employee_Master_initiative->remark =$inti_remark_arr[$ky];
         
            if (!empty($upload_inti_arr[$ky])) 
               {
                 $Employee_Master_initiative->upload  =  $upload_inti_arr[$ky];
               }
               else
               {
                 $Employee_Master_initiative->upload = null;
               } 
          $Employee_Master_initiative->save(); 

                    }
                    

                }

            } 
//achievement table add//  

            $achievement_slno=$request->achievement_slno;
            $achievement_date_arr=$request->achievement_date;
            $achievement_type_arr = $request->achievement_type;
            $achievement_description_arr = $request->achievement_period;
            $achievement_remark_arr = $request->achievement_remark; 
           // $Initiative_upload_arr = $request->Initiative_upload;
           
            $upload_achievement_arr=array();
                if($files=$request->file('achievement_upload'))
                {$ante_achi_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_achi_filename =$emp_no.date('ymdhis').$ante_achi_img.'.'.$file_extenxion;
                        $file->move(public_path().'/achievement/', $new_achi_filename);  
                        $upload_achi_arr[$key]=$new_achi_filename;


                        $ante_achi_img++;
                    }
                }
            
          if(count($achievement_date_arr)>0)
            {
                foreach($achievement_date_arr as $ky=>$val)
                {
                    if($achievement_date_arr[$ky]!="")
                    {
          $Employee_Master_Achievement = new Achievement();
          $Employee_Master_Achievement->slno = $achievement_slno[$ky];         
          $Employee_Master_Achievement->emp_no =    $emp_no ;
          $Employee_Master_Achievement->achievement_date = $achievement_date_arr[$ky];
          $Employee_Master_Achievement->achievement_type =$achievement_type_arr[$ky]; 
          $Employee_Master_Achievement->achievement_period =$achievement_description_arr[$ky];
          $Employee_Master_Achievement->remark =$achievement_remark_arr[$ky];
            if (!empty($upload_achi_arr[$ky])) 
               {
                 $Employee_Master_Achievement->upload  =  $upload_achi_arr[$ky];
               }
               else
               {
                 $Employee_Master_Achievement->upload = null;
               } 
          $Employee_Master_Achievement->save(); 
                    }
                }
            }
            //appreciation add
            
            $app_slno=$request->app_slno;
            $appreciation_order_arr=$request->app_order_no;
            $appreciation_order_date_arr = $request->app_order_date;
            $appreciationtype_arr = $request->appreciation_type;
            $apprecommended_arr = $request->recommended_by; 
            $appdescription_arr = $request->app_description;
            $appremark_arr = $request->app_remarks;
            $upload_revo_arr=array();
                if($files=$request->file('appriciation_upload'))
                {$ante_revo_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_revo_filename =$emp_no.date('ymdhis').$ante_revo_img.'.'.$file_extenxion;
                        $file->move(public_path().'/appreciation/', $new_revo_filename);  
                        $upload_revo_arr[$key]=$new_revo_filename;
                        $ante_revo_img++;
                    }
                }
                if(count($appreciation_order_arr)>0)
                {
                    foreach($appreciation_order_arr as $ky=>$val)
                    {
                        if($appreciation_order_arr[$ky]!="")
                        {
                      $Employee_Master_app = new Appriciation();
              $Employee_Master_app->slno = $app_slno[$ky];      
              $Employee_Master_app->emp_no =    $emp_no ;
              $Employee_Master_app->order_no = $appreciation_order_arr[$ky];
              $Employee_Master_app->order_date =$appreciation_order_date_arr[$ky]; 
              $Employee_Master_app->appreciation_type =$appreciationtype_arr[$ky];
              $Employee_Master_app->recommended_by =$apprecommended_arr[$ky];
              $Employee_Master_app->app_description =$appdescription_arr[$ky];
              $Employee_Master_app->app_remarks =$appremark_arr[$ky]; 
                if (!empty($upload_revo_arr[$ky])) 
                   {
                     $Employee_Master_app->upload  =  $upload_revo_arr[$ky];
                   }
                   else
                   {
                     $Employee_Master_app->upload = null;
                   } 
               $Employee_Master_app->save(); 
    
                        }
                        
    
                    }
    
                }


               //// reward
               
            $reward_slno=$request->reward_slno;
            $appreciation_order_arr1=$request->reorder_no;
            $appreciation_order_date_arr1 = $request->reorder_date;
            $appreciationtype_arr1 = $request->reward_type;
            $apprecommended_arr1 = $request->re_recommended_by; 
            $appdescription_arr1 = $request->re_description;
            $appremark_arr1 = $request->re_remarks;
            $upload_revo_arr1=array();
                if($files=$request->file('remark_upload'))
                {$ante_revo_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_revo_filename =$emp_no.date('ymdhis').$ante_revo_img.'.'.$file_extenxion;
                        $file->move(public_path().'/reward/', $new_revo_filename);  
                        $upload_revo_arr1[$key]=$new_revo_filename;


                        $ante_revo_img++;
                    }
                }
                if(count($appreciation_order_arr1)>0)
                {
                    foreach($appreciation_order_arr1 as $ky=>$val)
                    {
                        if($appreciation_order_arr1[$ky]!="")
                        {
                      $Employee_Master_reward = new Reward();
              $Employee_Master_reward->slno = $reward_slno[$ky];             
              $Employee_Master_reward->emp_no =    $employee_id ;
              $Employee_Master_reward->reorder_no = $appreciation_order_arr1[$ky];
              $Employee_Master_reward->reorder_date =$appreciation_order_date_arr1[$ky]; 
              $Employee_Master_reward->reward_type =$appreciationtype_arr1[$ky];
              $Employee_Master_reward->re_recommended_by =$apprecommended_arr1[$ky];
              $Employee_Master_reward->re_description =$appdescription_arr1[$ky];
              $Employee_Master_reward->re_remarks =$appremark_arr1[$ky]; 
                if (!empty($upload_revo_arr1[$ky])) 
                   {
                     $Employee_Master_reward->upload  =  $upload_revo_arr1[$ky];
                   }
                   else
                   {
                     $Employee_Master_reward->upload = null;
                   } 
               $Employee_Master_reward->save(); 
    
                        }
                        
    
                    }
    
                }                       
        }
        else 
        {
              $emp_no = $employee_number;
              $Employee_Master->type_store_by  =  $store_by_number;
              $Employee_Master->image  =  $name;
              $Employee_Master->CONT_SAL  =  $request->CONT_SAL;
              $Employee_Master->emp_name = $request->emp_name;
              $Employee_Master->dept_no  = $request->department;
              $Employee_Master->desg_code  = $request->designation;      
              $Employee_Master->catg  = $request->category;
              $Employee_Master->work_place = $request->workplace;
              $Employee_Master->DOB = $request->DOB?date('Y-m-d', strtotime($request->DOB)):null;
              $Employee_Master->DOJ  = $request->DOJ?date('Y-m-d', strtotime($request->DOJ)):null;
              $Employee_Master->DOP  = $request->DOP?date('Y-m-d', strtotime($request->DOP)):null;
              $Employee_Master->confirm_date  = $request->DOC?date('Y-m-d', strtotime($request->DOC)):null;
              $Employee_Master->retirement_date  = $request->retirement_date?date('Y-m-d', strtotime($request->retirement_date)):null;     
              $Employee_Master->employee_code  = $request->emp_code;
              $Employee_Master->emp_type = $request->emp_type;
              $Employee_Master->pf_ded = $request->optradio;
              $Employee_Master->esi_ded = $request->optradio1;
              $Employee_Master->PAY_GRADE_CODE = $request->pay_grade_code_hdn;
              $Employee_Master->pf_ac_no = $request->pf;
              $Employee_Master->vp_perc = $request->vpf;
              $Employee_Master->esi_ac_no = $request->esi;
              $Employee_Master->pan_no = $request->PAN;
              $Employee_Master->UAN = $request->uan;
              $Employee_Master->AADHAAR_NO = $request->adhar;
              $Employee_Master->sex = $request->sex;
              $Employee_Master->marital_status = $request->marital;
              $Employee_Master->blood_group = $request->blood;
              $Employee_Master->id_mark = $request->id;
              $Employee_Master->spouse_name = $request->spouse;
              $Employee_Master->father_name = $request->father;
              $Employee_Master->present_address1 = $request->line_11;
              $Employee_Master->present_address2 = $request->line_22;
              $Employee_Master->present_address3 = $request->line_33;
              $Employee_Master->PERM_ADDRESS1 = $request->per_line1;
              $Employee_Master->PERM_ADDRESS2 = $request->per_line2;
              $Employee_Master->PERM_ADDRESS3 = $request->per_line3;
              $Employee_Master->ph_no = $request->contactnumber;
              $Employee_Master->email = $request->email;
              $Employee_Master->mother_name = $request->mother;
              $Employee_Master->spouse_dob = $request->spouse_dob;
              $Employee_Master->father_dob = $request->father_dob;
              $Employee_Master->mother_dob = $request->mother_dob;
              $Employee_Master->reason_desc=$request->inactive;
              $Employee_Master->inactive_reason =$request->reason;
              $Employee_Master->intial_special = $request->intial;
              $Employee_Master->spl_allow = $request->current;
              $Employee_Master->intial_other_special = $request->initial_other;
              $Employee_Master->current_other_special = $request->current_other;
              $Employee_Master->conv_allow = $request->current_other;
              $Employee_Master->intial_basic=$request->intial_basic;
              $Employee_Master->new_basic_pay=$request->current_basic;
              $Employee_Master->payment_mode =$request->payment_bank_mode;
              $Employee_Master->bank_ac_no = $request->account_num;
              $Employee_Master->bank_code = $request->bank_name;
              $Employee_Master->incr_amt = $request->incr_amount;
              $Employee_Master->incr_due_date=$request->incr_date;
              $Employee_Master->pp1=$request->pp1;
              $Employee_Master->pp2=$request->pp2;
              $Employee_Master->initial_pp1=$request->initial_pp1;
              $Employee_Master->initial_pp2=$request->initial_pp2;
          
           $isExist = Employee_Master::select("*")
                          ->where("emp_no",  $emp_no )
                          ->exists();
                  if ($isExist ) {
             return redirect()->back()->with('alert', 'the employee number is already exsits');
                          }
                          else
                          {
                            $Employee_Master->emp_no =$emp_no;
                             $Employee_Master->save();
                             $employee_id = $Employee_Master->id;
                          }
          
           
          //$emp_no  = DB::getPdo()->lastInsertId();
          //official table add//  
          $Employee_Master_Official->emp_no=$emp_no;
          $Employee_Master_Official->pay_grade=$request->pay_grade;
          $Employee_Master_Official->intial_special=$request->intial;
          $Employee_Master_Official->current_special=$request->current;
          $Employee_Master_Official->intial_other_special=$request->initial_other;
          $Employee_Master_Official->current_other_special=$request->current_other;
          $Employee_Master_Official->intial_basic=$request->intial_basic;
        $Employee_Master_Official->current_basic=$request->current_basic;
        // $Employee_Master_Official->payment_bank_mode=$request->payment_bank_mode;
        // $Employee_Master_Official->bank_name=$request->bank_name;
        // $Employee_Master_Official->account_num=$request->account_num;
        // $Employee_Master_Official->incr_date=$request->incr_date;
        // $Employee_Master_Official->incr_amount=$request->incr_amount;
          $Employee_Master_Official->save();//
     
  //nominee table add//
          $Employee_Master_Nominee->emp_no= $emp_no ;
          $Employee_Master_Nominee->nominee_name=$request->nominee_name;
          $Employee_Master_Nominee->relationship=$request->relationship;
          $Employee_Master_Nominee->address1=$request->line1;
          $Employee_Master_Nominee->address2=$request->line2;
          $Employee_Master_Nominee->address3=$request->line3;
          $Employee_Master_Nominee->contact_ph_no=$request->contact;
          $Employee_Master_Nominee->adhara_number=$request->adhara;
          $Employee_Master_Nominee->nominee_dob=$request->dob;
          $Employee_Master_Nominee->save();
  
 //dependent table add//
        $depend_snno=$request->depend_snno;
        $name_arr=$request->name;
        $relation_arr = $request->relation;
        $age_arr = $request->age;
        $dob_arr = $request->dob1;
        $dependent_type_arr = $request->dependent_type;
        $dependent_addr_arr = $request->dependent_addr;
        $adhar_num_arr = $request->num;
         $images=array();
            if($files=$request->file('dependent_file'))
            {  $ctr_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_filename =$emp_no.date('ymdhis').$ctr_img.'.'.$file_extenxion;
                    $file->move(public_path().'/dependent/',$new_filename );  
                    $images[$key]=$new_filename;

                    $ctr_img++;
                }
            }
          //   if ($files=$request->file('dependent_file')) {
          //      $ctr_img=1;
          //   foreach ($files  as $key => $file) {
          //       $name = $file->getClientOriginalName();
          //       $file->move(public_path().'/dependent/',$name );
          //       $data[$key] = $name;
          //        $ctr_img++;
          //   }
          // }

            //print_r($images);exit;
            if(count($name_arr)>0)
            {

                foreach($name_arr as $ky=>$val)
                {
                    if($name_arr[$ky]!="")
                    {//echo $name_arr[$ky].'<br>';

                       $Employee_Master_Dependent = new Dependent();
                       $Employee_Master_Dependent->SL_NO= $depend_snno[$ky];
                       $Employee_Master_Dependent->emp_no= $emp_no ;
                       $Employee_Master_Dependent->depd_name= $name_arr[$ky];
                       $Employee_Master_Dependent->relationship=$relation_arr[$ky];
                       $Employee_Master_Dependent->age=$age_arr[$ky];
                       $Employee_Master_Dependent->depd_dob=$dob_arr[$ky];
                       $Employee_Master_Dependent->type=$dependent_type_arr[$ky];
                       $Employee_Master_Dependent->address=$dependent_addr_arr[$ky];
                       $Employee_Master_Dependent->DEPD_AADHAAR_NO=$adhar_num_arr[$ky];
                       //$count = count($data);
                       if (!empty($images[$ky])) {
                          $Employee_Master_Dependent->upload_adhara =  $images[$ky];
                       }
                       else
                       {
                         $Employee_Master_Dependent->upload_adhara = null;
                       }
                     
                      

                       $Employee_Master_Dependent->save(); 
                     // echo   $Employee_Master_Dependent->upload_adhara;
                      //exit();
                    }

                }
            }

            $academic_snno=$request->academic_snno;
            $quali_arr=$request->academic;
            $qualification_arr=$request->qualification;
            $stream_arr = $request->stream;
            $board_arr = $request->board_name_ajax1;
            $year_arr = $request->year;
            $per_mark_arr = $request->per_mark;
            $division_quali_arr = $request->division_qualification;
            $type_qual =$request->type_qual;
            $remark_quali_arr = $request->remark_qualification;
            $data_qual=array();
            if($files=$request->file('qualification_file'))
            {
              $ctr_qual_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_file_qual_name =$emp_no.date('ymdhis').$ctr_qual_img.'.'.$file_extenxion;
                    $file->move(public_path().'/qualification/', $new_file_qual_name);  
                    $data_qual[$key]=$new_file_qual_name;
                    $data_qual++;
                }
            }

             if(count($quali_arr)>0)
            {
                foreach($quali_arr as $ky=>$val)
                {
                    if($qualification_arr[$ky]!="")
                    {
                  $Employee_Master_Qualification = new Qualification();
                  $Employee_Master_Qualification->SL_NO = $academic_snno[$ky];
                  $Employee_Master_Qualification->emp_no =   $emp_no;
                  $Employee_Master_Qualification->qualification_level_code = $quali_arr[$ky];
                  $Employee_Master_Qualification->emp_quali = $qualification_arr[$ky];
                  $Employee_Master_Qualification->stream_subject =$stream_arr[$ky];
                  $Employee_Master_Qualification->institution =$board_arr[$ky];
                  $Employee_Master_Qualification->year_passing =$year_arr[$ky];
                   $Employee_Master_Qualification->qualification_type =$type_qual[$ky];
                  $Employee_Master_Qualification->mark_perc =$per_mark_arr[$ky];
                  $Employee_Master_Qualification->division =$division_quali_arr[$ky]; 
                  $Employee_Master_Qualification->remark_qualification =$remark_quali_arr[$ky]; 
                  if (!empty($data_qual[$ky])) {
                         $Employee_Master_Qualification->upload  =  $data_qual[$ky];
                       }
                       else
                       {
                         $Employee_Master_Qualification->upload = null;
                       }
                  //$Employee_Master_Qualification->upload =$upload[$ky];  
                  $Employee_Master_Qualification->save(); 

                    }
                    

                }

             }
//experience table add//

            $experience_snno=$request->experience_snno;
            $org_arr=$request->orgn;
            $sector_arr = $request->sect;
            $position_arr = $request->pos;
            $start_date_arr = $request->from;
            $end_date_arr = $request->to;
            $reson_arr =$request->area;
            $remark_arr =$request->remark_area;
            $upload_pic=array();
            if($files=$request->file('e_file'))
            { $ctr_exper_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                     $new_exper_filename =$emp_no.date('ymdhis').$ctr_exper_img.'.'.$file_extenxion;
                    $file->move(public_path().'/experience/', $new_exper_filename);  
                    $upload_pic[$key]=$new_exper_filename;

                     $ctr_exper_img++;
                }
            }

            if(count($org_arr)>0)
            {
                foreach($org_arr as $ky=>$val)
                {
                    if($org_arr[$ky]!="")
                    {
                  $Employee_Master_Experience = new Experience();
                  $Employee_Master_Experience->SL_NO = $experience_snno[$ky];
                  $Employee_Master_Experience->emp_no =   $emp_no;
                  $Employee_Master_Experience->orgn_name = $org_arr[$ky];
                  $Employee_Master_Experience->sector =$sector_arr[$ky];
                  $Employee_Master_Experience->position =$position_arr[$ky];
                  $Employee_Master_Experience->start_date =$start_date_arr[$ky];
                  $Employee_Master_Experience->end_date =$end_date_arr[$ky];
                  $Employee_Master_Experience->reason =$reson_arr[$ky]; 
                  $Employee_Master_Experience->remark_area =$remark_arr[$ky];  
                  if (!empty($upload_pic[$ky])) {
                     $Employee_Master_Experience->upload  =  $upload_pic[$ky];
                   }
                   else
                   {
                     $Employee_Master_Experience->upload = null;
                   }
                  //$Employee_Master_Experience->upload =$upload_pic[$ky];  

                  $Employee_Master_Experience->save(); 

                    }
                    

                }

             }
//transfer table add//

$transfer_snno=$request->transfer_snno;
 $trans_order_arr=$request->trans_order;
            $type_arr = $request->order_type;
            $transfer_ord_date_arr = $request->transfer_ord_date;
            $from_date_arr = $request->from_date;
            $to_date_arr = $request->to_date;
            $from_dept_arr =$request->f_dept;
            $to_dept_arr = $request->t_dept;
            $from_work_arr = $request->from_work;
            $to_work_arr = $request->to_work;
            $reson_arr =$request->ord_rea;
            $reamrks_arr = $request->reamrks;
            $upload_transfer=array();
            if($files=$request->file('trans_file'))
            {$ctr_trans_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                     $new_trans_filename =$emp_no.date('ymdhis').$ctr_trans_img.'.'.$file_extenxion;
                    $file->move(public_path().'/transfer/', $new_trans_filename);  
                    $upload_transfer[$key]=$new_trans_filename;

                  $ctr_trans_img++;
                }
            }
            if(count($trans_order_arr)>0)
            {
                foreach($trans_order_arr as $ky=>$val)
                {
                    if($trans_order_arr[$ky]!="")
                    {
                  $Employee_Master_Transfer = new Transfer();
                  $Employee_Master_Transfer->SL_NO = $transfer_snno[$ky];
                  $Employee_Master_Transfer->emp_no =   $emp_no;
                  $Employee_Master_Transfer->tranfer_order_no = $trans_order_arr[$ky];
                  $Employee_Master_Transfer->type =$type_arr[$ky];
                  $Employee_Master_Transfer->trans_date =$transfer_ord_date_arr[$ky];
                  $Employee_Master_Transfer->from_date =$from_date_arr[$ky];
                  $Employee_Master_Transfer->to_date =$to_date_arr[$ky];
                  $Employee_Master_Transfer->from_dept =$from_dept_arr[$ky];  
                  $Employee_Master_Transfer->to_dept =$to_dept_arr[$ky];
                  $Employee_Master_Transfer->from_work =$from_work_arr[$ky];
                  $Employee_Master_Transfer->to_work =$to_work_arr[$ky];
                  $Employee_Master_Transfer->reason =$reson_arr[$ky];  
                  $Employee_Master_Transfer->remark =$reamrks_arr[$ky];
                     if (!empty($upload_transfer[$ky])) 
                     {
                       $Employee_Master_Transfer->upload  =  $upload_transfer[$ky];
                     }
                     else
                     {
                       $Employee_Master_Transfer->upload = null;
                     } 
                   $Employee_Master_Transfer->save(); 

                    }
                    

                }

             }
//promotion table
       //promotion table
       
            $promo_slno=$request->promo_slno;
            $promo_order_arr=$request->promo_order_no;
            $promo_date_arr = $request->promo_date;
            $effect_date_arr = $request->effect_date;
            $from_grade_arr = $request->from_grade;
            $from_design_arr = $request->from_design;
            $from_basic_arr =$request->from_basic;
            $from_special_arr = $request->from_special;
            $from_other_special_arr = $request->from_other_special;
            $other_allowance_arr = $request->from_special;
            $to_grade_arr =$request->to_grade;
            $to_portion_arr = $request->to_portion;
            $to_basic_arr = $request->to_basic;
            $total_allow_arr = $request->total_allow;
            $to_other_allow_arr = $request->to_other_allowance;
            $remark_arr =$request->remark;
            $upload_promotion=array();
            if($files=$request->file('upload_promo'))
            {$ctr_promo_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                     $new_promo_filename =$emp_no.date('ymdhis').$ctr_promo_img.'.'. $file_extenxion;
                    $file->move(public_path().'/promotion/', $new_promo_filename);  
                    $upload_promotion[$key]=$new_promo_filename;

                    $ctr_promo_img++;
                }
            }

            if(count($promo_order_arr)>0)
            {
                foreach($promo_order_arr as $ky=>$val)
                {
                    if($promo_order_arr[$ky]!="")
                    {
                  $Employee_Master_Promotion = new Promotion();
                  $Employee_Master_Promotion->SL_NO = $promo_slno[$ky];
                  $Employee_Master_Promotion->emp_no =   $emp_no;
                  $Employee_Master_Promotion->promotion_order_no = $promo_order_arr[$ky];
                  $Employee_Master_Promotion->promotion_date =$promo_date_arr[$ky];
                  $Employee_Master_Promotion->promotion_effect_date =$effect_date_arr[$ky];
                  $Employee_Master_Promotion->from_grade_code =$from_grade_arr[$ky];
                  $Employee_Master_Promotion->from_desg_code =$from_design_arr[$ky];
                  $Employee_Master_Promotion->from_basic_pay =$from_basic_arr[$ky];
                  $Employee_Master_Promotion->special_allownace =$from_special_arr[$ky];
            $Employee_Master_Promotion->other_special_allownace =$from_other_special_arr[$ky];
                  $Employee_Master_Promotion->to_grade_code =$to_grade_arr[$ky];  
                  $Employee_Master_Promotion->to_portion =$to_portion_arr[$ky];  
                  $Employee_Master_Promotion->to_basic_pay =$to_basic_arr[$ky];
                  $Employee_Master_Promotion->total_allowance =$total_allow_arr[$ky];
                  $Employee_Master_Promotion->other_allowance =$to_other_allow_arr[$ky];
                  $Employee_Master_Promotion->remark =$remark_arr[$ky];
                   if (!empty($upload_promotion[$ky])) 
                     {
                       $Employee_Master_Promotion->upload  =  $upload_promotion[$ky];
                     }
                     else
                     {
                       $Employee_Master_Promotion->upload = null;
                     } 
                  //$Employee_Master_Promotion->upload =$upload_promotion[$ky];  
  

                  $Employee_Master_Promotion->save(); 

                    }
                    

                }

             }
//probation table//
           //probation table//
           
           $prob_slno=$request->prob_slno;
            $prob_order_arr=$request->prob_order;
            $prob_start_date_arr = $request->prob_start;
            $prob_end_date_arr = $request->prob_end;
            $pay_grade_arr = $request->pay_grade1;
            $initial_basic_arr = $request->initial;
            $special_allowance_arr =$request->special_allowance;
            $other_allownace_arr = $request->other_allownace;
            $remark_prob_arr =$request->remark_prob;

           $upload_prob=array();
            if($files=$request->file('prob_upload'))
            {$ctr_prob_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_prob_filename =$emp_no.date('ymdhis').$ctr_prob_img.'.'.$file_extenxion;
                    $file->move(public_path().'/probation/', $new_prob_filename);  
                    $upload_prob[$key]=$new_prob_filename;
                    $ctr_prob_img++;
                }
            }

      
            if(count($prob_order_arr)>0)
            {
                foreach($prob_order_arr as $ky=>$val)
                {
                    if($prob_order_arr[$ky]!="")
                    {
                  $Employee_Master_Probation = new Probation();
                  $Employee_Master_Probation->SL_NO = $prob_slno[$ky];   
                  $Employee_Master_Probation->emp_no =   $emp_no;
                  $Employee_Master_Probation->prob_order_no = $prob_order_arr[$ky];
                  $Employee_Master_Probation->prob_start_date =$prob_start_date_arr[$ky];
                  $Employee_Master_Probation->prob_end_date =$prob_end_date_arr[$ky];
                  $Employee_Master_Probation->pay_grade =$pay_grade_arr[$ky];
                  $Employee_Master_Probation->intial_basic =$initial_basic_arr[$ky];
                  $Employee_Master_Probation->special_allowance =$special_allowance_arr[$ky];
                  $Employee_Master_Probation->other_allowance = $other_allownace_arr[$ky];
                  $Employee_Master_Probation->remarks =$remark_prob_arr[$ky]; 

                  if (!empty($upload_prob[$ky])) 
                     {
                       $Employee_Master_Probation->upload  =  $upload_prob[$ky];
                     }
                     else
                     {
                       $Employee_Master_Probation->upload = null;
                     } 
                

                  $Employee_Master_Probation->save(); 

                    }
                    

                }

            }
//contract table//
           //contract table//
           
           $cont_slno=$request->cont_slno;
            $contract_order_arr=$request->cont_order;
            $contract_start_date_arr = $request->cont_start_date;
            $contract_end_date_arr = $request->cont_end_date;
            $con_pay_arr = $request->con_pay;
            $special_arr = $request->special;
            $other_arr =$request->other;
            $remarks_cont_arr = $request->remarks;

            $upload_cont=array();
            if($files=$request->file('cont_file'))
            {$ctr_cont_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_cont_filename =$emp_no.date('ymdhis').$ctr_cont_img.'.'.$file_extenxion;
                    $file->move(public_path().'/contract/', $new_cont_filename);  
                    $upload_cont[$key]=$new_cont_filename;


                    $ctr_cont_img++;
                }
            }
          if(count($contract_order_arr)>0)
            {
                foreach($contract_order_arr as $ky=>$val)
                {
                    if($contract_order_arr[$ky]!="")
                    {
                  $Employee_Master_Contract = new Contract();
                  $Employee_Master_Contract->Sl_NO = $cont_slno[$ky];   
                  $Employee_Master_Contract->emp_no =   $emp_no;
                  $Employee_Master_Contract->cont_order_no = $contract_order_arr[$ky];
                  $Employee_Master_Contract->cont_start_date =$contract_start_date_arr[$ky];
                  $Employee_Master_Contract->cont_end_date =$contract_end_date_arr[$ky];
                  $Employee_Master_Contract->sal =$con_pay_arr[$ky];
                  $Employee_Master_Contract->special_allowance =$special_arr[$ky];
                  $Employee_Master_Contract->other_allowance =$other_arr[$ky];
                  $Employee_Master_Contract->remarks =$remarks_cont_arr[$ky];  

                  if (!empty($upload_cont[$ky])) 
                     {
                       $Employee_Master_Contract->upload  =  $upload_cont[$ky];
                     }
                     else
                     {
                       $Employee_Master_Contract->upload = null;
                     } 
                
                  //$Employee_Master_Contract->upload =$upload_cont[$ky];  

                  $Employee_Master_Contract->save(); 

                    }
                    

                }

            }
  //antecendent table//
              $cont_slno=$request->cont_slno;
              $antecedent_order_arr=$request->ante_order_no;
              $antecedent_order_date_arr = $request->ante_order_date;
              $antecedent_type_arr = $request->ante_type;
              $w_e_e_arr = $request->ante_w_e_e;
              $w_e_t_arr = $request->ante_w_e_t;
              $remarks_ante_arr = $request->ante_remarks;
              $upload_ante_arr=array();
                if($files=$request->file('antecedent_upload'))
                {$ante_ante_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_ante_filename =$emp_no.date('ymdhis').$ante_ante_img.'.'.$file_extenxion;
                        $file->move(public_path().'/antecedent/', $new_ante_filename);  
                        $upload_ante_arr[$key]=$new_ante_filename;


                        $ante_ante_img++;
                    }
                }
            if(count($antecedent_order_arr)>0)
              {
                  foreach($antecedent_order_arr as $ky=>$val)
                  {
                      if($antecedent_order_arr[$ky]!="")
                      {
                    $Employee_Master_antecedent = new Antecedent();
                    $Employee_Master_antecedent->slno = $cont_slno[$ky]; 
                    $Employee_Master_antecedent->emp_no =    $emp_no ;
                    $Employee_Master_antecedent->order_no = $antecedent_order_arr[$ky];
                    $Employee_Master_antecedent->order_date =$antecedent_order_date_arr[$ky];
                    $Employee_Master_antecedent->type =$antecedent_type_arr[$ky];
                    $Employee_Master_antecedent->WEE_date =$w_e_e_arr[$ky];
                    $Employee_Master_antecedent->WET_date =$w_e_t_arr[$ky];
                    $Employee_Master_antecedent->remarks =$remarks_ante_arr[$ky]; 
                     if (!empty($upload_ante_arr[$ky])) 
                     {
                       $Employee_Master_antecedent->upload  =  $upload_ante_arr[$ky];
                     }
                     else
                     {
                       $Employee_Master_antecedent->upload = null;
                     } 
                    $Employee_Master_antecedent->save(); 
  
                      }
                      
  
                  }
  
              }
  //Revocation table add// 
   
              $revo_slno=$request->revo_slno;
              $revocation_order_arr=$request->revo_order_no;
              $revocation_order_date_arr = $request->revo_order_date;
              $ant_ord_no_arr = $request->ant_ord_no;
             $ant_ord_dat_arr = $request->ant_ord_dat; 
              $ant_ord_type_arr = $request->ant_ord_type;
              $ant_WEF_arr = $request->ant_WEF;
              $ant_WET_arr = $request->ant_WET;
              $revo_effected_date_arr = $request->revo_effected_date;
              $revo_remark_arr = $request->revo_remark;
              $upload_revo_arr=array();
                if($files=$request->file('revocation_upload'))
                {$ante_revo_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_revo_filename =$emp_no.date('ymdhis').$ante_revo_img.'.'.$file_extenxion;
                        $file->move(public_path().'/revocation/', $new_revo_filename);  
                        $upload_revo_arr[$key]=$new_revo_filename;


                        $ante_revo_img++;
                    }
                }
              
            if(count($revocation_order_arr)>0)
              {
                  foreach($revocation_order_arr as $ky=>$val)
                  {
                      if($revocation_order_arr[$ky]!="")
                      {
                    $Employee_Master_revocation = new Revocation();
                      
            $Employee_Master_revocation->slno = $revo_slno[$ky];         
            $Employee_Master_revocation->emp_no =    $emp_no ;
            $Employee_Master_revocation->revocation_order_no = $revocation_order_arr[$ky];
            $Employee_Master_revocation->revocation_order_date =$revocation_order_date_arr[$ky]; 
            $Employee_Master_revocation->antecedent_order_no =$ant_ord_no_arr[$ky];
            $Employee_Master_revocation->antecedent_order_date =$ant_ord_dat_arr[$ky];
            $Employee_Master_revocation->antecedent_type =$ant_ord_type_arr[$ky];
            $Employee_Master_revocation->antecedent_WEE_date =$ant_WEF_arr[$ky]; 
            $Employee_Master_revocation->antecedent_WET_date =$ant_WET_arr[$ky];
            $Employee_Master_revocation->revocation_effected_date =$revo_effected_date_arr[$ky];
            $Employee_Master_revocation->remarks =$revo_remark_arr[$ky]; 
           if (!empty($upload_revo_arr[$ky])) 
               {
                 $Employee_Master_revocation->upload  =  $upload_revo_arr[$ky];
               }
               else
               {
                 $Employee_Master_revocation->upload = null;
               } 
            $Employee_Master_revocation->save(); 
  
                      }
                      
  
                  }
  
              } 
              //appreciation add
              
              $app_slno=$request->app_slno;
            $appreciation_order_arr=$request->app_order_no;
            $appreciation_order_date_arr = $request->app_order_date;
            $appreciationtype_arr = $request->appreciation_type;
            $apprecommended_arr = $request->recommended_by; 
            $appdescription_arr = $request->app_description;
            $appremark_arr = $request->app_remarks;
            $upload_revo_arr=array();
                if($files=$request->file('appriciation_upload'))
                {$ante_revo_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_revo_filename =$emp_no.date('ymdhis').$ante_revo_img.'.'.$file_extenxion;
                        $file->move(public_path().'/appreciation/', $new_revo_filename);  
                        $upload_revo_arr[$key]=$new_revo_filename;


                        $ante_revo_img++;
                    }
                }
                if(count($appreciation_order_arr)>0)
                {
                    foreach($appreciation_order_arr as $ky=>$val)
                    {
                        if($appreciation_order_arr[$ky]!="")
                        {
                      $Employee_Master_app = new Appriciation();
              $Employee_Master_app->slno = $app_slno[$ky]; 
              $Employee_Master_app->emp_no =    $emp_no ;
              $Employee_Master_app->order_no = $appreciation_order_arr[$ky];
              $Employee_Master_app->order_date =$appreciation_order_date_arr[$ky]; 
              $Employee_Master_app->appreciation_type =$appreciationtype_arr[$ky];
              $Employee_Master_app->recommended_by =$apprecommended_arr[$ky];
              $Employee_Master_app->app_description =$appdescription_arr[$ky];
              $Employee_Master_app->app_remarks =$appremark_arr[$ky]; 
                if (!empty($upload_revo_arr[$ky])) 
                   {
                     $Employee_Master_app->upload  =  $upload_revo_arr[$ky];
                   }
                   else
                   {
                     $Employee_Master_app->upload = null;
                   } 
               $Employee_Master_app->save(); 
    
                        }
                        
    
                    }
    
                }
                  //Reward add
                        
            $reward_slno=$request->reward_slno;
            $appreciation_order_arr=$request->reorder_no;
            $appreciation_order_date_arr = $request->reorder_date;
            $appreciationtype_arr = $request->reward_type;
            $apprecommended_arr = $request->re_recommended_by; 
            $appdescription_arr = $request->re_description;
            $appremark_arr = $request->re_remarks;
            $upload_revo_arr=array();
                if($files=$request->file('remark_upload'))
                {$ante_revo_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_revo_filename =$emp_no.date('ymdhis').$ante_revo_img.'.'.$file_extenxion;
                        $file->move(public_path().'/reward/', $new_revo_filename);  
                        $upload_revo_arr[$key]=$new_revo_filename;


                        $ante_revo_img++;
                    }
                }
                if(count($appreciation_order_arr)>0)
                {
                    foreach($appreciation_order_arr as $ky=>$val)
                    {
                        if($appreciation_order_arr[$ky]!="")
                        {
                      $Employee_Master_reward = new Reward();
              $Employee_Master_reward->slno = $reward_slno[$ky];         
              $Employee_Master_reward->emp_no =    $emp_no ;
              $Employee_Master_reward->reorder_no = $appreciation_order_arr[$ky];
              $Employee_Master_reward->reorder_date =$appreciation_order_date_arr[$ky]; 
              $Employee_Master_reward->reward_type =$appreciationtype_arr[$ky];
              $Employee_Master_reward->re_recommended_by =$apprecommended_arr[$ky];
              $Employee_Master_reward->re_description =$appdescription_arr[$ky];
              $Employee_Master_reward->re_remarks =$appremark_arr[$ky]; 
                if (!empty($upload_revo_arr[$ky])) 
                   {
                     $Employee_Master_reward->upload  =  $upload_revo_arr[$ky];
                   }
                   else
                   {
                     $Employee_Master_reward->upload = null;
                   } 
               $Employee_Master_reward->save(); 
    
                        }
                        
    
                    }
    
                }
                //INTIATION table add//  
            $intiation_slno=$request->intiation_slno;
            $initiative_date_arr=$request->initiative_date;
            $inti_type_arr = $request->inti_type;
            $inti_description_arr = $request->inti_description;
            $inti_remark_arr = $request->inti_remark; 
           // $Initiative_upload_arr = $request->Initiative_upload;
           
            $upload_Initiative_arr=array();
                if($files=$request->file('Initiative_upload'))
                {$ante_inti_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_inti_filename =$emp_no.date('ymdhis').$ante_inti_img.'.'.$file_extenxion;
                        $file->move(public_path().'/Initiative/', $new_inti_filename);  
                        $upload_inti_arr[$key]=$new_inti_filename;


                        $ante_inti_img++;
                    }
                }
            
          if(count($initiative_date_arr)>0)
            {
                foreach($initiative_date_arr as $ky=>$val)
                {
                    if($initiative_date_arr[$ky]!="")
                    {
                  $Employee_Master_initiative = new Intiation();
          
          $Employee_Master_initiative->slno = $intiation_slno[$ky];    
          $Employee_Master_initiative->emp_no =    $emp_no ;
          $Employee_Master_initiative->initiative_date = $initiative_date_arr[$ky];
          $Employee_Master_initiative->type =$inti_type_arr[$ky]; 
          $Employee_Master_initiative->description =$inti_description_arr[$ky];
          $Employee_Master_initiative->remark =$inti_remark_arr[$ky];
         
            if (!empty($upload_inti_arr[$ky])) 
               {
                 $Employee_Master_initiative->upload  =  $upload_inti_arr[$ky];
               }
               else
               {
                 $Employee_Master_initiative->upload = null;
               } 
          $Employee_Master_initiative->save(); 

                    }
                    

                }

            } 
//achievement table add//  

            $achievement_slno=$request->achievement_slno;
            $achievement_date_arr=$request->achievement_date;
            $achievement_type_arr = $request->achievement_type;
            $achievement_description_arr = $request->achievement_period;
            $achievement_remark_arr = $request->achievement_remark; 
           // $Initiative_upload_arr = $request->Initiative_upload;
           
            $upload_achievement_arr=array();
                if($files=$request->file('achievement_upload'))
                {$ante_achi_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_achi_filename =$emp_no.date('ymdhis').$ante_achi_img.'.'.$file_extenxion;
                        $file->move(public_path().'/achievement/', $new_achi_filename);  
                        $upload_achi_arr[$key]=$new_achi_filename;


                        $ante_achi_img++;
                    }
                }
            
          if(count($achievement_date_arr)>0)
            {
                foreach($achievement_date_arr as $ky=>$val)
                {
                    if($achievement_date_arr[$ky]!="")
                    {
                  $Employee_Master_Achievement = new Achievement();
                   
          $Employee_Master_Achievement->slno = $achievement_slno[$ky];
          $Employee_Master_Achievement->emp_no =    $emp_no ;
          $Employee_Master_Achievement->achievement_date = $achievement_date_arr[$ky];
          $Employee_Master_Achievement->achievement_type =$achievement_type_arr[$ky]; 
          $Employee_Master_Achievement->achievement_period =$achievement_description_arr[$ky];
          $Employee_Master_Achievement->remark =$achievement_remark_arr[$ky];
         
            if (!empty($upload_achi_arr[$ky])) 
               {
                 $Employee_Master_Achievement->upload  =  $upload_achi_arr[$ky];
               }
               else
               {
                 $Employee_Master_Achievement->upload = null;
               } 
          $Employee_Master_Achievement->save(); 

                    }
                    

                }

            }    
        }
//remark start

$remark_slno=$request->remark_slno;
$remark_text_arr=$request->remark_text;
$upload_achi_arr1=array();
  if($files1=$request->file('remark_attachment'))
    {
      $ante_achi_img1=1;
      foreach($files1 as $key1 => $file)
      {
          $name=$file->getClientOriginalName();
          $file_extenxion = $file->getClientOriginalExtension();
          $new_achi_filename1 =$emp_no.date('ymdhis').$ante_achi_img1.'.'.$file_extenxion;
          $file->move(public_path().'/remark/', $new_achi_filename1);  
          $upload_achi_arr1[$key1]=$new_achi_filename1;
          $ante_achi_img1++;
      }
  }
if(count($remark_text_arr)>0)
{
foreach($remark_text_arr as $ky1=>$val)
{
  if($remark_text_arr[$ky1]!="")
  {
    $Employee_remark = new Remark();
    $Employee_remark->slno =$remark_slno[$ky1] ;
    $Employee_remark->emp_no = $emp_no ;
    $Employee_remark->currendate = date('Y-m-d') ;
    $Employee_remark->remark_text = $remark_text_arr[$ky1];
    if (!empty($upload_achi_arr1[$ky1])) 
        {
          $Employee_remark->remark_attachment  =  $upload_achi_arr1[$ky1];
        }  else {
          $Employee_remark->remark_attachment = null;
        } 
        $Employee_remark->save(); 
  }
}
}
//remark end





      //echo "<pre>";print_r($addtable2); echo "</pre>"; exit();
      //$id = DB::table('empmst_official')->insertGetId($addtable2);
     if(Auth::user()->role == "Administrator" || Auth::user()->role == "HR Manager" || Auth::user()->role == "Authorisor" || Auth::user()->role == "Supervisor"){
         return redirect('/employee_edit_master/?search_emp='.$employee_number)->withInput()->with('SuccessStatus', 'Records sucessfully uploaded');
        } else {
          return redirect('/employee_master')->with('SuccessStatus', 'Records sucessfully uploaded');
        }
     } 






     public function updateEmployeeDetails(Request $request)
     {
       $Employee_Master = new Employee_Master();
         $employee_number = $request->emp_no;
         $employee_id = $request->emp_id;
         $employee_name = $request->emp_name;
         $active_type = $Employee_Master->active_type = $request->type; 
         if ($request->hasFile('image')) 
         {
             $image = $request->file('image');
             $name = rand().time().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/image/');
             $image->move($destinationPath, $name);
             $imageinsert= $name;
         }
         else{
          $imageinsert= $request->old_empImage;
         }
         $storenum = DB::table('employee_type')->select("*")->where("emp_type_code",  $request->emp_type)->first();
         if($request->emp_type==""){
          $store_by_number = 0;
         } else {
          $store_by_number = $storenum->store_by;
         }
         
             if($active_type=="I" ||  $active_type=="A")
             {
             $emp_name =$request->emp_name;
             $emp_code =$request->emp_code;
             $dept_no =$request->department;
             $emp_type =$request->emp_type;
             $workplace=$request->workplace;
             $designation =$request->designation;
             $category =$request->category;
             $DOB=$request->DOB?date('Y-m-d', strtotime($request->DOB)):null;
             $DOJ=$request->DOJ?date('Y-m-d', strtotime($request->DOJ)):null;
             $DOP=$request->DOP?date('Y-m-d', strtotime($request->DOP)):null;
             $DOC= $request->DOC?date('Y-m-d', strtotime($request->DOC)):null;
             $retirement_date=$request->retirement_date?date('Y-m-d', strtotime($request->retirement_date)):null;
             $pf_arr =$request->optradio;
             $esi_arr= $request->optradio1;
             $gradecode_arr = $request->grade_code_arr;
             $pfacc_arr= $request->pf;
             $vpf_arr= $request->vpf;
             $esi_acc_no= $request->esi;
             $pan_arr = $request->PAN;
             $uan_arr = $request->uan;
             $adhara_arr = $request->adhar;
             $per_gender = $request->sex;
             $per_marital = $request->marital;
             $per_blood = $request->blood;
             $per_identificationmark = $request->id;
             $per_spousename= $request->spouse;
             $per_father = $request->father;
             $per_line11 = $request->line_11;
             $per_line22 = $request->line_22;
             $per_line33 = $request->line_33;
             $per_linearr1 = $request->per_line1;
             $per_linearr2 = $request->per_line2;
             $per_linearr3 = $request->per_line3;
             $per_contact = $request->contactnumber;
             $per_email = $request->email;
             $per_mother = $request->mother;
             $per_sdob = $request->spouse_dob;
             $per_fdob = $request->father_dob;
             $per_mdob = $request->mother_dob;
             $reason_desc=$request->reason_desc;
             $inactive_reason =$request->inactive_reason;
             $inactive_date =$request->inactive_date;
             $payment_mode =$request->payment_bank_mode;
            $bank_ac_no = $request->account_num;
            $bank_code = $request->bank_name;
            $incr_amt = $request->incr_amount;
            $incr_due_date=$request->incr_date;
             $initial_arr = $request->intial;
            $curr_arr = $request->current;
            $other_arr = $request->initial_other;
            $cother_arr = $request->current_other;
            $conv_allow = $request->current_other;
            $intial_basic=$request->intial_basic;
            $current_basic=$request->current_basic;
             } 
             if($per_marital == "Unmarried"){
               $per_sdob ="";
               $per_spousename="";

             }
             if($active_type == "active"){
                $reason_desc =null;
               $inactive_reason=null;
               $inactive_date=null;
              }
              $employee_details_fetch =array(
                        'emp_name' =>$emp_name,
                        'employee_code'=> $emp_code,
                        'dept_no'=>$dept_no,
                        'emp_type'=> $emp_type,
                        'desg_code'=> $designation,
                        'catg'=> $category,
                        'work_place'=>$workplace,
                        'image'=> $imageinsert,
                        'DOB'=>$DOB,
                        'DOJ'=>$DOJ,
                        'DOP'=>$DOP,
                        'confirm_date'=>$DOC,
                        'retirement_date' =>$retirement_date,
                        'pf_ded'=> $pf_arr,
                        'esi_ded'=> $esi_arr,
                        'PAY_GRADE_CODE'=> $gradecode_arr,
                        'pf_ac_no'=> $pfacc_arr,
                        'vp_perc'=> $vpf_arr,
                        'esi_ac_no'=> $esi_acc_no,
                        'pan_no'=> $pan_arr,
                        'UAN'=> $uan_arr,
                        'AADHAAR_NO'=> $adhara_arr,
                        'sex'=> $per_gender,
                        'marital_status'=> $per_marital,
                        'blood_group'=> $per_blood,
                        'id_mark'=> $per_identificationmark,
                        'spouse_name'=> $per_spousename,
                        'father_name'=> $per_father,
                        'present_address1'=> $per_line11,
                        'present_address2'=> $per_line22,
                        'present_address3'=> $per_line33,
                        'PERM_ADDRESS1'=> $per_linearr1,
                        'PERM_ADDRESS2'=> $per_linearr2,
                        'PERM_ADDRESS3'=> $per_linearr3,
                        'ph_no'=> $per_contact,
                        'email'=> $per_email,
                        'mother_name'=> $per_mother,
                        'spouse_dob'=> $per_sdob,
                        'father_dob'=> $per_fdob,
                        'mother_dob'=> $per_mdob,
                        'reason_desc'=>$reason_desc,
                        'inactive_reason' =>$inactive_reason,
                        'inactive_date' =>$inactive_date,
                        'active_type'=>$active_type,
                         'payment_mode' =>$payment_mode,
                        'bank_ac_no' => $bank_ac_no,
                        'bank_code' => $bank_code,
                        'incr_amt' => $incr_amt,
                        'incr_due_date'=>$incr_due_date,
                         'intial_special'=> $initial_arr,
              'spl_allow'=>$curr_arr,
              'intial_other_special'=> $other_arr,
              'current_other_special'=> $cother_arr,
              'conv_allow'=> $conv_allow,
              'intial_basic'=>$intial_basic,
              'new_basic_pay'=>$current_basic, 
              'CONT_SAL'=>$request->CONT_SAL, 
              'pp1'=>$request->pp1, 
              'pp2'=>$request->pp2, 
              'initial_pp1'=>$request->initial_pp1, 
              'initial_pp2'=>$request->initial_pp2,
              'type_store_by'=>$store_by_number
              );
         $update_Data=DB::table('emp_mst')->where('emp_no',  $employee_number)->update($employee_details_fetch); 

          
         //    $pay_arr = $request->pay_grade;
         //    $initial_arr = $request->intial;
         //    $curr_arr = $request->current;
         //    $other_arr = $request->initial_other;
         //    $cother_arr = $request->current_other;
         //    $intial_basic=$request->intial_basic;
         //    $current_basic=$request->current_basic;
         //    $payment_bank_mode=$request->payment_bank_mode;
         //    $bank_name=$request->bank_name;
         //    $account_num=$request->account_num;
         //    $incr_date=$request->incr_date;
         //    $incr_amount=$request->incr_amount;

         //    $employee_payscaledetails =array(
         //      //'emp_no' => $emp_no,
         //      'pay_grade' =>$pay_arr,
             
         //       'payment_bank_mode' =>$payment_bank_mode,
         //      'bank_name'=> $bank_name,
         //      'account_num'=>$account_num,
         //      'incr_date'=> $incr_date,
         //      'incr_amount'=> $incr_amount

         //          );
         // $update_Data=DB::table('empmst_official')
         //          ->where('emp_no',  $employee_id)
         //          ->update($employee_payscaledetails); 

        // $nm_name = $request->nominee_name;
        // $nm_date = $request->dob;
        // $nm_reltn = $request->relationship;
        // $nm_phn = $request->phonenumber;
        // $nm_adhara = $request->adhara;
        // $nm_add1 = $request->line1;
        // $nm_add2 = $request->line2;
        // $nm_add3 = $request->line3;

        // $employee_nomineedetails =array(
        //   //'emp_no' => $emp_no,
        //   'nominee_name' =>$nm_name,
        //   'nominee_dob'=> $nm_date,
        //   'relationship'=> $nm_reltn,
        //   'contact_ph_no'=>$nm_phn,
        //   'adhara_number'=> $nm_adhara,
        //   'address1'=> $nm_add1,
        //   'address2'=> $nm_add2,
        //   'address3'=> $nm_add3,
        // );
        // $update_Data=DB::table('emp_nominee_dtl')
        // ->where('emp_no',  $employee_id)
        // ->update($employee_nomineedetails); 
        $depend_snno=$request->depend_snno;   
        $name_arr=$request->name;
        $relation_arr = $request->relation;
        $age_arr = $request->age;
        $dob_arr = $request->dob1;
        $dependent_type_arr = $request->dependent_type;
        $dependent_addr_arr = $request->dependent_addr;
        $adhar_num_arr = $request->num;
        $depedent_sqlId_arr = $request->depedent_sql_id;
        $images=array();
        $images_index=array();
        //////////////print_r($request->file('dependent_file'));exit;
            if($files=$request->file('dependent_file'))
            {  $ctr_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_filename =$employee_id.date('ymdhis').$ctr_img.'.'.$file_extenxion;
                    $file->move(public_path().'/dependent/',$new_filename );  
                    $images[$key]=$new_filename;
                    $images_index[]=$key;
                    $ctr_img++;
                }
            }

            //print_r($images);exit;
            if(count($name_arr)>0)
            {

                foreach($name_arr as $ky=>$val)
                {//print_r($name_arr);exit();
                    if($name_arr[$ky]!="")
                    {
                      if( $depedent_sqlId_arr[$ky]=="")
                        {
                        if (in_array($ky,$images_index))
                         {
                          $employee_dependent_details_fetch =array( 
                            'SL_NO'=>$depend_snno[$ky],
                            'emp_no'=>  $employee_number,
                            'depd_name'=> $name_arr[$ky],
                            'relationship'=>$relation_arr[$ky],
                            'age'=> $age_arr[$ky],
                            'depd_dob'=> $dob_arr[$ky],
                            'type'=>$dependent_type_arr[$ky],
                            'address'=>$dependent_addr_arr[$ky],
                            'DEPD_AADHAAR_NO'=> $adhar_num_arr[$ky], 
                            'upload_adhara'=> $images[$ky],   
                            ); 
                          }
                          else
                          {
                            $employee_dependent_details_fetch =array( 
                              'SL_NO'=>$depend_snno[$ky],
                              'emp_no'=>  $employee_number,
                              'depd_name'=> $name_arr[$ky],
                              'relationship'=>$relation_arr[$ky],
                              'age'=> $age_arr[$ky],
                              'depd_dob'=> $dob_arr[$ky],
                              'type'=>$dependent_type_arr[$ky],
                              'address'=>$dependent_addr_arr[$ky],
                              'DEPD_AADHAAR_NO'=> $adhar_num_arr[$ky], 
                               
                              ); 
                          }

                      $update_Data=DB::table('emp_dependent_dtl')
                        ->where('emp_no',  $employee_number)                      
                        ->insert( $employee_dependent_details_fetch);
                      } else{
                        if (in_array($ky,$images_index)) {
                          $employee_dependent_details_fetch =array(  
                           'SL_NO'=>$depend_snno[$ky],                         
                          'depd_name'=> $name_arr[$ky],
                          'relationship'=>$relation_arr[$ky],
                          'age'=> $age_arr[$ky],
                          'depd_dob'=> $dob_arr[$ky],
                          'type'=>$dependent_type_arr[$ky],
                          'address'=>$dependent_addr_arr[$ky],
                          'DEPD_AADHAAR_NO'=> $adhar_num_arr[$ky],
                           'upload_adhara'=>  $images[$ky]
                         );
                       }
                       else
                       {
                         $employee_dependent_details_fetch =array(   
                          'SL_NO'=>$depend_snno[$ky],                      
                          'depd_name'=> $name_arr[$ky],
                          'relationship'=>$relation_arr[$ky],
                          'age'=> $age_arr[$ky],
                          'depd_dob'=> $dob_arr[$ky],
                          'type'=>$dependent_type_arr[$ky],
                          'address'=>$dependent_addr_arr[$ky],
                          'DEPD_AADHAAR_NO'=> $adhar_num_arr[$ky],                           
                         );
                       }
                     
                   
                          $update_Data=DB::table('emp_dependent_dtl')
                        ->where('emp_no',  $employee_number)
                        ->where('id',$depedent_sqlId_arr[$ky])
                        ->update($employee_dependent_details_fetch);  
                        } 
                    }

                }
            }

            $academic_snno=$request->academic_snno;
            $quali_arr=$request->academic;
            //print_r($quali_arr);exit();
            $stream_arr = $request->stream;
            // print_r($stream_arr);exit();
            // $ll =$request->typcce;
            // print_r($ll);exit();
            $type_qual =$request->typcce;
           //print_r($type_qual);exit();
            $qualification_arr=$request->qualification;
            $board_arr = $request->board_name_ajax1;
            $year_arr = $request->year;
            $per_mark_arr = $request->per_mark;
            $division_quali_arr = $request->division_qualification;
            $remark_quali_arr = $request->remark_qualification;
            $qlf_hiddenSqlid_arr =$request->qlf_hiddenSqlid;
            $data_qual_index=array();
            $data_qual=array();
            if($files=$request->file('qualification_file'))
            {   $ctr_qual_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                     $new_file_qual_name =$employee_id.date('ymdhis').$ctr_qual_img.'.'.$file_extenxion; 
                    $file->move(public_path().'/qualification/', $new_file_qual_name);  
                    $data_qual[$key]=$new_file_qual_name;
                    $data_qual_index[]=$key;
                    $ctr_qual_img++;
                }
            }

            if(count($quali_arr)>0)
            {
//print_r($quali_arr);exit();
                foreach($quali_arr as $ky=>$val)
                {

                 if($quali_arr[$ky]!="")
                   {
                     //print_r($quali_arr);exit();
                    if ($qlf_hiddenSqlid_arr[$ky]=="") 
                        {
                          if (in_array($ky,$data_qual_index))
                         {
                         $qlf_data_arr = array( 
                                        'SL_NO'=> $academic_snno[$ky],
                                        'emp_no'=> $employee_number,
                                        'qualification_level_code'=>$quali_arr[$ky],
                                        'emp_quali'=>$qualification_arr[$ky],
                                        'qualification_type'=>$type_qual[$ky],
                                        'stream_subject'=>$stream_arr[$ky],
                                        'institution'=>$board_arr[$ky],
                                        'year_passing'=>$year_arr[$ky],
                                        'mark_perc' => $per_mark_arr[$ky],
                                        'division' =>$division_quali_arr[$ky], 
                                        'remark_qualification'=>$remark_quali_arr[$ky],
                                        'upload'=>$data_qual[$ky]
                                        );
                          }
                          else
                          {
                           $qlf_data_arr = array( 
                            'SL_NO'=> $academic_snno[$ky],
                            'emp_no'=> $employee_number,
                                        'qualification_level_code'=>$quali_arr[$ky],
                                           'emp_quali'=>$qualification_arr[$ky],
                                        'qualification_type'=>$type_qual[$ky],
                                        'stream_subject'=>$stream_arr[$ky],
                                        'institution'=>$board_arr[$ky],
                                        'year_passing'=>$year_arr[$ky],
                                        'mark_perc' => $per_mark_arr[$ky],
                                        'division' =>$division_quali_arr[$ky], 
                                        'remark_qualification'=>$remark_quali_arr[$ky],
                                        
                               
                              ); 
                          }

                       $update_Data=DB::table('emp_qualification_dtl')
                        ->where('emp_no',  $employee_number)                      
                        ->insert($qlf_data_arr);
                      }
                      else{
                     
                      
                        if (in_array($ky,$data_qual_index)) {
                        $qlf_data_arr = array( 
                          'SL_NO'=> $academic_snno[$ky],
                                        'qualification_level_code'=>$quali_arr[$ky],
                                         'emp_quali'=>   $qualification_arr[$ky],
                                        // 'qualification_type'=>$type_qual[$ky],
                                        'stream_subject'=>$stream_arr[$ky],
                                        'institution'=>$board_arr[$ky],
                                        'year_passing'=>$year_arr[$ky],
                                        'mark_perc' => $per_mark_arr[$ky],
                                        'division' =>$division_quali_arr[$ky], 
                                        'remark_qualification'=>$remark_quali_arr[$ky],
                                        'upload'=>$data_qual[$ky]
                                        );
                       }
                       else
                       {
                         $qlf_data_arr = array( 
                          'SL_NO'=> $academic_snno[$ky],
                                        'qualification_level_code'=>$quali_arr[$ky],
                                         'emp_quali'=>   $qualification_arr[$ky],
                                         //'qualification_type'=>$type_qual[$ky],
                                        'stream_subject'=>$stream_arr[$ky],
                                        'institution'=>$board_arr[$ky],
                                        'year_passing'=>$year_arr[$ky],
                                        'mark_perc' => $per_mark_arr[$ky],
                                        'division' =>$division_quali_arr[$ky], 
                                        'remark_qualification'=>$remark_quali_arr[$ky],
                                       
                                        );                      
                       }
                     
                   
                        $update_Data=DB::table('emp_qualification_dtl')
                        ->where('emp_no',  $employee_number)
                        ->where('id',$qlf_hiddenSqlid_arr[$ky])

                        ->update($qlf_data_arr);  
                     
                      }
                    }

                }
            }
                       

            //antecedent
            
              $antecedent_slno=$request->antecedent_slno;
              $antecedent_order_arr=$request->ante_order_no;
              $antecedent_order_date_arr = $request->ante_order_date;
              $antecedent_type_arr = $request->ante_type;
              $w_e_e_arr = $request->ante_w_e_e;
              $w_e_t_arr = $request->ante_w_e_t;
              $remarks_ante_arr = $request->ante_remarks;
              $antecedent_sqlId_arr = $request->antecedent_sql_id;
              $antecedent_sql_empno = $request->antecedent_sql_empno;
              $data_ante_index=array();
              $data_ante=array();
              if($files=$request->file('antecedent_upload'))
              {   $ctr_ante_img=1;
                  foreach($files as $key => $file)
                  {
                      $name=$file->getClientOriginalName();
                      $file_extenxion = $file->getClientOriginalExtension();
                       $new_file_ante_name =$employee_id.date('ymdhis').$ctr_ante_img.'.'.$file_extenxion;
                      $file->move(public_path().'/antecedent/', $new_file_ante_name);  
                      $data_ante[$key]=$new_file_ante_name;
                      $data_ante_index[]=$key;
                      $ctr_ante_img++;
                  }
              }
              // 'emp_no'=>  $employee_id,$employee_number

            if(count($antecedent_order_arr)>0)
              {
                  foreach($antecedent_order_arr as $ky=>$val)
                  {
                      if($antecedent_order_arr[$ky]!="")
                      {
                  
                        if( $antecedent_sqlId_arr[$ky]=="")
                        {
                           if (in_array($ky,$data_ante_index))
                         {

                       $employee_antecedent_details_fetch =array( 
                        
                          'slno'=> $antecedent_slno[$ky],
                          'emp_no'=>  $employee_number,
                          'order_no'=> $antecedent_order_arr[$ky],
                          'order_date'=>$antecedent_order_date_arr[$ky],
                          'type'=> $antecedent_type_arr[$ky],
                          'WEE_date'=> $w_e_e_arr[$ky],
                          'WET_date'=> $w_e_t_arr[$ky], 
                          'remarks'=> $remarks_ante_arr[$ky],  
                          'upload'=>$data_ante[$ky] 
                           ); 
                       } 
                       else{
                        $employee_antecedent_details_fetch =array( 
                          'slno'=> $antecedent_slno[$ky],
                          'emp_no'=>  $employee_number,
                          'order_no'=> $antecedent_order_arr[$ky],
                          'order_date'=>$antecedent_order_date_arr[$ky],
                          'type'=> $antecedent_type_arr[$ky],
                          'WEE_date'=> $w_e_e_arr[$ky],
                          'WET_date'=> $w_e_t_arr[$ky], 
                          'remarks'=> $remarks_ante_arr[$ky],  
                         
                           ); 
                       } 

                        $update_Data=DB::table('emp_antecedent_dtl')
                        ->where('emp_no',  $employee_number)                      
                        ->insert( $employee_antecedent_details_fetch);
                      }
                        else
                        { if (in_array($ky,$data_ante_index)) {
                    
                           $employee_antecedent_details_fetch =array(   
                            'slno'=> $antecedent_slno[$ky],                      
                                    'order_no'=> $antecedent_order_arr[$ky],
                                    'order_date'=>$antecedent_order_date_arr[$ky],
                                    'type'=> $antecedent_type_arr[$ky],
                                    'WEE_date'=> $w_e_e_arr[$ky],
                                    'WET_date'=> $w_e_t_arr[$ky], 
                                    'remarks'=> $remarks_ante_arr[$ky],
                                    'upload'=>$data_ante[$ky]                            
                                   ); 
                         }else{
                           $employee_antecedent_details_fetch =array(  
                            'slno'=> $antecedent_slno[$ky],                       
                                    'order_no'=> $antecedent_order_arr[$ky],
                                    'order_date'=>$antecedent_order_date_arr[$ky],
                                    'type'=> $antecedent_type_arr[$ky],
                                    'WEE_date'=> $w_e_e_arr[$ky],
                                    'WET_date'=> $w_e_t_arr[$ky], 
                                    'remarks'=> $remarks_ante_arr[$ky]                          
                                   ); 
                         }
                         


                          $update_Data=DB::table('emp_antecedent_dtl')
                        ->where('emp_no',  $employee_number)
                        ->where('id',$antecedent_sqlId_arr[$ky])
                        ->update($employee_antecedent_details_fetch);
                        }
                        }
                   
                      }

                      
  
                  }

                  
            $experience_snno=$request->experience_snno;
            $org_arr=$request->orgn;
            $sector_arr = $request->sect;
            $position_arr = $request->pos;
            $start_date_arr = $request->from;
            $end_date_arr = $request->to;
            $reson_arr =$request->area;
             $remark_arr =$request->remark_area;
            $experience_sqlId_arr = $request->experience_sql_id;
          
            $upload_pic_index=array();
            $upload_pic=array();
            if($files=$request->file('e_file'))
            { $ctr_exper_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_exper_filename =$employee_id.date('ymdhis').$ctr_exper_img.'.'.$file_extenxion;
                    $file->move(public_path().'/experience/', $new_exper_filename);  
                    $upload_pic[$key]=$new_exper_filename;
                    $upload_pic_index[]=$key;
                    $ctr_exper_img++;
                }
            }

            if(count($org_arr)>0)
            {
                foreach($org_arr as $ky=>$val)
                {
                    if($org_arr[$ky]!="")
                    {
                      if( $experience_sqlId_arr[$ky]=="")
                        {
                          if (in_array($ky,$upload_pic_index)) 
                          {
                       $employee_experience_details_fetch =array( 
                         'SL_NO'=> $experience_snno[$ky],
                          'emp_no'=>  $employee_number,
                           'orgn_name'=> $org_arr[$ky],
                          'sector'=>$sector_arr[$ky],
                          'position'=> $position_arr[$ky],
                          'start_date'=> $start_date_arr[$ky],
                          'end_date'=> $end_date_arr[$ky],
                           'reason'=>  $reson_arr[$ky],
                           'remark_area' =>$remark_arr[$ky], 
                           'upload'=> $upload_pic[$ky],
                          //'upload_adhara'=> $remarks_ante_arr[$ky],   
                          ); 
                        }
                        else
                        {
                          $employee_experience_details_fetch =array( 
                            'SL_NO'=> $experience_snno[$ky],
                            'emp_no'=>  $employee_number,
                             'orgn_name'=> $org_arr[$ky],
                            'sector'=>$sector_arr[$ky],
                            'position'=> $position_arr[$ky],
                            'start_date'=> $start_date_arr[$ky],
                            'end_date'=> $end_date_arr[$ky],
                             'reason'=>  $reson_arr[$ky],
                             'remark_area' =>$remark_arr[$ky], 
                          );
                        }

                      $update_Data=DB::table('emp_experience_dtl')
                        ->where('emp_no',$employee_number)                      
                        ->insert( $employee_experience_details_fetch);
                      }
                      else{
                         if (in_array($ky,$upload_pic_index)) 
                         {
                          $employee_experience_details_fetch =array(   
                            'SL_NO'=> $experience_snno[$ky],                      
                          'orgn_name'=> $org_arr[$ky],
                          'sector'=>$sector_arr[$ky],
                          'position'=> $position_arr[$ky],
                          'start_date'=> $start_date_arr[$ky],
                          'end_date'=> $end_date_arr[$ky],
                           'reason'=>  $reson_arr[$ky],
                           'remark_area' =>$remark_arr[$ky], 
                           'upload'=> $upload_pic[$ky],
                         );
                       }
                       else
                       {
                       $employee_experience_details_fetch =array( 
                        'SL_NO'=> $experience_snno[$ky],                        
                          'orgn_name'=> $org_arr[$ky],
                          'sector'=>$sector_arr[$ky],
                          'position'=> $position_arr[$ky],
                          'start_date'=> $start_date_arr[$ky],
                          'end_date'=> $end_date_arr[$ky],
                           'reason'=>  $reson_arr[$ky],
                           'remark_area' =>$remark_arr[$ky], 
                           //'upload'=> $upload_pic[$ky],
                         );
                       }
                         $update_Exp_Data=DB::table('emp_experience_dtl')
                        ->where('emp_no',  $employee_number)
                        ->where('id',$experience_sqlId_arr[$ky])
                        ->update($employee_experience_details_fetch); 
                      }

                    }
                }
             }
//transfer
            $transfer_snno=$request->transfer_snno;   
            $trans_order_arr=$request->trans_order;
            $type_arr = $request->order_type;
            $transfer_ord_date_arr = $request->transfer_ord_date;
            $from_date_arr = $request->from_date;
            $to_date_arr = $request->to_date;
            $from_dept_arr =$request->f_dept;
            $to_dept_arr = $request->t_dept;
            $from_work_arr = $request->from_work;
            $to_work_arr = $request->to_work;
            $reson_arr =$request->ord_rea;
            $reamrks_arr = $request->reamrks;
            $transfer_sql_id =$request->transfer_sql_id;
            $upload_transfer_index=array();
            $upload_transfer=array();
            if($files=$request->file('trans_file'))
            {$ctr_trans_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_trans_filename =$employee_id.date('ymdhis').$ctr_trans_img.'.'.$file_extenxion;
                    $file->move(public_path().'/transfer/', $new_trans_filename);  
                    $upload_transfer[$key]=$new_trans_filename;
                    $upload_transfer_index[]=$key;
                    $ctr_trans_img++;
                }
            }
            if(count($trans_order_arr)>0)
            {
                foreach($trans_order_arr as $ky=>$val)
                {
                    if($trans_order_arr[$ky]!="")
                    {
       
                     if($transfer_sql_id[$ky]=="")
                        {
                          if (in_array($ky,$upload_transfer_index)) 
                          {
                       $employee_transfer_details_fetch =array( 
                        'SL_NO'=> $transfer_snno[$ky],
                          'emp_no'=>  $employee_number,
                           'tranfer_order_no'=> $trans_order_arr[$ky],
                          'type'=>$type_arr[$ky],
                          'trans_date'=> $transfer_ord_date_arr[$ky],
                          'from_date'=> $from_date_arr[$ky],
                          'to_date'=> $to_date_arr[$ky],
                           'from_dept'=>  $from_dept_arr[$ky],
                           'to_dept'=>$to_dept_arr[$ky],
                          'from_work'=> $from_work_arr[$ky],
                          'to_work'=> $to_work_arr[$ky],
                           'reason'=>  $reson_arr[$ky],
                           'remark'=>  $reamrks_arr[$ky],
                           'upload'=> $upload_transfer[$ky],
                           'created_at'=>date('Y-m-d h:i:s'),
                           'updated_at'=>date('Y-m-d h:i:s')
                        
                          //'upload_adhara'=> $remarks_ante_arr[$ky],   
                          ); 
                        }
                        else
                        {
                          $employee_transfer_details_fetch =array( 
                            'SL_NO'=> $transfer_snno[$ky],
                          'emp_no'=>  $employee_number,
                          'tranfer_order_no'=> $trans_order_arr[$ky],
                         'type'=>$type_arr[$ky],
                         'trans_date'=> $transfer_ord_date_arr[$ky],
                         'from_date'=> $from_date_arr[$ky],
                         'to_date'=> $to_date_arr[$ky],
                          'from_dept'=>  $from_dept_arr[$ky],
                          'to_dept'=>$to_dept_arr[$ky],
                         'from_work'=> $from_work_arr[$ky],
                         'to_work'=> $to_work_arr[$ky],
                          'reason'=>  $reson_arr[$ky],
                          'remark'=>  $reamrks_arr[$ky],
                         
                          'created_at'=>date('Y-m-d h:i:s'),
                          'updated_at'=>date('Y-m-d h:i:s')
                       
                         //'upload_adhara'=> $remarks_ante_arr[$ky],   
                         ); 
                        }

                      $update_Data=DB::table('emp_trnasfer_dtl')
                        ->where('emp_no',$employee_number)                      
                        ->insert( $employee_transfer_details_fetch);
                      }
                      else{
                         if (in_array($ky,$upload_transfer_index)) 
                         {
                          $employee_transfer_details_fetch =array(                         
                            'SL_NO'=> $transfer_snno[$ky],
                           'tranfer_order_no'=> $trans_order_arr[$ky],
                          'type'=>$type_arr[$ky],
                          'trans_date'=> $transfer_ord_date_arr[$ky],
                          'from_date'=> $from_date_arr[$ky],
                          'to_date'=> $to_date_arr[$ky],
                           'from_dept'=>  $from_dept_arr[$ky],
                           'to_dept'=>$to_dept_arr[$ky],
                          'from_work'=> $from_work_arr[$ky],
                          'to_work'=> $to_work_arr[$ky],
                          'reason'=>  $reson_arr[$ky],
                          'remark'=>  $reamrks_arr[$ky],
                           'upload'=> $upload_transfer[$ky],
                         );
                       }
                       else
                       {
                       $employee_transfer_details_fetch =array(                         
                        'SL_NO'=> $transfer_snno[$ky],
                           'tranfer_order_no'=> $trans_order_arr[$ky],
                          'type'=>$type_arr[$ky],
                          'trans_date'=> $transfer_ord_date_arr[$ky],
                          'from_date'=> $from_date_arr[$ky],
                          'to_date'=> $to_date_arr[$ky],
                           'from_dept'=>  $from_dept_arr[$ky],
                           'to_dept'=>$to_dept_arr[$ky],
                          'from_work'=> $from_work_arr[$ky],
                          'to_work'=> $to_work_arr[$ky],
                          'remark'=>  $reamrks_arr[$ky],
                           'reason'=>  $reson_arr[$ky],
                           //'upload'=> $upload_pic[$ky],
                         );
                       }
                         $update_Exp_Data=DB::table('emp_trnasfer_dtl')
                        ->where('emp_no',  $employee_number)
                        ->where('id',$transfer_sql_id[$ky])
                        ->update($employee_transfer_details_fetch); 
                      }
                    


                    }
                    

                }

              
             }

             
             $promo_slno=$request->promo_slno;           
$promo_order_arr=$request->promo_order_no;
            $promo_date_arr = $request->promo_date;
            $effect_date_arr = $request->effect_date;
            $from_grade_arr = $request->from_grade;
            $from_design_arr = $request->from_design;
            $from_basic_arr =$request->from_basic;
            $from_special_arr = $request->from_special;
            $from_other_special_arr = $request->from_other_special;
            $other_allowance_arr = $request->from_special;
            $to_grade_arr =$request->to_grade;
            $to_portion_arr = $request->to_portion;
            $to_basic_arr = $request->to_basic;
            $total_allow_arr = $request->total_allow;
            $to_other_allow_arr = $request->to_other_allowance;
            $remark_arr =$request->remark;
            $promotion_sql_id=$request->promotion_sql_id;
            $upload_promotion_index=array();
            $upload_promotion=array();
            if($files=$request->file('upload_promo'))
            {$ctr_promo_img=1;
                foreach($files as $key => $file)
                {
                    $name=$file->getClientOriginalName();
                    $file_extenxion = $file->getClientOriginalExtension();
                    $new_promo_filename =$employee_id.date('ymdhis').$ctr_promo_img.'.'.$file_extenxion;
                    $file->move(public_path().'/promotion/', $new_promo_filename);  
                    $upload_promotion[$key]=$new_promo_filename;
                    $upload_promotion_index[]=$key;
                    $ctr_promo_img++;
                }
            }

            if(count($promo_order_arr)>0)
            {
                foreach($promo_order_arr as $ky=>$val)
                {
                    if($promo_order_arr[$ky]!="")
                    {

                    if($promotion_sql_id[$ky]=="")
                        {
                        if (in_array($ky,$upload_promotion_index)) 
                          {
                       $employee_promotion_details_fetch =array( 
                        'SL_NO'=> $promo_slno[$ky],
                          'emp_no'=>  $employee_number,
                          'promotion_order_no'=> $promo_order_arr[$ky],
                          'promotion_date'=>$promo_date_arr[$ky],
                          'promotion_effect_date'=> $effect_date_arr[$ky],
                          'from_grade_code'=> $from_grade_arr[$ky],
                          'from_desg_code'=> $from_design_arr[$ky],
                          'from_basic_pay'=>  $from_basic_arr[$ky],
                          'special_allownace'=>$from_special_arr[$ky],
                          'other_special_allownace'=> $from_other_special_arr[$ky],
                          'to_grade_code'=> $to_grade_arr[$ky],
                          'to_portion'=>  $to_portion_arr[$ky],
                          'to_basic_pay'=> $to_basic_arr[$ky],
                          'total_allowance'=> $total_allow_arr[$ky],
                          'other_allowance'=>  $to_other_allow_arr[$ky],
                          'remark'=>$remark_arr[$ky], 
                          'upload'=>$upload_promotion[$ky],
                          'created_at'=>date('Y-m-d h:i:s'),
                          'updated_at'=>date('Y-m-d h:i:s')
                          ); 
                        }
                        else{
                          $employee_promotion_details_fetch =array( 
                            'SL_NO'=> $promo_slno[$ky],
                            'emp_no'=>  $employee_number,
                            'promotion_order_no'=> $promo_order_arr[$ky],
                            'promotion_date'=>$promo_date_arr[$ky],
                            'promotion_effect_date'=> $effect_date_arr[$ky],
                            'from_grade_code'=> $from_grade_arr[$ky],
                            'from_desg_code'=> $from_design_arr[$ky],
                            'from_basic_pay'=>  $from_basic_arr[$ky],
                            'special_allownace'=>$from_special_arr[$ky],
                            'other_special_allownace'=> $from_other_special_arr[$ky],
                            'to_grade_code'=> $to_grade_arr[$ky],
                            'to_portion'=>  $to_portion_arr[$ky],
                            'to_basic_pay'=> $to_basic_arr[$ky],
                            'total_allowance'=> $total_allow_arr[$ky],
                            'other_allowance'=>  $to_other_allow_arr[$ky],
                            'remark'=>$remark_arr[$ky], 
                            'created_at'=>date('Y-m-d h:i:s'),
                            'updated_at'=>date('Y-m-d h:i:s')
                            ); 
                        }

                      $update_Data=DB::table('employee_promotion_dtl')
                        ->where('emp_no',$employee_number)                      
                        ->insert( $employee_promotion_details_fetch);
                      }
                      else{
                         if (in_array($ky,$upload_promotion_index)) 
                         {
                          $employee_promotion_details_fetch =array(                         
                          'SL_NO'=> $promo_slno[$ky],
                          'promotion_order_no'=> $promo_order_arr[$ky],
                          'promotion_date'=>$promo_date_arr[$ky],
                          'promotion_effect_date'=> $effect_date_arr[$ky],
                          'from_grade_code'=> $from_grade_arr[$ky],
                          'from_desg_code'=> $from_design_arr[$ky],
                          'from_basic_pay'=>  $from_basic_arr[$ky],
                          'special_allownace'=>$from_special_arr[$ky],
                          'other_special_allownace'=> $from_other_special_arr[$ky],
                          'to_grade_code'=> $to_grade_arr[$ky],
                          'to_portion'=>  $to_portion_arr[$ky],
                          'to_basic_pay'=> $to_basic_arr[$ky],
                          'total_allowance'=> $total_allow_arr[$ky],
                          'other_allowance'=>  $to_other_allow_arr[$ky],
                          'remark'=>$remark_arr[$ky], 
                          'upload'=>$upload_promotion[$ky]
                         );
                       }
                       else
                       {
                       $employee_promotion_details_fetch =array(                         
                        'SL_NO'=> $promo_slno[$ky],
                          'promotion_order_no'=> $promo_order_arr[$ky],
                          'promotion_date'=>$promo_date_arr[$ky],
                          'promotion_effect_date'=> $effect_date_arr[$ky],
                          'from_grade_code'=> $from_grade_arr[$ky],
                          'from_desg_code'=> $from_design_arr[$ky],
                          'from_basic_pay'=>  $from_basic_arr[$ky],
                          'special_allownace'=>$from_special_arr[$ky],
                          'other_special_allownace'=> $from_other_special_arr[$ky],
                          'to_grade_code'=> $to_grade_arr[$ky],
                          'to_portion'=>  $to_portion_arr[$ky],
                          'to_basic_pay'=> $to_basic_arr[$ky],
                          'total_allowance'=> $total_allow_arr[$ky],
                          'other_allowance'=>  $to_other_allow_arr[$ky],
                          'remark'=>$remark_arr[$ky], 
                         );
                       }
                         $update_Exp_Data=DB::table('employee_promotion_dtl')
                        ->where('emp_no',  $employee_number)
                        ->where('id',$promotion_sql_id[$ky])
                        ->update($employee_promotion_details_fetch); 
                      }
                    
                    }
                    

                }
              }
            //Revocation table add//  
            
        $revo_slno=$request->revo_slno;
        $revocation_order_arr=$request->revo_order_no;
        $revocation_order_date_arr = $request->revo_order_date;
        $ant_ord_no_arr = $request->ant_ord_no;
        $ant_ord_dat_arr = $request->ant_ord_dat; 
        $ant_ord_type_arr = $request->ant_ord_type;
        $ant_WEF_arr = $request->ant_WEF;
        $ant_WET_arr = $request->ant_WET;
        $revo_effected_date_arr = $request->revo_effected_date;
        $revo_remark_arr = $request->revo_remark;
        $revocation_sqlId_arr = $request->revocation_sql_id; 
         $data_revo_index=array();
         $data_revo=array();
              if($files=$request->file('revocation_upload'))
              {   $ctr_revo_img=1;
                  foreach($files as $key => $file)
                  {
                      $name=$file->getClientOriginalName();
                      $file_extenxion = $file->getClientOriginalExtension();
                      $new_file_revo_name =$employee_id.date('ymdhis').$ctr_revo_img.'.'.$file_extenxion;
                      $file->move(public_path().'/revocation/', $new_file_revo_name);  
                      $data_revo[$key]=$new_file_revo_name;
                      $data_revo_index[]=$key;
                      $ctr_revo_img++;
                  }
              }
        if(count($revocation_order_arr)>0)
        {
        foreach($revocation_order_arr as $ky=>$val)
        {
        if($revocation_order_arr[$ky]!="")
        {
        
        if( $revocation_sqlId_arr[$ky]=="")
        {
         if (in_array($ky,$data_revo_index))
          {
        $employee_revocation_details_fetch =array(
          'slno'=> $revo_slno[$ky],
        'emp_no'=> $employee_number,
        'revocation_order_no'=> $revocation_order_arr[$ky],
        'revocation_order_date'=>$revocation_order_date_arr[$ky],
        'antecedent_order_no'=> $ant_ord_no_arr[$ky],
        'antecedent_order_date'=> $ant_ord_dat_arr[$ky],
        'antecedent_type'=> $ant_ord_type_arr[$ky],
        'antecedent_WEE_date'=> $ant_WEF_arr[$ky],
        'antecedent_WET_date'=> $ant_WET_arr[$ky],
        'revocation_effected_date'=> $revo_effected_date_arr[$ky],
        'remarks'=> $revo_remark_arr[$ky],
        'upload' =>  $data_revo[$ky],
        'created_at'=>date('Y-m-d h:i:s'),
        'updated_at'=>date('Y-m-d h:i:s')
        );
        }
        else
        {
          $employee_revocation_details_fetch =array(
            'slno'=> $revo_slno[$ky],
        'emp_no'=> $employee_number,
        'revocation_order_no'=> $revocation_order_arr[$ky],
        'revocation_order_date'=>$revocation_order_date_arr[$ky],
        'antecedent_order_no'=> $ant_ord_no_arr[$ky],
        'antecedent_order_date'=> $ant_ord_dat_arr[$ky],
        'antecedent_type'=> $ant_ord_type_arr[$ky],
        'antecedent_WEE_date'=> $ant_WEF_arr[$ky],
        'antecedent_WET_date'=> $ant_WET_arr[$ky],
        'revocation_effected_date'=> $revo_effected_date_arr[$ky],
        'remarks'=> $revo_remark_arr[$ky],
        'created_at'=>date('Y-m-d h:i:s'),
        'updated_at'=>date('Y-m-d h:i:s')
        );
        }
        
        $update_Datarevocation=DB::table('emp_revocation_dtl')
        ->where('emp_no', $employee_number)
        ->insert( $employee_revocation_details_fetch);
        }
        else
        {
            if (in_array($ky,$data_revo_index)) 
            {
       $employee_revocation_details_fetch =array(
        'slno'=> $revo_slno[$ky],
            'emp_no'=> $employee_number,
            'revocation_order_no'=> $revocation_order_arr[$ky],
            'revocation_order_date'=>$revocation_order_date_arr[$ky],
            'antecedent_order_no'=> $ant_ord_no_arr[$ky],
            'antecedent_order_date'=> $ant_ord_dat_arr[$ky],
            'antecedent_type'=> $ant_ord_type_arr[$ky],
            'antecedent_WEE_date'=> $ant_WEF_arr[$ky],
            'antecedent_WET_date'=> $ant_WET_arr[$ky],
            'revocation_effected_date'=> $revo_effected_date_arr[$ky],
            'remarks'=> $revo_remark_arr[$ky],
             'upload' =>  $data_revo[$ky],
        );   
         }
         else
         {
           $employee_revocation_details_fetch =array(
            'slno'=> $revo_slno[$ky],
            'emp_no'=> $employee_number,
            'revocation_order_no'=> $revocation_order_arr[$ky],
            'revocation_order_date'=>$revocation_order_date_arr[$ky],
            'antecedent_order_no'=> $ant_ord_no_arr[$ky],
            'antecedent_order_date'=> $ant_ord_dat_arr[$ky],
            'antecedent_type'=> $ant_ord_type_arr[$ky],
            'antecedent_WEE_date'=> $ant_WEF_arr[$ky],
            'antecedent_WET_date'=> $ant_WET_arr[$ky],
            'revocation_effected_date'=> $revo_effected_date_arr[$ky],
            'remarks'=> $revo_remark_arr[$ky],
            
        );   

         }
        $update_Datarevocation=DB::table('emp_revocation_dtl')
        ->where('emp_no', $employee_number)
        ->where('id',$revocation_sqlId_arr[$ky])
        ->update($employee_revocation_details_fetch);
      
        }
        
        }
        }
      } 
      // contract upadated
      
          $cont_slno=$request->cont_slno;
          $contract_order_arr=$request->cont_order;
          $cont_order_date = $request->cont_order_date;
          $contract_start_date_arr = $request->cont_start_date;
          $contract_end_date_arr = $request->cont_end_date;
          $con_pay_arr = $request->con_pay;
          $special_arr = $request->special;
          $other_arr =$request->other;
          $remarks_cont_arr = $request->remarks;
          $sqli_cont_arr = $request->contract_sqli_id;
          $upload_cont=array();
          $upload_contract_index=array();
          if($files=$request->file('cont_file'))
          {
            $ctr_cont_img=1;
              foreach($files as $key => $file)
              {
                  $name=$file->getClientOriginalName();
                  $file_extenxion = $file->getClientOriginalExtension();
                  $new_cont_filename =$employee_id.date('ymdhis').$ctr_cont_img.'.'.$file_extenxion;
                  $file->move(public_path().'/contract/', $new_cont_filename);  
                  $upload_cont[$key]=$new_cont_filename;
                  $upload_contract_index[]=$key;


                  $ctr_cont_img++;
              }
          }
          if(count($contract_order_arr)>0)
          {
              foreach($contract_order_arr as $ky=>$val)
              {
                  if($contract_order_arr[$ky]!="")
                  {
                    if($sqli_cont_arr[$ky]=="")
                    {
                      if (in_array($ky,$upload_contract_index))
                      {
                    $employee_contract_fetch =array(
                    'Sl_NO'=> $cont_slno[$ky],
                    'emp_no'=> $employee_number,
                    'cont_order_no'=> $contract_order_arr[$ky],
                    'cont_order_date'=> $cont_order_date[$ky],
                    'cont_start_date'=>$contract_start_date_arr[$ky],
                    'cont_end_date'=> $contract_end_date_arr[$ky],
                    'sal'=> $con_pay_arr[$ky],
                    'special_allowance'=> $special_arr[$ky],
                    'other_allowance'=> $other_arr[$ky],
                    'remarks'=>$remarks_cont_arr[$ky],
                    'upload'=> $upload_cont[$ky],
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                    );
                  }
                  else{
                    $employee_contract_fetch =array(
                      'Sl_NO'=> $cont_slno[$ky],
                      'emp_no'=> $employee_number,
                      'cont_order_no'=> $contract_order_arr[$ky],
                      'cont_order_date'=> $cont_order_date[$ky],
                      'cont_start_date'=>$contract_start_date_arr[$ky],
                      'cont_end_date'=> $contract_end_date_arr[$ky],
                      'sal'=> $con_pay_arr[$ky],
                      'special_allowance'=> $special_arr[$ky],
                      'other_allowance'=> $other_arr[$ky],
                      'remarks'=>$remarks_cont_arr[$ky],
                       'created_at'=>date('Y-m-d h:i:s'),
                      'updated_at'=>date('Y-m-d h:i:s')
                      );
                  }
    
                    $update_contractdata=DB::table('emp_contract_dtl')
                    ->where('emp_no',$employee_number)
                    ->insert( $employee_contract_fetch);
                    }
                    else{
                      if (in_array($ky,$upload_contract_index))
                      {
                      $employee_contract_fetch =array(
                        'Sl_NO'=> $cont_slno[$ky],
                        'cont_order_no'=> $contract_order_arr[$ky],
                        'cont_order_date'=> $cont_order_date[$ky],
                        'cont_start_date'=>$contract_start_date_arr[$ky],
                        'cont_end_date'=> $contract_end_date_arr[$ky],
                        'sal'=> $con_pay_arr[$ky],
                        'special_allowance'=> $special_arr[$ky],
                        'other_allowance'=> $other_arr[$ky],
                        'remarks'=>$remarks_cont_arr[$ky],
                        'upload'=> $upload_cont[$ky],
                      );
                      }
                      else
                      {
                      $employee_contract_fetch =array(
                        'Sl_NO'=> $cont_slno[$ky],
                        'cont_order_no'=> $contract_order_arr[$ky],
                        'cont_order_date'=> $cont_order_date[$ky],
                        'cont_start_date'=>$contract_start_date_arr[$ky],
                        'cont_end_date'=> $contract_end_date_arr[$ky],
                        'sal'=> $con_pay_arr[$ky],
                        'special_allowance'=> $special_arr[$ky],
                        'other_allowance'=> $other_arr[$ky],
                        'remarks'=>$remarks_cont_arr[$ky],
                      );
                      }
                      $update_contractdata=DB::table('emp_contract_dtl')
                      ->where('emp_no', $employee_number)
                      ->where('id',$sqli_cont_arr[$ky])
                      ->update($employee_contract_fetch);
                      }

                  }
                  

              }

          }
          //contract end
           //probation updated start
           
           $prob_slno=$request->prob_slno;
           $prob_order_arr=$request->prob_order;
           $prob_order_date = $request->prob_order_date;
           $prob_start_date_arr = $request->prob_start;
           $prob_end_date_arr = $request->prob_end;
           $pay_grade_arr = $request->pay_grade1;
           $initial_basic_arr = $request->initial;
           $special_allowance_arr =$request->special_allowance;
           $other_allownace_arr = $request->other_allownace;
           $remark_prob_arr =$request->remark_prob;
           $sqliprob_arr =$request->prob_sqli_id;
           $upload_prohabation_index=array();
           $upload_prob=array();
           if($files=$request->file('prob_upload'))
           {$ctr_prob_img=1;
               foreach($files as $key => $file)
               {
                   $name=$file->getClientOriginalName();
                   $file_extenxion = $file->getClientOriginalExtension();
                   $new_prob_filename =$employee_id.date('ymdhis').$ctr_prob_img.'.'.$file_extenxion;
                   $file->move(public_path().'/probation/', $new_prob_filename);  
                   $upload_prob[$key]=$new_prob_filename;
                   $upload_prohabation_index[]=$key;
                   $ctr_prob_img++;
               }
           }
 
     
           if(count($prob_order_arr)>0)
           {
               foreach($prob_order_arr as $ky=>$val)
               {
                   if($prob_order_arr[$ky]!="")
                   {
                     if($sqliprob_arr[$ky]=="")
                     {
                      if (in_array($ky,$upload_prohabation_index))
                      {
                     $employee_probation_fetch =array(
                     'SL_NO'=> $prob_slno[$ky],
                     'emp_no'=> $employee_number,
                     'prob_order_no'=> $prob_order_arr[$ky],
                     'prob_order_date'=> $prob_order_date[$ky],
                     'prob_start_date'=>$prob_start_date_arr[$ky],
                     'prob_end_date'=> $prob_end_date_arr[$ky],
                     'pay_grade'=> $pay_grade_arr[$ky],
                     'intial_basic'=> $initial_basic_arr[$ky],
                     'special_allowance'=> $special_allowance_arr[$ky],
                     'other_allowance'=>$other_allownace_arr[$ky],
                     'remarks'=>$remark_prob_arr[$ky],
                     'upload'=> $upload_prob[$ky],
                     'created_at'=>date('Y-m-d h:i:s'),
                     'updated_at'=>date('Y-m-d h:i:s')
                     );
                    }else{
                      $employee_probation_fetch =array(
                        'SL_NO'=> $prob_slno[$ky],
                        'emp_no'=> $employee_number,
                        'prob_order_no'=> $prob_order_arr[$ky],
                        'prob_order_date'=> $prob_order_date[$ky],
                        'prob_start_date'=>$prob_start_date_arr[$ky],
                        'prob_end_date'=> $prob_end_date_arr[$ky],
                        'pay_grade'=> $pay_grade_arr[$ky],
                        'intial_basic'=> $initial_basic_arr[$ky],
                        'special_allowance'=> $special_allowance_arr[$ky],
                        'other_allowance'=>$other_allownace_arr[$ky],
                        'remarks'=>$remark_prob_arr[$ky],
                        
                        'created_at'=>date('Y-m-d h:i:s'),
                        'updated_at'=>date('Y-m-d h:i:s')
                        );

                    }
     
                     $update_probationdata=DB::table('emp_probation_dtl')
                     ->where('emp_no',$employee_number)
                     ->insert( $employee_probation_fetch);
                     }
                     else{
                       if (in_array($ky,$upload_prohabation_index))
                       {
                       $employee_probation_fetch =array(
                        'SL_NO'=> $prob_slno[$ky],
                         'prob_order_no'=> $prob_order_arr[$ky],
                         'prob_order_date'=> $prob_order_date[$ky],
                         'prob_start_date'=>$prob_start_date_arr[$ky],
                         'prob_end_date'=> $prob_end_date_arr[$ky],
                         'pay_grade'=> $pay_grade_arr[$ky],
                         'intial_basic'=> $initial_basic_arr[$ky],
                         'special_allowance'=> $special_allowance_arr[$ky],
                         'other_allowance'=>$other_allownace_arr[$ky],
                         'remarks'=>$remark_prob_arr[$ky],
                         'upload'=> $upload_prob[$ky],
                       );
                       }
                       else
                       {
                       $employee_probation_fetch =array(
                        'SL_NO'=> $prob_slno[$ky],
                         'prob_order_no'=> $prob_order_arr[$ky],
                         'prob_order_date'=> $prob_order_date[$ky],
                         'prob_start_date'=>$prob_start_date_arr[$ky],
                         'prob_end_date'=> $prob_end_date_arr[$ky],
                         'pay_grade'=> $pay_grade_arr[$ky],
                         'intial_basic'=> $initial_basic_arr[$ky],
                         'special_allowance'=> $special_allowance_arr[$ky],
                         'other_allowance'=>$other_allownace_arr[$ky],
                         'remarks'=>$remark_prob_arr[$ky],
                       );
                       }
                       $update_probationdata=DB::table('emp_probation_dtl')
                       ->where('emp_no', $employee_number)
                       ->where('id',$sqliprob_arr[$ky])
                       ->update($employee_probation_fetch);
                       }
 
                   }
                   
 
               }
 
           }
           //end probation
            // intiation upadated
            $intiation_slno=$request->intiation_slno;
            $initiative_date_arr=$request->initiative_date;
            $inti_type_arr = $request->inti_type;
            $inti_description_arr = $request->inti_description;
            $inti_remark_arr = $request->inti_remark;
            $sqliinti_arr =$request->intiation_sql_id;
          $upload_inti=array();
          $upload_initiative_index=array();
          if($files=$request->file('Initiative_upload'))
          {
            $ctr_inti_img=1;
              foreach($files as $key => $file)
              {
                  $name=$file->getClientOriginalName();
                  $file_extenxion = $file->getClientOriginalExtension();
                  $new_inti_filename =$employee_id.date('ymdhis').$ctr_inti_img.'.'.$file_extenxion;
                  $file->move(public_path().'/Initiative/', $new_inti_filename);  
                  $upload_inti[$key]=$new_inti_filename;
                  $upload_initiative_index[]=$key;


                  $ctr_inti_img++;
              }
          }
          if(count($initiative_date_arr)>0)
          {
              foreach($initiative_date_arr as $ky=>$val)
              {
                  if($initiative_date_arr[$ky]!="")
                  {
                    if($sqliinti_arr[$ky]=="")
                    {
                      if (in_array($ky,$upload_initiative_index))
                      {
                    $employee_initiative_fetch =array(
                    'slno'=> $intiation_slno[$ky],
                    'emp_no'=> $employee_number,
                    'initiative_date'=> $initiative_date_arr[$ky],
                    'type'=>$inti_type_arr[$ky],
                    'description'=> $inti_description_arr[$ky],
                    'remark'=> $inti_remark_arr[$ky],
                     'upload'=> $upload_inti[$ky],
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                    );
                  }
                  else{
                     $employee_initiative_fetch =array(
                      'slno'=> $intiation_slno[$ky],
                    'emp_no'=> $employee_number,
                    'initiative_date'=> $initiative_date_arr[$ky],
                    'type'=>$inti_type_arr[$ky],
                    'description'=> $inti_description_arr[$ky],
                    'remark'=> $inti_remark_arr[$ky],
                       'created_at'=>date('Y-m-d h:i:s'),
                      'updated_at'=>date('Y-m-d h:i:s')
                      );
                  }
    
                    $update_initiativedata=DB::table('emp_initiation_dtl')
                    ->where('emp_no',$employee_number)
                    ->insert( $employee_initiative_fetch);
                    }
                    else{
                      if (in_array($ky,$upload_initiative_index))
                      {
                      $employee_initiative_fetch =array(
                        'slno'=> $intiation_slno[$ky],
                    'emp_no'=> $employee_number,
                    'initiative_date'=> $initiative_date_arr[$ky],
                    'type'=>$inti_type_arr[$ky],
                    'description'=> $inti_description_arr[$ky],
                    'remark'=> $inti_remark_arr[$ky],
                     'upload'=> $upload_inti[$ky],
                       'created_at'=>date('Y-m-d h:i:s'),
                      'updated_at'=>date('Y-m-d h:i:s')
                      );
                      }
                      else
                      {
                       $employee_initiative_fetch =array(
                        'slno'=> $intiation_slno[$ky],
                    'emp_no'=> $employee_number,
                    'initiative_date'=> $initiative_date_arr[$ky],
                    'type'=>$inti_type_arr[$ky],
                    'description'=> $inti_description_arr[$ky],
                    'remark'=> $inti_remark_arr[$ky],
                       'created_at'=>date('Y-m-d h:i:s'),
                      'updated_at'=>date('Y-m-d h:i:s')
                      );
                    
                      }
                      $update_initiativedata=DB::table('emp_initiation_dtl')
                      ->where('emp_no', $employee_number)
                      ->where('id',$sqliinti_arr[$ky])
                      ->update($employee_initiative_fetch);
                      }

                  }
                  

              }

          }
          //intiation end

           // achievement upadated
           
           $achievement_slno=$request->achievement_slno;
            $achievement_date_arr=$request->achievement_date;
            $achievement_type_arr = $request->achievement_type;
            $achievement_description_arr = $request->achievement_period;
            $achievement_remark_arr = $request->achievement_remark;
            $sqlachievement_arr =$request->Achievement_sql_id;
          $upload_achi=array();
          $upload_achievement_index=array();
          if($files=$request->file('achievement_upload'))
          {
            $ctr_achi_img=1;
              foreach($files as $key => $file)
              {
                  $name=$file->getClientOriginalName();
                  $file_extenxion = $file->getClientOriginalExtension();
                  $new_achi_filename =$employee_id.date('ymdhis').$ctr_achi_img.'.'.$file_extenxion;
                  $file->move(public_path().'/achievement/', $new_achi_filename);  
                  $upload_achi[$key]=$new_achi_filename;
                  $upload_achievement_index[]=$key;


                  $ctr_achi_img++;
              }
          }
          if(count($achievement_date_arr)>0)
          {
              foreach($achievement_date_arr as $ky=>$val)
              {
                  if($achievement_date_arr[$ky]!="")
                  {
                    if($sqlachievement_arr[$ky]=="")
                    {
                      if (in_array($ky,$upload_achievement_index))
                      {
                    $employee_achievement_fetch =array(
                    'slno'=>  $achievement_slno[$ky],
                    'emp_no'=> $employee_number,
                    'achievement_date'=> $achievement_date_arr[$ky],
                    'achievement_type'=>$achievement_type_arr[$ky],
                    'achievement_period'=> $achievement_description_arr[$ky],
                    'remark'=> $achievement_remark_arr[$ky],
                     'upload'=> $upload_achi[$ky],
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                    );
                  }
                  else{
                     $employee_achievement_fetch =array(
                    'slno'=>  $achievement_slno[$ky],
                    'emp_no'=> $employee_number,
                    'achievement_date'=> $achievement_date_arr[$ky],
                    'achievement_type'=>$achievement_type_arr[$ky],
                    'achievement_period'=> $achievement_description_arr[$ky],
                    'remark'=> $achievement_remark_arr[$ky],
                     //'upload'=> $upload_achi[$ky],
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                      );
                  }
    
                    $update_achievementdata=DB::table('emp_achievement_dtl')
                    ->where('emp_no',$employee_number)
                    ->insert( $employee_achievement_fetch);
                    }
                    else{
                      if (in_array($ky,$upload_achievement_index))
                      {
                      $employee_achievement_fetch =array(
                     'slno'=>  $achievement_slno[$ky],
                    'emp_no'=> $employee_number,
                    'achievement_date'=> $achievement_date_arr[$ky],
                    'achievement_type'=>$achievement_type_arr[$ky],
                    'achievement_period'=> $achievement_description_arr[$ky],
                    'remark'=> $achievement_remark_arr[$ky],
                     'upload'=> $upload_achi[$ky],
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                      );
                      }
                      else
                      {
                      $employee_achievement_fetch =array(
                     'slno'=>  $achievement_slno[$ky],
                    'emp_no'=> $employee_number,
                      'achievement_date'=> $achievement_date_arr[$ky],
                    'achievement_type'=>$achievement_type_arr[$ky],
                    'achievement_period'=> $achievement_description_arr[$ky],
                    'remark'=> $achievement_remark_arr[$ky],
                    // 'upload'=> $upload_achi[$ky],
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s')
                      );
                  
                    
                      }
                      $update_achievementdata=DB::table('emp_achievement_dtl')
                      ->where('emp_no', $employee_number)
                      ->where('id',$sqlachievement_arr[$ky])
                      ->update($employee_achievement_fetch);
                      }

                  }
                  

              }

          }
          //appreciation upadted
          
           $app_slno=$request->app_slno;
           $appreciation_order_arr=$request->app_order_no;
           $appreciation_order_date_arr = $request->app_order_date;
           $appreciationtype_arr = $request->appreciation_type;
           $apprecommended_arr = $request->recommended_by; 
           $appdescription_arr = $request->app_description;
           $appremark_arr = $request->app_remarks;
           $sqliapp_arr =$request->appr_sqli_id;
           $upload_appreciation_index=array();
           $upload_revo_arr=array();
               if($files=$request->file('appriciation_upload'))
               {$ante_revo_img=1;
                   foreach($files as $key => $file)
                   {
                       $name=$file->getClientOriginalName();
                       $file_extenxion = $file->getClientOriginalExtension();
                       $new_revo_filename =$employee_id.date('ymdhis').$ante_revo_img.'.'.$file_extenxion;
                       $file->move(public_path().'/appreciation/', $new_revo_filename);  
                       $upload_revo_arr[$key]=$new_revo_filename;
                       $upload_appreciation_index[]=$key;
                       $ante_revo_img++;
                   }
               }
               if(count($appreciation_order_arr)>0)
               {
                   foreach($appreciation_order_arr as $ky=>$val)
                   {
                       if($appreciation_order_arr[$ky]!="")
                       {
                        if($sqliapp_arr[$ky]=="")
                        {
                         if (in_array($ky,$upload_appreciation_index))
                         {
                          $employee_appreciation_fetch =array(
                            'slno'=> $app_slno[$ky],
                            'emp_no'=> $employee_number,
                            'order_no'=> $appreciation_order_arr[$ky],
                            'order_date'=>$appreciation_order_date_arr[$ky],
                            'appreciation_type'=> $appreciationtype_arr[$ky],
                            'recommended_by'=> $apprecommended_arr[$ky],
                            'app_description'=> $appdescription_arr[$ky],
                            'app_remarks'=> $appremark_arr[$ky],
                            'upload'=> $upload_revo_arr[$ky],
                            'created_at'=>date('Y-m-d h:i:s'),
                            'updated_at'=>date('Y-m-d h:i:s')
                          ); 
                         }else{
                          $employee_appreciation_fetch =array(
                            'slno'=> $app_slno[$ky],
                            'emp_no'=> $employee_number,
                            'order_no'=> $appreciation_order_arr[$ky],
                            'order_date'=>$appreciation_order_date_arr[$ky],
                            'appreciation_type'=> $appreciationtype_arr[$ky],
                            'recommended_by'=> $apprecommended_arr[$ky],
                            'app_description'=> $appdescription_arr[$ky],
                            'app_remarks'=> $appremark_arr[$ky],
                            'created_at'=>date('Y-m-d h:i:s'),
                            'updated_at'=>date('Y-m-d h:i:s')
                          
                          ); 
                         }
                         $update_probationdata=DB::table('emp_appreciation')
                         ->where('emp_no',$employee_id)
                         ->insert( $employee_appreciation_fetch);
                        }else{
                          if (in_array($ky,$upload_appreciation_index))
                          {
                            $employee_appreciation_fetch =array(
                              'slno'=> $app_slno[$ky],
                              'order_no'=> $appreciation_order_arr[$ky],
                              'order_date'=>$appreciation_order_date_arr[$ky],
                              'appreciation_type'=> $appreciationtype_arr[$ky],
                              'recommended_by'=> $apprecommended_arr[$ky],
                              'app_description'=> $appdescription_arr[$ky],
                              'app_remarks'=> $appremark_arr[$ky],
                              'upload'=> $upload_revo_arr[$ky],
                            
                            );  
                          }else{
                            $employee_appreciation_fetch =array(
                              'slno'=> $app_slno[$ky],
                              'order_no'=> $appreciation_order_arr[$ky],
                              'order_date'=>$appreciation_order_date_arr[$ky],
                              'appreciation_type'=> $appreciationtype_arr[$ky],
                              'recommended_by'=> $apprecommended_arr[$ky],
                              'app_description'=> $appdescription_arr[$ky],
                              'app_remarks'=> $appremark_arr[$ky],
                            );  
                          }
                      
                          $update_appreciationdata=DB::table('emp_appreciation')
                          ->where('emp_no', $employee_number)
                          ->where('id',$sqliapp_arr[$ky])
                          ->update($employee_appreciation_fetch);
                        }
                        
                       }
                       
   
                   }
   
               } 
             
               //reward upadted
               
            $reward_slno=$request->reward_slno;
            $sqliapp_arr=$request->reward_sqli_id;
            $appreciation_order_arr=$request->reorder_no;
            $appreciation_order_date_arr = $request->reorder_date;
            $appreciationtype_arr = $request->reward_type;
            $apprecommended_arr = $request->re_recommended_by; 
            $appdescription_arr = $request->re_description;
            $appremark_arr = $request->re_remarks;
            $upload_appreciation_index=array();
            $upload_revo_arr=array();
                if($files=$request->file('remark_upload'))
                {$ante_revo_img=1;
                    foreach($files as $key => $file)
                    {
                        $name=$file->getClientOriginalName();
                        $file_extenxion = $file->getClientOriginalExtension();
                        $new_revo_filename =$employee_id.date('ymdhis').$ante_revo_img.'.'.$file_extenxion;
                        $file->move(public_path().'/reward/', $new_revo_filename);  
                        $upload_revo_arr[$key]=$new_revo_filename;
                        $upload_appreciation_index[]=$key;
                        $ante_revo_img++;
                    }
                }
                if(count($appreciation_order_arr)>0)
                {
                    foreach($appreciation_order_arr as $ky=>$val)
                    {
                        if($appreciation_order_arr[$ky]!="")
                        {
                          if($sqliapp_arr[$ky]=="")
                          {
                           if (in_array($ky,$upload_appreciation_index))
                           {
                            $employee_reward_fetch =array(
                              'slno'=> $reward_slno[$ky],
                              'emp_no'=> $employee_number,
                              'reorder_no'=> $appreciation_order_arr[$ky],
                              'reorder_date'=>$appreciation_order_date_arr[$ky],
                              'reward_type'=> $appreciationtype_arr[$ky],
                              're_recommended_by'=> $apprecommended_arr[$ky],
                              're_description'=> $appdescription_arr[$ky],
                              're_remarks'=> $appremark_arr[$ky],
                              'upload'=> $upload_revo_arr[$ky],
                              'created_at'=>date('Y-m-d h:i:s'),
                              'updated_at'=>date('Y-m-d h:i:s')
                            
                            ); 
                           }else{
                            $employee_reward_fetch =array(
                              'slno'=> $reward_slno[$ky],
                              'emp_no'=> $employee_number,
                              'reorder_no'=> $appreciation_order_arr[$ky],
                              'reorder_date'=>$appreciation_order_date_arr[$ky],
                              'reward_type'=> $appreciationtype_arr[$ky],
                              're_recommended_by'=> $apprecommended_arr[$ky],
                              're_description'=> $appdescription_arr[$ky],
                              're_remarks'=> $appremark_arr[$ky],
                              'created_at'=>date('Y-m-d h:i:s'),
                              'updated_at'=>date('Y-m-d h:i:s')
                            
                            ); 
                           }
                           $update_probationdata=DB::table('emp_reward')
                           ->where('emp_no',$employee_number)
                           ->insert( $employee_reward_fetch);
                          }else{
                            if (in_array($ky,$upload_appreciation_index))
                          {
                            $employee_reward_fetch =array(
                              'slno'=> $reward_slno[$ky],
                              'reorder_no'=> $appreciation_order_arr[$ky],
                              'reorder_date'=>$appreciation_order_date_arr[$ky],
                              'reward_type'=> $appreciationtype_arr[$ky],
                              're_recommended_by'=> $apprecommended_arr[$ky],
                              're_description'=> $appdescription_arr[$ky],
                              're_remarks'=> $appremark_arr[$ky],
                              'upload'=> $upload_revo_arr[$ky],
                            
                            );  
                          }else{
                            $employee_reward_fetch =array(
                              'slno'=> $reward_slno[$ky],
                              'reorder_no'=> $appreciation_order_arr[$ky],
                              'reorder_date'=>$appreciation_order_date_arr[$ky],
                              'reward_type'=> $appreciationtype_arr[$ky],
                              're_recommended_by'=> $apprecommended_arr[$ky],
                              're_description'=> $appdescription_arr[$ky],
                              're_remarks'=> $appremark_arr[$ky],
                            );  
                          }
                          $update_appreciationdata=DB::table('emp_reward')
                          ->where('emp_no', $employee_number)
                          ->where('id',$sqliapp_arr[$ky])
                          ->update($employee_reward_fetch);
                        }
                        
                      }
                    }
    
                } 
                   //appreciation end  
                   //appreciation end  

          //intiation end

 // remark upadated
 $remark_slno=$request->remark_slno;
 $remark_text=$request->remark_text;
 $remark_sql_id =$request->remark_sql_id;
$upload_remark=array();
$upload_index=array();
if($files=$request->file('remark_attachment'))
{
 $random_sl=1;
   foreach($files as $key => $file)
   {
       $name=$file->getClientOriginalName();
       $file_extenxion = $file->getClientOriginalExtension();
       $new_filename =$employee_id.date('ymdhis').$random_sl.'.'.$file_extenxion;
       $file->move(public_path().'/remark/', $new_filename);  
       $upload_remark[$key]=$new_filename;
       $upload_index[]=$key;
       $random_sl++;
   }
}
 
if(count($remark_text)>0){
   foreach($remark_text as $key1=>$val){
      if($remark_text[$key1]!="") {
        if($remark_sql_id[$key1]==""){
            if (in_array($key1,$upload_index)){
              $employee_remark_fetch =array(
                'slno'=> $remark_slno[$key1],
                'emp_no'=> $employee_number,
                'remark_text'=> $remark_text[$key1],
                'remark_attachment'=> $upload_remark[$key1],
                'currendate'=> date('Y-m-d'),
              );
            } else{
                $employee_remark_fetch =array(
                  'slno'=> $remark_slno[$key1],
                  'emp_no'=> $employee_number,
                  'remark_text'=> $remark_text[$key1],
                  'currendate'=> date('Y-m-d'),
                );
            }
          $employee_remark_insert=DB::table('emp_remark_dtl')->insert($employee_remark_fetch);
        } else {
            if (in_array($key1,$upload_index)) {
            $employee_remark_fetch1 =array(
                'slno'=> $remark_slno[$key1],
                'emp_no'=> $employee_number,
                'remark_text'=> $remark_text[$key1],
                'remark_attachment'=> $upload_remark[$key1],
              );
            } else {
              $employee_remark_fetch1 =array(
                'slno'=> $remark_slno[$key1],
                'emp_no'=> $employee_number,
                'remark_text'=> $remark_text[$key1],
              );
            }
            $employee_remark_update=DB::table('emp_remark_dtl')->where('emp_no', $employee_number)->where('id',$remark_sql_id[$key1])->update($employee_remark_fetch1);
        }
      }
   }
}
//remark end//

         return redirect('/employee_edit_master/?search_emp='.$employee_number)->with('SuccessStatus', 'Records sucessfully updated');
      }
      //row dependent
       public function depdelete(Request $request ){
            $status=1;
             $did=$request->did;
             //  echo"<pre>";print_r($pid );echo"</pre>";exit();
             $deletepreventive = Dependent::findOrFail($did);
               //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
             if( $deletepreventive->delete()){
                 $status=1;
             }else{
                 echo "data not deleted";
                 $status=0;
             }
             return Response::json($status);
             exit;
         }
         //qualifications
         public function deletequali(Request $request ){
           $qid=$request->qid;
           //  echo"<pre>";print_r($pid );echo"</pre>";exit();
           $deletequalification = Qualification::findOrFail($qid);
             //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
           if( $deletequalification->delete()){
               $status=1;
           }else{
               echo "data not deleted";
               $status=0;
           }
           return Response::json($status);
           exit;
       }
       //organization
       public function deleteorganization(Request $request ){
        $qid=$request->qid;
        //  echo"<pre>";print_r($pid );echo"</pre>";exit();
        $deletequalification = Experience::findOrFail($qid);
          //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
        if( $deletequalification->delete()){
            $status=1;
        }else{
            echo "data not deleted";
            $status=0;
        }
        return Response::json($status);
        exit;
    }
    //transfer
    public function deletetransfer(Request $request ){
      $qid=$request->qid;
      //  echo"<pre>";print_r($pid );echo"</pre>";exit();
      $deletequalification = Transfer::findOrFail($qid);
        //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
      if( $deletequalification->delete()){
          $status=1;
      }else{
          echo "data not deleted";
          $status=0;
      }
      return Response::json($status);
      exit;
  }
      //promotion
      public function deletepromotion(Request $request ){
        $pid=$request->pid;
        //  echo"<pre>";print_r($pid );echo"</pre>";exit();
        $deletequalification = Promotion::findOrFail($pid);
          //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
        if( $deletequalification->delete()){
            $status=1;
        }else{
            echo "data not deleted";
            $status=0;
        }
        return Response::json($status);
        exit;
    }
      //probation
      public function deleteprobation(Request $request ){
        $pid=$request->pid;
        //  echo"<pre>";print_r($pid );echo"</pre>";exit();
        $deletequalification = Probation::findOrFail($pid);
          //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
        if( $deletequalification->delete()){
            $status=1;
        }else{
            echo "data not deleted";
            $status=0;
        }
        return Response::json($status);
        exit;
    }
    public function contractdelete(Request $request ){
      $cid=$request->cid;
      //  echo"<pre>";print_r($pid );echo"</pre>";exit();
      $deletequalification = Contract::findOrFail($cid);
        //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
      if( $deletequalification->delete()){
          $status=1;
      }else{
          echo "data not deleted";
          $status=0;
      }
      return Response::json($status);
      exit;
  }
  public function antecedentdelete(Request $request ){
    $cid=$request->cid;
    //  echo"<pre>";print_r($pid );echo"</pre>";exit();
    $deletequalification = Antecedent::findOrFail($cid);
      //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
    if( $deletequalification->delete()){
        $status=1;
    }else{
        echo "data not deleted";
        $status=0;
    }
    return Response::json($status);
    exit;
}

public function revocationdelete(Request $request ){
  $cid=$request->cid;
  //  echo"<pre>";print_r($pid );echo"</pre>";exit();
  $deletequalification = Revocation::findOrFail($cid);
    //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
  if( $deletequalification->delete()){
      $status=1;
  }else{
      echo "data not deleted";
      $status=0;
  }
  return Response::json($status);
  exit;
} 
public function delete_intiation(Request $request ){
  $inti_id=$request->inti_id;
  //  echo"<pre>";print_r($pid );echo"</pre>";exit();
  $deleteintiation = Intiation::findOrFail($inti_id);
    //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
  if( $deleteintiation->delete()){
      $status=1;
  }else{
      echo "data not deleted";
      $status=0;
  }
  return Response::json($status);
  exit;
}  
public function deleteachievement(Request $request ){
  $achievement_id=$request->achievement_id;
  //  echo"<pre>";print_r($pid );echo"</pre>";exit();
  $deleteAchievement = Achievement::findOrFail($achievement_id);
    //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
  if( $deleteAchievement->delete()){
      $status=1;
  }else{
      echo "data not deleted";
      $status=0;
  }
  return Response::json($status);
  exit;
}   
public function appreecitaiondelete(Request $request ){
  $cid=$request->cid;
  //  echo"<pre>";print_r($pid );echo"</pre>";exit();
  $deletequalification = Appriciation::findOrFail($cid);
    //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
  if( $deletequalification->delete()){
      $status=1;
  }else{
      echo "data not deleted";
      $status=0;
  }
  return Response::json($status);
  exit;
}

public function rewarddelete(Request $request ){
  $cid=$request->cid;
  //  echo"<pre>";print_r($pid );echo"</pre>";exit();
  $deletequalification = Reward::findOrFail($cid);
    //echo"<pre>";print_r($deletepreventive );echo"</pre>";exit();
  if( $deletequalification->delete()){
      $status=1;
  }else{
      echo "data not deleted";
      $status=0;
  }
  return Response::json($status);
  exit;
}   
  
       public function allEmployeDetails(Request $request)
        {  
          $employee_number = $request->search_emp;
          if(!DB::table('emp_mst')->where('emp_no',trim($employee_number))->exists()){
            return redirect('/home');
          }
          $EmployeeModel = new Employee_Master();  
          $Department_fetch = Department_master::all();
          $Designation_fetch = Designation::all();
          $Workplace_fetch = Workplace::all();
          $Category_fetch = Category::all();
          $antecendent_fetch = Antecedent::all(); 
            $Qual_lvl = Qual_lvl::all(); 
          $Employee_fetch1 = Employee_Master::Employee_Master_view();
          $pay_grade_view = Pay_grade_master::Pay_grade_Master_view();
          $qualification_view = Qualification::Qualification_view();
          $Board_view = Board::Board_view();
          $Employee_type_fetch =Employee_type::all();
          $Board_University_fetch =Board::all();
           $Bank_view = Bank::all();
          $EmployeeAllInfo = $EmployeeModel->getAllEmployeeInfo($employee_number);
 
          $EmployeeOfficialInfo = $EmployeeModel->getAllEmployeeOfficialInfo($employee_number);
          // $EmployeeOfficialInfo = Db::table('pay_grade_mst')->where('pay_grade_code',$EmployeeModel->PAY_GRADE_CODE)->get();
          $EmployeeNomineeInfo = $EmployeeModel->getAllNomineeInfo($employee_number);
          $EmployeeDependentInfo = $EmployeeModel->getDependentInfo($employee_number);
          $EmployeeExperienceInfo = $EmployeeModel->getExperienceInfo($employee_number);
          $EmployeeTransferInfo = $EmployeeModel->getTransferInfo($employee_number);
          $EmployeePromotionInfo = $EmployeeModel->getPromotionInfo($employee_number);
          $EmployeeProbationInfo = $EmployeeModel->getProbationInfo($employee_number);
          $EmployeeContractInfo = $EmployeeModel->getContractInfo($employee_number);
          $EmployeeAntecedentInfo = $EmployeeModel->getAntecedentInfo($employee_number);
          $EmployeeRevocationInfo = $EmployeeModel->getRevocationInfo($employee_number);
          $EmployeeQualificationInfo = $EmployeeModel->getAllQualificationInfo($employee_number);
          $EmployeeIntitionInfo = $EmployeeModel->getIntitionInfo($employee_number);
          $EmployeeAchievementInfo = $EmployeeModel->getAchievementInfo($employee_number);
          $EmployeeAppreciationInfo = $EmployeeModel->getappreciationInfo($employee_number);
          $EmployeeRewardInfo = $EmployeeModel->getRewardInfo($employee_number);
          $EmployeeRemarks = $EmployeeModel->getRemark($employee_number);
           
          // return $Employee_fetch1;
            
      //  echo"<pre>";print_r($EmployeeAntecedentInfo);echo"</pre>";exit;
 
          return view('Frontend.edit_profile',["EmployeeRemarks"=>$EmployeeRemarks,"EmployeeAllInfo"=>$EmployeeAllInfo,"EmployeeOfficialInfo"=>$EmployeeOfficialInfo,"EmployeeNomineeInfo"=>$EmployeeNomineeInfo,"Department_fetch"=>$Department_fetch,"Designation"=>$Designation_fetch,"Workplace_fetch" => $Workplace_fetch,"Category_fetch"=> $Category_fetch,"Employee_type_fetch"=>$Employee_type_fetch,'pay_grade_view' => $pay_grade_view,"Qual_lvl"=>$Qual_lvl,"Board_University_fetch"=>$Board_University_fetch,"EmployeeDependentInfo"=>$EmployeeDependentInfo,"EmployeeExperienceInfo"=>$EmployeeExperienceInfo,"EmployeeTransferInfo"=>$EmployeeTransferInfo,"EmployeePromotionInfo"=>$EmployeePromotionInfo,"EmployeeProbationInfo"=>$EmployeeProbationInfo,"EmployeeContractInfo"=>$EmployeeContractInfo,"EmployeeAntecedentInfo"=>$EmployeeAntecedentInfo,"EmployeeRevocationInfo"=>$EmployeeRevocationInfo,"antecendent_fetch"=>$antecendent_fetch,"Employee_fetch1"=>$Employee_fetch1,"EmployeeQualificationInfo"=>$EmployeeQualificationInfo,"qualification_view"=> $qualification_view,"Board_view"=>$Board_view,"EmployeeIntitionInfo"=>$EmployeeIntitionInfo,"EmployeeAchievementInfo"=>$EmployeeAchievementInfo,"EmployeeAppreciationInfo"=>$EmployeeAppreciationInfo,"EmployeeRewardInfo"=>$EmployeeRewardInfo,"Bank_view"=> $Bank_view]);
        }

        public function delete_empremark($id,$emp_id)
        {
          $check = Remark::where('id', $id)->count();
          if($check>0){
            $delete = Remark::where('id', $id)->where('emp_no', $emp_id)->delete();
            if($delete){
              return redirect()->back()->with('success',"Records has bee successfully deleted.");
            } else{
              return redirect()->back()->with('failed',"Failed to delete..!!");
            }
          } else{
            return redirect()->back()->with('failed',"Something is wrong..!!");
          }
        }

    public function getPackage(Request $request)
      {
        $data = Pay_grade_master::where('pay_grade_code', $request->selectedid)->get();
        return json_encode($data); 
      }
    public function getPromotion(Request $request)
      {
        $data = Pay_grade_master::where('id', $request->selectedid)->get();
        return json_encode($data);
      }
    public function gettoPromotion(Request $request)
      {
        $data = Pay_grade_master::where('id', $request->selectedid)->get();
        return json_encode($data);
      }
    public function gettoProbation(Request $request)
      {
        $data = Pay_grade_master::where('id', $request->selectedid)->get();
        return json_encode($data);
      }

       /**
       * Category Master page
      * */

       public function Category_Master_view(Request $request)
        {
          $Category_view = DB::table('category')->paginate(10);
        return view('Frontend.category', ['Category_view' => $Category_view ]);
        }
        public function AddCategory(Request $request)
        {
          $Category = new Category();
          $category_name = $request->cat_name;
          $category_code = $request->cat_code;
          $Category->category_name =  $category_name;
          $Category->category_code =  $category_code;
          $Category->save();
          return redirect('/category');
        }
        public function Update_Category_Data(Request $request)
        {
          $category_id = $request->cat_id;
          $category_name = $request->cat_name;
           $category_code = $request->cat_code;

          $category_fetch =array(
                        'category_name' => $category_name,

                         'category_code' => $category_code,
                         );
 
          $update_Data=DB::table('category')
                       ->where('id',  $category_id)
                       ->update($category_fetch); 
                       return redirect('/category');
 
         }
       public function Delete_category_data($id)
       {
        $category_data_all = category::find($id);
        $category_data_all->delete();
        return redirect('/category');
       }
      /**
       * EmployeeType Master page
      * */
      public function EmployeeType_Master_view(Request $request)
      {
       $Employee_view =DB::table('employee_type')->paginate(10);
   
      return view('Frontend.employee_type', ['Employee_view' => $Employee_view  ]);
      }
      public function AddEmployeeType(Request $request)
      {
        $employee_type = new Employee_type();
        $employee_type_name = $request->emp_name;
        $employee_type->employee_type_name =  $employee_type_name;
        $employee_type->save();
        return redirect('/employee_type');
      }
      public function Update_EmployeeType_Data(Request $request)
      {
        $employee_type_id = $request->emp_id;
        $employee_type_name = $request->emp_name;

        $employee_type_fetch =array(
                      'employee_type_name' => $employee_type_name,
                       );

        $update_Data=DB::table('employee_type')
                     ->where('id',  $employee_type_id)
                     ->update($employee_type_fetch); 
                     return redirect('/employee_type');

       }
     public function Delete_employee_type_data($id)
     {
      $employee_type_data_all = Employee_type::find($id);
      $employee_type_data_all->delete();
      return redirect('/employee_type');
     }

      public function EmployeeType_edit_Master_view(Request $request)
      {
     // $Employee_view = Employee_type::EmployeeType_Master_view();
   
      return view('Frontend.edit_profile');
      }

     public function EmployeelastRecordview()
      {
        $Emp_no= Employee_Master::Employee_Master_Last_record_view();
        //echo"<pre>";print_r($EmployeelastRecordfetch );echo"</pre>";
         return redirect('/employee_edit_master/?search_emp='.$Emp_no);
      }
        public function EmployeefirstRecordview()
      {  
        $Emp_first_no= Employee_Master::Employee_Master_first_record_view();
        return redirect('/employee_edit_master/?search_emp='.$Emp_first_no);
      }
     public function EmpDeleteRecordview(Request $request)
      {
       $Emp_data_all = Employee_Master::Employee_Master_delete_record_view($request);
       return redirect('/employee_master');
      }


       public function EmployeeNextRecordview(Request $request)
       {
         $Employee_next= Employee_Master::Employee_Master_next_record_view($request);

         if($Employee_next!="")
         {
           return redirect('/employee_edit_master/?search_emp='.$Employee_next);
         }
         else
         {
            $empno = $request->input('search_emp');
            return redirect('/employee_edit_master/?search_emp='.$empno);
         }
        // echo"<pre>";print_r($Emp_next_no );echo"</pre>";
         
       }
        public function EmployeePreviousRecordview(Request $request)
       {
         $Employee_prev= Employee_Master::Employee_Master_previous_record_view($request);

         if($Employee_prev!="")
         {
           return redirect('/employee_edit_master/?search_emp='.$Employee_prev);
         }
         else
         {
            $empno = $request->input('search_emp');
            return redirect('/employee_edit_master/?search_emp='.$empno);
         }
        // echo"<pre>";print_r($Emp_next_no );echo"</pre>";
         
       }
       public function Update_contract_details(Request $request)
       {
         $datacontract= DB::select('SELECT * FROM emp_contract_live_dtl');
     
          foreach($datacontract as $d){
            $data=array(
              $id='id'=> $d->id,
              //'EMP_NO'=> $d->EMP_NO,
              'CONT_START_DATE'=>date("d-m-Y",strtotime($d->CONT_START_DATE)),
              'CONT_END_DATE'=>date("Y-m-d",strtotime($d->CONT_END_DATE)),
            );

            $update_Data=DB::table('emp_contract_live_dtl')
            ->where('id', $id)
            ->update(array($data1)); 
            echo"<pre>";
             print_r($update_Data);
           echo"</pre>"; 
          }
          // echo"<pre>";
          // print_r($data1);
          // echo"</pre>";  
          // exit();
          // $update_contractdata=DB::table('emp_contract_live_dtl')
          // ->update($data1);

         

       }  
       public function contract_index()
       {
           return view('Frontend.demo');
       }
 
       public function agecounter(Request $request){
        $user_age = Carbon::parse($request->dob)->diff(Carbon::now())->format('%y_%m_%d');
        return $user_age;
       }
    
       public function delete_doc(Request $r)
       {
        $folder =base64_decode($r->f);
        $file =$r->file;
        $table =base64_decode($r->t);
        $column =base64_decode($r->c);
        $id =base64_decode($r->i);
        $eid =base64_decode($r->e);
        $check = DB::table($table)->where('id','=',$id)->count();
        if($check > 0){
          echo $check;
          $data = [
            $column => "",
          ];
          $result = DB::table($table)->where('id',$id)->update($data);
          if (File::exists(public_path("$folder/$file")))
          {
              File::delete(public_path("$folder/$file"));
              // echo $folder."--".$file."--".$table."--".$column."--".$id."--".$eid;
          }
          return redirect('/employee_edit_master?search_emp='.$eid);
        } else{
          return redirect('/employee_edit_master?search_emp='.$eid);
        }
       }

       public function changedata()
       {
        $data=DB::table('emp_mst')->select('id','DOB','DOC','DOJ','DOP','retirement_date','confirm_date')->get(); 
        foreach($data as $key=>$val){
          $data = [
            'DOB' => $val->DOB?date('Y-m-d', strtotime($val->DOB)):null,
            'DOC' => $val->DOC?date('Y-m-d', strtotime($val->DOC)):null,
            'DOJ' => $val->DOJ?date('Y-m-d', strtotime($val->DOJ)):null,
            'DOP' => $val->DOP?date('Y-m-d', strtotime($val->DOP)):null,
            'retirement_date' => $val->retirement_date?date('Y-m-d', strtotime($val->retirement_date)):null,
            'confirm_date' => $val->confirm_date?date('Y-m-d', strtotime($val->confirm_date)):null
          ];
          DB::table('emp_mst')->where('id',$val->id)->update($data);
        }
        //UPDATE `emp_mst` SET `DOB` = NULL,`DOJ` = NULL,`DOP` = NULL,`retirement_date` = NULL,`confirm_date` = NULL WHERE `DOB` = '0000-00-00';

       }


 public function resetdata()
{
  $users = DB::table('emp_mst')->select('id','emp_no')->get();
  foreach($users as $key => $val){
    $data = ['emp_no' => $val->emp_no];
    DB::table('emp_antecedent_dtl')->where('emp_no',$val->id)->update($data);
    DB::table('emp_revocation_dtl')->where('emp_no',$val->id)->update($data);
    DB::table('emp_achievement_dtl')->where('emp_no',$val->id)->update($data);
    DB::table('emp_appreciation')->where('emp_no',$val->id)->update($data);
    DB::table('emp_reward')->where('emp_no',$val->id)->update($data);
    DB::table('empmst_official')->where('emp_no',$val->id)->update($data);
    DB::table('emp_initiation_dtl')->where('emp_no',$val->id)->update($data);
    // emp_antecedent_dtl,emp_revocation_dtl,emp_achievement_dtl,emp_appreciation,emp_reward,empmst_official,emp_initiation_dtl
  }
  return 1;
}











}
