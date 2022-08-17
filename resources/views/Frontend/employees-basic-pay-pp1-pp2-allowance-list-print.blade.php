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
function gtype($code)
  {
    $data = DB::table('employee_type')->where(['emp_type_code'=>$code])->first();
    return $data->employee_type_name;
  }

  function getDesgmst($num)
  {
    $user = DB::table('emp_mst')->where(['emp_no'=>$num])->first();
    return DB::table('desg_mst')->where(['desg_code'=>$user->desg_code])->first();
  }
  function getDeptmaster($num)
  {
    $user = DB::table('emp_mst')->where(['emp_no'=>$num])->first();
    return DB::table('dept_master')->where(['dept_no'=>$user->dept_no])->first();
  }
  function getPay($num)
  {
    $user = DB::table('emp_mst')->select('pay_grade_code')->where(['emp_no'=>$num])->first();
    return DB::table('pay_grade_mst')->where(['pay_grade_code'=>$user->pay_grade_code])->first();
  } 
$check_type = array();
foreach ($employee_list as $key => $val) {
    $check_type[] = $val->emp_type;
}
$utype = array_unique($check_type);
$check_cat_exist = array();
foreach($utype as $k=>$ty){
    foreach ($categories as $c=>$cat){
       foreach($employee_list as $val){
            if ($ty==$val->emp_type && $cat->category_code== $val->catg){
                $check_cat_exist[$ty."_".$cat->category_code]= array($ty,$cat->category_code);
            }
        }
    } 
}

function getcat($type)
{
if($type =="all_cat"){
    return "All";
} else {
    $data = DB::table('category')->where(['category_code'=>$type])->first();
    return $data->category_name;
}
}
function gettypetbl($type)
{
if($type =="all_type"){
    return "All";
} else {
    $data = DB::table('employee_type')->where(['emp_type_code'=>$type])->first();
    return $data->employee_type_name;
}
}
if(isset($_GET['category']) && isset($_GET['type']) && isset($_GET['active_type'])){
    $print_category = getcat($_GET['category']);  
    $print_type = gettypetbl($_GET['type']);
    if($_GET['active_type']=="all"){
    $print_active_type = "All";  
    } elseif($_GET['active_type']=="A") {
    $print_active_type = "Active";  
    } elseif($_GET['active_type']=="I") {
    $print_active_type = "Inactive";  
    }
}  else {
    $print_category = "All";  
    $print_type = "All";  
    $print_active_type = "All";  
}
@endphp 
<table class="printtbl" width="100%">
    <thead>
        <tr style="background-color: white">
            <th align="left" colspan="11" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-top: 2px solid rgb(255, 255, 255); background-color: white;">
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
            <th align="center" colspan="11" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-bottom: 2px solid rgb(255, 255, 255);border-top: 2px dashed #000000;background-color: white;">
                <h3 style="font-weight: 600; font-size: 27px; margin-top: 10px; margin-bottom: -0.5px;text-align: center;">EMPLOYEES BASIC PAY, PP1, PP2, SPL. ALLOWANCE & OTHER ALLOWANCE LIST</h3>
            </th>
        </tr>
        <tr style="background-color: white;">
            <th align="center" colspan="11" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255); background-color: rgb(255, 255, 255);">
                <table width="100%" border="0" style="background-color: white;">
                    <tr>
                        <th width="30%" align="center" style="border: solid rgb(255, 255, 255);background-color: white;">
                            Type: {{ $print_type }}
                        </th>
                        <th width="40%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                            Category: {{ $print_category }}
                        </th>
                        <th  width="30%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                            Status: {{ $print_active_type }}
                        </th>
                    </tr>
                    </table>
            </th>
        </tr>
        <tr>
            <th class="st1">Emp Code</th>
            <th class="st1">Name Of The Employee</th>
            <th class="st1">Designation</th>
            <th class="st1">Department</th>
            <th class="st1">Active Type</th>
            <th class="st1">Pay Grade</th>
            <th class="st1">Basic Pay/Cont. Salary</th>
            <th class="st1">pp_1</th>
            <th class="st1">pp_2</th>
            <th class="st1">Spl Allowance</th>
            <th class="st1">Other Allowance</th>
        </tr>
    </thead>
    <tbody>
        @foreach($utype as $k=>$ty)

        <tr>
            <td colspan="11" align="left" style="padding: 0px; border-bottom: 1px solid white; ">
                <h5 style="text-decoration: underline; margin: 0px; padding: 5px 20px;font-size:25px; font-weight: 600; " >{{ @gtype($ty) }}</h5>
            </td>
        </tr>
    
        @foreach ($categories as $c=>$cat)
        @if(array_key_exists($ty."_".$cat->category_code,$check_cat_exist))
        <tr style="background: #e4eaef;">
            <td colspan="11" align="left" style="padding: 0px; border-bottom: 1px solid white; ">
                <h6 style="text-decoration: underline; margin: 0px; padding: 5px 20px; font-style: italic; font-size: inherit; font-weight: bolder;">{{ $cat->category_name }}</h6>
            </td>
        </tr>
        @endif
        @foreach($employee_list as $val)
        @if ($ty==$val->emp_type && $cat->category_code== $val->catg)
            @php
                $pay = getPay($val->emp_no);
            @endphp
        <tr>  
            <td>
                {{ $val->employee_code}}
            </td>
            <td>{{ $val->emp_name }}</td> 
            <td>
                @php
                    $dese = getDesgmst($val->emp_no);
                    echo @$dese->desg_name;
                @endphp
            </td>
            <td>
                @php
                    $dep = getDeptmaster($val->emp_no);
                    echo @$dep->dept_name;
                @endphp
            </td>
            <td>
                @if($val->active_type=="I")
                Inactive
                @elseif ($val->active_type=="A")
                Active
                @endif
            </td>
            <td>
                @php
                    echo @$pay->pay_grade_code;
                @endphp
            </td>
            <td>
                @if ($val->emp_type=="CO")
                {{ $val->CONT_SAL }}
                @else
                {{ $val->new_basic_pay }}
                @endif
            </td> 
            <td>{{ $val->pp1 }}</td>
            <td>{{ $val->pp2 }}</td>
            <td>
                {{ $val->spl_allow }}
               
            </td>
            <td>
                {{ $val->conv_allow }}
               
            </td>
        </tr>
        @else
        @endif
        @endforeach 
    
        @endforeach
        
            
        @endforeach
             </tbody>      
        </table> 

    </body>
    </html>     
          