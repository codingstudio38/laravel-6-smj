<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use DB;
use DateTime;
use Auth; 
class UserController extends Controller
{ 
    //
    public function store(Request $request)
    {
      $data = $request->all();
      $user = [];
      $user['role'] = $data['user_name'];
      $user['email'] = $data['email'];
      $user['status'] =  $data['status'];
      $user['password'] = Hash::make($data['confirm']);
      $user['expiary_date'] = $data['expiary_date'];
      $isExist = User::select("*")->where("email", $user['email'])->exists();
      if ($isExist ) {
      // return redirect()->back()->with('alert', 'The Emailid is already exsits');
      return redirect()->back()->with('error', 'The Emailid is already exsits..!!');
      } else { 
        $newuser = User::create($user);
      } 
      //  return redirect('/user-maintenance')->with('data-added','record inserted');
      return redirect('/user-maintenance')->with('success','Record inserted..');
    }  
  public function Update_User_Data(Request $request)
     { 
      return $request->All();exit;
        $redirect_page= $request->page; 
        $user_sql_id = $request->user_sql_id1;
        $status= $request->status1; 
        $expiary_date= $request->expiary_date1; 
        $reenter_password= $request->reenter_password1;
        $old_password= $request->password00;
        $user_count = DB::table('users')->where('id', $user_sql_id)->count();
        if($user_count > 0){
            $user = DB::table('users')->where('id', $user_sql_id)->first();
                if(!$reenter_password==""){
                $user_fetch =array(
                  'status' => $status,
                  'expiary_date' => $expiary_date,
                  'password'=> Hash::make($reenter_password)
                    );
                } else {
                $user_fetch = array(
                  'status' => $status,
                  'expiary_date' => $expiary_date,
                    );
                }
            if(!Hash::check($old_password, $user->password)) {
                return redirect("/$redirect_page")->with('error',"Old password doesn't match..!!");
            } else {
                $update_Data=DB::table('users')->where('id',  $user_sql_id)->update($user_fetch); 
                return redirect("/$redirect_page")->with('success',"Successfully updated..");
            }
        } else {
          return redirect("/$redirect_page")->with('error',"error..!!");
        }
     }


