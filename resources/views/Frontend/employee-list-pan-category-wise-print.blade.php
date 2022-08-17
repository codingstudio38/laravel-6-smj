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
function getDesgmst($num)
  {
    $user = DB::table('emp_mst')->where(['emp_no'=>$num])->first();
    return DB::table('desg_mst')->where(['desg_code'=>$user->desg_code])->first();
  }

  function getDeptmaster($id)
  {
    return DB::table('dept_master')->where(['dept_no'=>$id])->first();
  }  
$check_catg = array();
foreach ($employee_list as $key => $val) {
    $check_catg[] = $val->catg;
}
$ucatg = array_unique($check_catg);  
function gettypetbl($type)
    {
    if($type =="all"){
        return "All";
    } else {
        $data = DB::table('employee_type')->where(['emp_type_code'=>$type])->first();
        return $data->employee_type_name;
    }
    }
if(isset($_GET['pan']) && isset($_GET['type']) && isset($_GET['active_type'])){
    $print_type = gettypetbl($_GET['type']);
    if($_GET['active_type']=="all"){
    $print_active_type = "All";  
    } elseif($_GET['active_type']=="A") {
    $print_active_type = "Active";  
    } elseif($_GET['active_type']=="I") {
    $print_active_type = "Inactive";  
    }
    if($_GET['pan']=="all"){
    $print_pan = "All";  
    } elseif($_GET['pan']=="y") {
    $print_pan = "Yes";  
    } elseif($_GET['pan']=="n") {
    $print_pan = "No";  
    }
    
}  else {
    $print_pan = "All";  
    $print_type = "All";  
    $print_active_type = "All";  
} 
@endphp 
<table class="printtbl" width="100%">
    <thead>
        <tr style="background-color: white">
            <th align="left" colspan="8" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-top: 2px solid rgb(255, 255, 255); background-color: white;">
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
            <th align="center" colspan="8" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-bottom: 2px solid rgb(255, 255, 255);border-top: 2px dashed #000000;background-color: white;">
                <h3 style="font-weight: 600; font-size: 27px; margin-top: 10px; margin-bottom: -0.5px;text-align: center;">EMPLOYEES LIST(PAN/ Category Wise)</h3>
            </th>
        </tr>
        <tr style="background-color: white;">
            <th align="center" colspan="8" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255); background-color: rgb(255, 255, 255);">
<table width="100%" border="0" style="background-color: white;">
    <tr>
        <th width="33%" align="center" style="border: solid rgb(255, 255, 255);background-color: white;">
            Category: {{ $print_type }}
        </th>
        <th width="33%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
            PAN Exist : {{ $print_pan }}
        </th>
        <th  width="33%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
            Status: {{ $print_active_type }}
        </th>
    </tr>
    </table>
            </th>
        </tr>
        <tr>
            <th class="st1">Emp Code</th>
            <th class="st1">Employee Name</th>
            <th class="st1">Designation</th>
            <th class="st1">Department</th>
            <th class="st1">Active Type</th>
            <th class="st1">DOB</th>
            <th class="st1">DOJ</th>
            <th class="st1">PAN</th>
        </tr>
    </thead>
    
    <tbody> 
        @foreach ($categories as $v)
        @if(in_array($v->category_code,$ucatg))
            <tr style="background: aliceblue;">
                <td colspan="8" align="left" style="padding: 0px; ">
                    <h5 class="tbh5" style="font-weight: 600;text-decoration: underline;">{{ $v->category_name }}</h5>
                </td>
            </tr> 
        @endif
        @foreach ($employee_list as $val)
        @if($v->category_code==$val->catg)
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
        $dese = getDeptmaster($val->dept_no);
        echo @$dese->dept_name;
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
                @if(!$val->DOB=="")
                {{ date('d/m/Y', strtotime($val->DOB)) }}
                @endif
            </td>
            <td>
                @if(!$val->DOJ=="")
                {{ date('d/m/Y', strtotime($val->DOJ)) }}
                @endif
            </td>
            <td>{{ $val->pan_no }}</td>
            </tr>
            @endif
            @endforeach 
            @endforeach   
    </tbody>       
        </table> 

    </body>
    </html>     
          