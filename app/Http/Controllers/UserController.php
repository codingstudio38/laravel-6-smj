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
        $redirect_page= $request->page; 
        $user_sql_id = $request->user_sql_id1;
        $status= $request->status1; 
        $expiary_date= $request->expiary_date1; 
        $reenter_password= $request->reenter_password1;
        $old_password= $request->password00;
        $user_count = DB::table('users')->where('id', $user_sql_id)->count();
        if($user_count > 0){
            $user = DB::table('users')->where('id', $user_sql_id)->first();
          if(!$old_password=="" && !$reenter_password==""){
            $user_fetch =array(
              'password'=> Hash::make($reenter_password)
                );
            if(!Hash::check($old_password, $user->password)) {
                return redirect("/user-profile")->with('error',"Old password doesn't match..!!");
            } else {
                $update_Data=DB::table('users')->where('id',  $user_sql_id)->update($user_fetch); 
                return redirect("/user-profile")->with('success',"Password has been successfully updated..");
            }
          } else {
              return redirect("/user-profile")->with('success',"Successfully updated..");
          }
        } else {
          return redirect("/user-profile")->with('error',"error..!!");
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
        $data1 = DB::table('users')->get();
      } elseif(Auth::user()->role == "HR Manager") {
        $data1 = DB::table('users')
        ->where('role','!=',"Administrator")
        ->where('role','!=',"Authorisor")
        ->where('role','!=',"HR Manager")
        ->get();
      }elseif(Auth::user()->role == "Authorisor") {
        $data1 = DB::table('users')
        ->where('role','!=',"HR Manager")
        ->where('role','!=',"Administrator")
        ->where('role','!=',"Authorisor")
        ->get(); 
      } elseif(Auth::user()->role == "Supervisor") {
        $data1 = DB::table('users')
        ->where('role','!=',"Supervisor")
        ->where('role','!=',"Authorisor")
        ->where('role','!=',"HR Manager")
        ->where('role','!=',"Administrator")
        ->get();
      } elseif(Auth::user()->role == "User") {
          $data1 = DB::table('users')
          ->where('role','=',"User")
          ->get();
      } elseif(Auth::user()->role == "Finance Staff") {
        $data1 = DB::table('users')
        ->where('role','=',"Finance Staff")
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
     $Employee_fetch = Role::Employee_Role_view();
    return view('Frontend.user-profile', ['Employee_fetch' => $Employee_fetch,'data' => $data]);
  }
 
      public function Editloginaccess(Request $request)
     {  
      $id = $request->access;
      if(Auth::user()->role == "Administrator"){
        $data1 = DB::table('users')->get();
      } elseif(Auth::user()->role == "HR Manager") {
        $data1 = DB::table('users')
        ->where('role','!=',"Administrator")
        ->where('role','!=',"Authorisor")
        ->where('role','!=',"HR Manager")
        ->get();
      }elseif(Auth::user()->role == "Authorisor") {
        $data1 = DB::table('users')
        ->where('role','!=',"HR Manager")
        ->where('role','!=',"Administrator")
        ->where('role','!=',"Authorisor")
        ->get(); 
      } elseif(Auth::user()->role == "Supervisor") {
        $data1 = DB::table('users')
        ->where('role','!=',"Supervisor")
        ->where('role','!=',"Authorisor")
        ->where('role','!=',"HR Manager")
        ->where('role','!=',"Administrator")
        ->get(); 
      } elseif(Auth::user()->role == "User") {
          $data1 = DB::table('users')
          ->where('role','=',"User")
          ->get();
      } elseif(Auth::user()->role == "Finance Staff") {
        $data1 = DB::table('users')
        ->where('role','=',"Finance Staff")
        ->get();
      } else {
        $data1 = null;
      }
    $Employee_fetch = Role::Employee_Role_view();
        $type = DB::table('user_roles')->get();
        if(DB::table('users')->where('id', $id)->count() > 0){
          $userdata = DB::table('users')->where('id', $id)->first();
          $data = [
            'type'=>$type,
            'userdata'=>$userdata,
            'Employee_fetch' => $Employee_fetch,
            'data1' => $data1
          ];
          return view('Frontend.user-access-profile-edit',$data);
        } else{
          return redirect('/user-maintenance')->with('error',"User not found..!!");
        }
     }
     public function EditloginaccessPOST(Request $request)
     {  
        // $user_name = $request->user_name;
        $email = $request->email_id1;
        $user_sql_id = $request->user_sql_id1;
        $status= $request->status1; 
        $expiary_date= $request->expiary_date1; 
        $reenter_password= $request->reenter_password1;
        $old_password= $request->password00; 
        $user_count = DB::table('users')->where('id', $user_sql_id)->count();
        if($user_count > 0){
            $user = DB::table('users')->where('id', $user_sql_id)->first();
            if(!$old_password=="" && !$reenter_password==""){
              $user_fetch =array(
                'email' => $email,
                'status' => $status,
                'expiary_date' => $expiary_date,
                'password'=> Hash::make($reenter_password)
                  );
              if(!Hash::check($old_password, $user->password)) {
                  return redirect("/edit_login_access?access=$user_sql_id")->with('error',"Old password doesn't match..!!");
              } else {
                  $update_Data=DB::table('users')->where('id',  $user_sql_id)->update($user_fetch); 
                  return redirect("/user-maintenance")->with('success',"Successfully updated..");
              }
            } else {
              $user_fetch = array(
                'email' => $email,
                'status' => $status,
                'expiary_date' => $expiary_date,
                  );
              $update_Data=DB::table('users')->where('id',  $user_sql_id)->update($user_fetch); 
              return redirect("/user-maintenance")->with('success',"Successfully updated..");
            }
        } else {
          return redirect("/user-maintenance")->with('error',"error..!!");
        }
     }
  






}