    public function getEmailuser(Request $request)
      { 
        $res=array();
        $data = array();
        if($request->login_role == "Administrator"){
          $res = DB::table('users')
          ->where('role','=',$request->selectedid)
          ->get();
        } elseif($request->login_role == "HR Manager") {
          if($request->selectedid===$request->login_role){
            $res = DB::table('users')
            ->where('role','=',$request->selectedid)
            ->where('id','=',$request->login_id)
            ->get();
          } else {
            $res = DB::table('users')
            ->where('role','=',$request->selectedid)
            ->get();
          }
        }elseif($request->login_role == "Authorisor") {
          if($request->selectedid===$request->login_role){
              $res = DB::table('users')
              ->where('role','=',$request->selectedid)
              ->where('id','=',$request->login_id)
              ->get(); 
            } else {
              $res = DB::table('users')
              ->where('role','=',$request->selectedid)
              ->get(); 
            }
        }elseif($request->login_role == "Supervisor") {
          if($request->selectedid===$request->login_role){
            $res = DB::table('users')
            ->where('role','=',$request->selectedid)
            ->where('id','=',$request->login_id)
            ->get();
          } else {
            $res = DB::table('users')
            ->where('role','=',$request->selectedid)
            ->get();
          }
        }elseif($request->login_role == "User") {
          $res = DB::table('users')
          ->where('role','=',$request->selectedid)
          ->where('id','=',$request->login_id)
          ->get();
        }elseif($request->login_role == "Finance Staff") { 
          $res = DB::table('users')
          ->where('role','=',$request->selectedid)
          ->where('id','=',$request->login_id)
          ->get();
        } else {
          $res = null;
        }
        if(count($res) > 0){
          $data[]="<option>select</option>";
          foreach ($res as $r) {
            $data[]="<option value=".$r->id.">".$r->email."</option>";
         }
        } else {
          $data[]=null;
        }
        return json_encode($data);
      }
     public function getEmailDetails(Request $request)
      {
        $data = User::where('id', $request->emailId)->get();
        //print_r($data); exit();
        return json_encode($data);
      }
    public function fetchrole(Request $request)
    {
    
    
    $user1=User::where('email',$request->email)->first();
   // print_r($user);exit();
    if($user1){
            $userrole= $user1->role;
            // print_r($userrole);exit();
           // $roles=Role::select('id','user_type')->whereIn('user_type',$userrole)->get();
    }
    else
    {
            $roles=array();
    }

    return json_encode($user1);
    
  } 
  public function user_maintenance(Request $request)
  {  
      if(Auth::user()->role == "Administrator"){
        $data = DB::table('user_roles')->get();
      } elseif(Auth::user()->role == "HR Manager") {
        $data = DB::table('user_roles')
        ->where('user_type','!=',"HR Manager")
        ->where('user_type','!=',"Administrator")
        ->where('user_type','!=',"Authorisor")
        ->get();
      }elseif(Auth::user()->role == "Authorisor") {
        $data = DB::table('user_roles')
        ->where('user_type','!=',"Authorisor")
        ->where('user_type','!=',"HR Manager")
        ->where('user_type','!=',"Administrator")
        ->get(); 
      }elseif(Auth::user()->role == "Supervisor") {
        $data = DB::table('user_roles')
        ->where('user_type','!=',"Authorisor")
        ->where('user_type','!=',"HR Manager")
        ->where('user_type','!=',"Supervisor")
        ->where('user_type','!=',"Administrator")
        ->get();
      } else {
        $data = null;
      }
 
      if(Auth::user()->role == "Administrator"){
        $data1 = DB::table('user_roles')->get();
      } elseif(Auth::user()->role == "HR Manager") {
        $data1 = DB::table('user_roles')
        ->where('user_type','!=',"Administrator")
        ->where('user_type','!=',"Authorisor")
        ->where('user_type','!=',"HR Manager")
        ->get();
      }elseif(Auth::user()->role == "Authorisor") {
        $data1 = DB::table('user_roles')
        ->where('user_type','!=',"HR Manager")
        ->where('user_type','!=',"Administrator")
        ->where('user_type','!=',"Authorisor")
        ->get(); 
      } elseif(Auth::user()->role == "Supervisor") {
        $data1 = DB::table('user_roles')
        ->where('user_type','!=',"Supervisor")
        ->where('user_type','!=',"Authorisor")
        ->where('user_type','!=',"HR Manager")
        ->where('user_type','!=',"Administrator")
        ->get();
      } elseif(Auth::user()->role == "User") {
          $data1 = DB::table('user_roles')
          ->where('user_type','=',"User")
          ->get();
      } elseif(Auth::user()->role == "Finance Staff") {
        $data1 = DB::table('user_roles')
        ->where('user_type','=',"Finance Staff")
        ->get();
      } else {
        $data1 = null;
      }
    $Employee_fetch = Role::Employee_Role_view();
    return view('Frontend.user-maintenance', ['Employee_fetch' => $Employee_fetch,'data' => $data,'data1' => $data1]);
  }

