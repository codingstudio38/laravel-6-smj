<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Samaj</title>
<style>
  body {
            font-family: Arial;
            font-size: 10pt;
        }

        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
        }

        table th {
            background-color: #F7F7F7;
            color: #333;
            font-weight: bold;
        }

        table th,
        table td {
            padding: 5px;
            border: 1px solid #ccc;
        }
.st1{
   color: #1b55e2; font-weight: 700; font-size: 13px; letter-spacing: 1px; text-transform: uppercase; 
}
</style> 
</head>
<body>
@php
date_default_timezone_set('Asia/Kolkata');
$time = date("M d, Y h:i A");
use Illuminate\Support\Facades\DB;
$check_dept = array();
foreach ($employee_list as $key => $val) {
$check_dept[] = @$val->dept_no;
}
$udepartment = array_unique($check_dept);
$check_exist = array();
foreach($udepartment as $k=>$dpt){
    foreach ($employee_type as $key=>$ty){
       foreach($employee_list as $val){
            if ($dpt==$val->dept_no && $ty->emp_type== $val->emp_type){
                $check_exist[$dpt]= array($dpt,$ty->emp_type);
            }
        }
    } 
}

  function getDesgmst($num)
  {
    $user = DB::table('emp_mst')->where(['emp_no'=>$num])->first();
    return DB::table('desg_mst')->where(['desg_code'=>$user->desg_code])->first();
  }
  function getCat($num)
  {
    $user = DB::table('emp_mst')->where(['emp_no'=>$num])->first();
    return DB::table('category')->where(['category_code'=>$user->catg])->first();
  }
  function getDeptmaster($id)
  {
    return DB::table('dept_master')->where(['dept_no'=>$id])->first();
  }

function getcattbl($type)
  {
    if($type =="All"){
        return "All";
    } else {
        $data = DB::table('category')->where(['category_code'=>$type])->first();
        return $data->category_name;
    }
  }
  function gettypetbl($type)
  {
    if($type =="All"){
        return "All";
    } else {
        $data = DB::table('employee_type')->where(['emp_type_code'=>$type])->first();
        return $data->employee_type_name;
    }
  }
  function getdepatmenttbl($num)
  {
    if($num =="All"){
        return "All";
    } else {
        $data = DB::table('dept_master')->where(['dept_no'=>$num])->first();
        return $data->dept_name;
    }
  }
if(isset($_GET['category']) && isset($_GET['type']) && isset($_GET['department']) && isset($_GET['active_type'])){
$print_category = getcattbl($_GET['category']);  
$print_type = gettypetbl($_GET['type']);
$print_dpt = getdepatmenttbl($_GET['department']);
if($_GET['active_type']=="all"){
    $print_active_type = "All";  
} elseif($_GET['active_type']=="A") {
    $print_active_type = "Active";  
} elseif($_GET['active_type']=="I") {
    $print_active_type = "Inactive";  
}
}  else {
    $print_dpt = "All";  
    $print_category = "All";  
    $print_type = "All";  
    $print_active_type = "All";  
}
@endphp 
<table class="printtbl" width="100%">
  <thead>
    <tr style="background-color: white">
        <th align="left" colspan="6" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-top: 2px solid rgb(255, 255, 255); background-color: white;">
           <table width="100%" border="0" style="background-color: white">
            <tr style="background-color: white">
                <th width="30%" align="left" style="border: solid rgb(255, 255, 255);background-color: white;">
                    <?php 
                    if(isset($_GET['page'])){
                        echo "Page - ".$_GET['page'];
                    }
                    if(!isset($_GET['page'])){
                                  if(count($employee_list) <= 30){
                                      echo "Page - 1";
                                  }
                              }
                    ?>   
                </th>
                <th width="40%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                    <h3 style="font-weight: 600;text-align: center; font-size: 27px; color:#000000; text-decoration: underline;">THE SAMAJ</h3>
                </th>
                <th  width="30%" align="right" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                    Print Date: {{ $time }}
                </th>
            </tr>
           </table>
        </th>
    </tr>
    <tr style="background-color: white;">
        <th align="center" colspan="6" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-bottom: 2px solid rgb(255, 255, 255);border-top: 2px dashed #000000;background-color: white;">
            <h3 style="font-weight: 600; font-size: 27px; margin-top: 10px; margin-bottom: -0.5px;text-align: center;">EMPLOYEES LIST(Department Wise)</h3>
        </th>
    </tr>
    <tr style="background-color: white;">
        <th align="center" colspan="6" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255); background-color: rgb(255, 255, 255);">
            <table width="100%" border="0" style="background-color: white;">
                <tr>
                  <th width="25%" align="center" style="border: solid rgb(255, 255, 255);background-color: white;">
                      Category: {{ $print_category }}
                  </th>
                    <th width="25%" align="center" style="border: solid rgb(255, 255, 255);background-color: white;">
                      Type: {{ $print_type }}
                    </th>
                    <th width="25%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                      Department: {{ $print_dpt }}
                    </th>
                    <th  width="25%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                        Status: {{ $print_active_type }}
                    </th>
                </tr>
               </table>
        </th>
    </tr>
    <tr style="background: #f5f3f3;">
      <th align="center" class="st1">Emp Code</th>
      <th align="center" class="st1">Employee Name</th>
      <th align="center" class="st1">Designation</th>
      <th align="center" class="st1">Category</th>
      <th align="center" class="st1">Emp. Type</th>
      <th align="center" class="st1">Active Type</th>
  </tr>
</thead>
          <tbody>
            @foreach ($departmment as $valdpt)
                          @if(array_key_exists($valdpt->dept_no,$check_exist))
                          <tr style="background-color: aliceblue;">
                            <td colspan="6" align="left" style="padding: 0px;  background-color: aliceblue;">
                                <h5 style="text-decoration: underline; margin-left:20px; margin-top: 17px; font-weight: 600;">
                                   
                            @php
                            $dt= getDeptmaster($valdpt->dept_no);
                            echo @$dt->dept_name;
                            @endphp
                                </h5>
                            </td>
                          </tr> 
                          @endif
                           
                          @foreach ($employee_list as $val)
                          @if($valdpt->dept_no==$val->dept_no)
                          <tr>
                              <td>{{ $val->employee_code }}</td>
                              <td>{{ $val->emp_name }}</td>
                              <td>
                                  @php
                                  $dese = getDesgmst($val->emp_no);
                                   echo @$dese->desg_name;
                                  @endphp
                              </td>
                              <td>
                                  @php
                                  $cat = getCat($val->emp_no);
                                   echo @$cat->category_name;
                                  @endphp
                              </td>
                              <td>
                              @if ($val->emp_type=="PE")
                              PERMANENT
                              @elseif ($val->emp_type=="PR")
                              PROBATION
                              @elseif ($val->emp_type=="CO")
                              CONTARCT
                              @endif
                          </td>   
                          <td>
                              @if($val->active_type=="I")
                              Inactive
                              @elseif ($val->active_type=="A")
                              Active
                              @endif
                          </td> 
                          </tr>
                          @endif
                          @endforeach

                            @endforeach 
          
                      </tbody>
           
        </table> 

    </body>
    </html>     
          