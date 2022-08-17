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
function emp_contract($emp_no)
  {
    $check = DB::table('emp_contract_dtl')->where(['emp_no'=>$emp_no])->count();
    if($check > 0){
        $data = DB::table('emp_contract_dtl')->where(['emp_no'=>$emp_no])->get();
        return $data;
    } else {
        return 0;
    }
  }
  
  function getCategory($emp_no)
  {
    $user = DB::table('emp_mst')->where(['emp_no'=>$emp_no])->first();
    $data = DB::table('category')->where(['category_code'=>$user->catg])->first();
    return array(
        "category_name"=>$data->category_name,
        "category_code"=>$data->category_code
    );
  }
  function getDesgmst($emp_no)
  {
    $user = DB::table('emp_mst')->where(['emp_no'=>$emp_no])->first();
    $data = DB::table('desg_mst')->where(['desg_code'=>$user->desg_code])->first();
    return $data->desg_name;
  }
  function getDeptmaster($emp_no)
  {
    $user = DB::table('emp_mst')->where(['emp_no'=>$emp_no])->first();
    $data = DB::table('dept_master')->where(['dept_no'=>$user->dept_no])->first();
    return $data->dept_name;
  }
  function empDetails($emp_no)
  {
    if($emp_no==""){
    return 0; 
   } else {
    if(DB::table('emp_mst')->where(['emp_no'=>$emp_no])->count() > 0){
            $user = DB::table('emp_mst')->where(['emp_no'=>$emp_no])->first();
            return $user; 
        } else {
            return 0; 
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
if(isset($_GET['category']) && isset($_GET['from_date']) && isset($_GET['to_date']) && isset($_GET['active_type'])){
$print_category = getcat($_GET['category']);  
if($_GET['from_date']==""){
    $from_date = "All";  
} else {
    $from_date = date('d-M-Y', strtotime($_GET['from_date']));     
}
if($_GET['to_date']==""){
    $to_date = "All";  
} else {
    $to_date = date('d-M-Y', strtotime($_GET['to_date']));  
}
if($_GET['active_type']=="all"){
    $print_active_type = "All";  
} elseif($_GET['active_type']=="I") {
    $print_active_type = "Inactive";  
} elseif($_GET['active_type']=="A") {
    $print_active_type = "Active";  
}
}  else {
$print_category  = "All";   
$from_date = "All";  
$to_date = "All";  
$print_active_type = "All";  
}  
@endphp 
<table class="printtbl" width="100%">
    <thead>
        <tr style="background-color: white">
            <th align="left" colspan="12" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-top: 2px solid rgb(255, 255, 255); background-color: white;">
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
            <th align="center" colspan="12" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-bottom: 2px solid rgb(255, 255, 255);border-top: 2px dashed #000000;background-color: white;">
                <h3 style="font-weight: 600; font-size: 27px; margin-top: 10px; margin-bottom: -0.5px;text-align: center;">EMPLOYEE CONTRACT RENEWAL DETAILS REPORT</h3>
            </th>
        </tr>
        <tr style="background-color: white;">
            <th align="center" colspan="12" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255); background-color: rgb(255, 255, 255);">
<table width="100%" border="0" style="background-color: white;">
    <tr>
        <th width="25%" align="center" style="border: solid rgb(255, 255, 255);background-color: white;">
            Category: {{ $print_category }}
        </th>
        <th  width="25%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
            Status: {{ $print_active_type }}
        </th>
        <th width="25%" align="center" style="border: solid rgb(255, 255, 255);background-color: white;">
            Date From: {{ $from_date }}
        </th>
        <th width="25%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
            Date To : {{ $to_date }}
        </th>
    </tr>
    </table>
            </th>
        </tr>
<tr>
    <th class="st1">Emp Code</th>
    <th class="st1">Emp Name</th>
    <th class="st1">Designation</th>
    <th class="st1">Department</th>
    <th class="st1">Category</th>
    <th class="st1">Active Type</th>
    <th class="st1">DOJ</th>
    <th class="st1">Sl. No</th>
    <th class="st1">Contract From Date</th>
    <th class="st1">Contract To Date</th>
    <th class="st1">Basic Salary</th>
    <th class="st1">Remarks</th>
</tr>
    </thead>
    <tbody>
        @foreach ($employee_list as $val)
        @php 
        $userd = empDetails($val->emp_no);
        @endphp
        @if(!$userd==0)
        @php 
        $categoryy = getCategory($val->emp_no);
        $contractdata = emp_contract($val->emp_no);
        @endphp
        <tr>
            <td class="text-center">
                @if(!$userd->employee_code=="")
                {{ $userd->employee_code }}
                @endif
            </td>
            <td class="text-center text-primary"> 
                @if(!$userd->emp_name=="")
                {{ $userd->emp_name }}
                @endif
            </td>
            <td class="text-center">{{ getDesgmst($val->emp_no) }}</td>
            <td class="text-center">{{ getDeptmaster($val->emp_no) }}</td>
            <td class="text-center">
                @if(!$userd==0)
                {{ $categoryy['category_name'] }}
                @endif
            </td>
            <td class="text-center">
                @if(!$userd->active_type=="")
                @if($userd->active_type=="I")
                Inactive
                @elseif ($userd->active_type=="A")
                Active
                @endif
                @endif
            </td>
            <td class="text-center">
                @if(!$userd->DOJ=="")
                {{ date('d/m/Y', strtotime($userd->DOJ)) }}
                @endif
            </td>
            <td class="text-center">
                @php
                    $x=1;
                @endphp
                @if ($contractdata!==0)   
                    @foreach ($contractdata as $key2 => $val2)
                    @if(!$val2->cont_start_date=="")
                        <span class="ullis">{{ $x++ }}</span><br>
                        @endif
                    @endforeach
                @endif
            </td>
            <td class="text-center">
                @if ($contractdata!==0)            
                    @foreach ($contractdata as $key2 => $val2)
                    @if(!$val2->cont_start_date=="")
                        <span class="ullis">{{ date('d/m/Y', strtotime($val2->cont_start_date)) }}</span><br>
                    @endif
                    @endforeach
                @endif
            </td>
            <td class="text-center">
                @if ($contractdata!==0)            
                    @foreach ($contractdata as $key2 => $val2)
                    @if(!$val2->cont_end_date=="")
                        <span class="ullis">{{ date('d/m/Y', strtotime($val2->cont_end_date)) }}</span><br>
                    @endif
                    @endforeach
                @endif
            </td>
            <td class="text-center">
                @if ($contractdata!==0)            
                    @foreach ($contractdata as $key2 => $val2)
                        @if(!$val2->sal=="")
                            <span class="ullis">{{ $val2->sal }}</span><br>
                        @endif
                    @endforeach
                @endif
            </td>
            <td class="text-center">
                @if ($contractdata!==0)            
                    @foreach ($contractdata as $key2 => $val2)
                        @if(!$val2->remarks=="")
                            <span class="ullis">{{ $val2->remarks }}</span><br>
                        @endif
                    @endforeach
                @endif
            </td>
            </tr>
        @endif
     @endforeach 
   </tbody>     
        </table> 

    </body>
    </html>     
          