    public function user_profile(Request $request)
  { 
    $data = DB::table('user_roles')->get();
    // if(Auth::user()->role == "Administrator"){
    //   $data = DB::table('user_roles')->get();
    // } elseif(Auth::user()->role == "HR Manager") {
    //   $data = DB::table('user_roles')
    //   ->where('user_type','!=',"Administrator")
    //   ->where('user_type','!=',"Authorisor")
    //   ->where('user_type','!=',"HR Manager")
    //   ->get();
    // }elseif(Auth::user()->role == "Authorisor") {
    //   $data = DB::table('user_roles')
    //   ->where('user_type','!=',"HR Manager")
    //   ->where('user_type','!=',"Administrator")
    //   ->where('user_type','!=',"Authorisor")
    //   ->get(); 
    // } elseif(Auth::user()->role == "Supervisor") {
    //   $data = DB::table('user_roles')
    //   ->where('user_type','!=',"Supervisor")
    //   ->where('user_type','!=',"Authorisor")
    //   ->where('user_type','!=',"HR Manager")
    //   ->where('user_type','!=',"Administrator")
    //   ->get();
    // } elseif(Auth::user()->role == "User") {
    //     $data = DB::table('user_roles')
    //     ->where('user_type','=',"User")
    //     ->get();
    // } elseif(Auth::user()->role == "Finance Staff") {
    //   $data = DB::table('user_roles')
    //   ->where('user_type','=',"Finance Staff")
    //   ->get();
    // } else {
    //   $data = null;
    // } 
     $Employee_fetch = Role::Employee_Role_view();
    return view('Frontend.user-profile', ['Employee_fetch' => $Employee_fetch,'data' => $data]);
  }

  // public function update_contract_details(Request $request)
  // {
    // $dbname="samaj-2";
    // $db_username="root";
    // $db_pwd="";
    // DB::purge('mysql');
    // \Config::set('database.connections.mysql.database', $dbname);
    // \Config::set('database.connections.mysql.username', $db_username);
    // \Config::set('database.connections.mysql.password', $db_pwd);
    // \DB::setDefaultConnection('mysql');

    // $oracle_date = DB::select('SELECT * FROM emp_mst');

    // $var = '20/01/21';
    // echo"<pre>";
    //   print_r($datacontract);
    //   echo"</pre>";
    //   exit;

    // $max_year = 0;

    // foreach($oracle_date as $d){
      // $data=array(
      //   $id='id'=> $d->id,
      //   //'EMP_NO'=> $d->EMP_NO,
      //   'CONT_START_DATE'=>date("d-m-Y",strtotime($d->CONT_START_DATE)),
      //   'CONT_END_DATE'=>date("Y-m-d",strtotime($d->CONT_END_DATE)),
      // );

      // $update_Data=DB::table('emp_contract_live_dtl')
      // ->where('id', $id)
      // ->update(array($data1)); 
      // echo"<pre>";
      //   print_r($update_Data);
      // echo"</pre>";
      // if($d->image!='')
      // {
        // $date = DateTime::createFromFormat('d-m-y', $d->DEPD_DOB);
        // $data1 = [
        //   'DEPD_DOB'=>$date->format('Y-m-d'),
        // ];
        // $old_date = explode('-', $d->TRANS_FROM_DATE);
        // $new_date = '';

        // $cmp = $old_date[2];
        // if($cmp>$max_year)
        // {
        //   $max_year = $cmp;
        // }
        
        // if($old_date[2]>22)
        // {
        //   $new_date = '19'.$old_date[2].'-'.$old_date[1].'-'.$old_date[0];
        // }
        // else
        // {
        //   $new_date = '20'.$old_date[2].'-'.$old_date[1].'-'.$old_date[0];
        // }
        // $data1 = [
        //   'image'=>$d->image,
        // ];

        // $dbname="samaj-demo";
        // $db_username="root";
        // $db_pwd="";
        // DB::purge('mysql');
        // \Config::set('database.connections.mysql.database', $dbname);
        // \Config::set('database.connections.mysql.username', $db_username);
        // \Config::set('database.connections.mysql.password', $db_pwd);
        // \DB::setDefaultConnection('mysql');

        // DB::table('emp_mst')->where('emp_no',$d->emp_no)->update($data1);

        // $new_data = $old_date[2].'-'.$old_date[1].'-'.$old_date[0];

        // echo"<pre>";
        // print_r($data1);
        // echo"</pre>";

      // }
      // echo"<pre>";
      // print_r($d);
      // echo"</pre>";

    // }

    // echo 'DONE';
    // echo $max_year;
    // exit;
    
    // $update_contractdata=DB::table('emp_contract_live_dtl')
    // ->update($data1);

  // }
}
