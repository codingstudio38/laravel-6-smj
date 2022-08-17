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
function emp_academic($id)
  {
    $check = DB::table('emp_qualification_dtl')->where(['emp_no'=>$id,'qualification_type'=>"A"])->count();
    if($check > 0){
        $data = DB::table('emp_qualification_dtl')->where(['emp_no'=>$id,'qualification_type'=>"A"])->get();
        return $data;
    } else {
        return 0;
    }
  }
  
  function emp_tec($id)
    {
        $room_slider_count = DB::table('emp_qualification_dtl')->where(['emp_no'=>$id,'qualification_type'=>"T"])->count();
        if($room_slider_count > 0){
        $data = DB::table('emp_qualification_dtl')->where(['emp_no'=>$id,'qualification_type'=>"T"])->get();
        return $data;
        } else {
            return 0;
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
function paginateSerial($data)
{
    return $data->perPage() * ($data->currentPage() - 1);
}
if(isset($_GET['page'])){
    if($_GET['page']==""){
        $serial = 0;               
    } else {
        $serial = paginateSerial($employee_list);                
    }
} else {
    $serial = 0; 
}
$sl1 = $serial+1;
@endphp 
<table class="printtbl" width="100%">
    <thead>
        <tr style="background-color: white">
            <th align="left" colspan="10" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-top: 2px solid rgb(255, 255, 255); background-color: white;">
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
            <th align="center" colspan="10" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-bottom: 2px solid rgb(255, 255, 255);border-top: 2px dashed #000000;background-color: white;">
                <h3 style="font-weight: 600; font-size: 27px; margin-top: 10px; margin-bottom: -0.5px;text-align: center;">EMPLOYEES ADDRESS,QUALIFICATION,PAN,BANK A/C AND ANNUAL REMUNERATION DETAILS REPORT</h3>
            </th>
        </tr>
        <tr style="background-color: white;">
            <th align="center" colspan="10" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255); background-color: rgb(255, 255, 255);">
                <table width="100%" border="0" style="background-color: white;">
                    <tr>
                        <th width="40%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                            Type: {{ $print_type }}
                        </th>
                        <th width="30%" align="center" style="border: solid rgb(255, 255, 255);background-color: white;">
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
            <th class="st1" rowspan="2">Sl No</th>
            <th class="st1" rowspan="2" >Name Of Employee</th>
            <th class="st1" rowspan="2">Active Type</th>
            <th class="st1" rowspan="2" style="width:130px">Address Along With Contact No. If Available</th>
            <th class="st1" rowspan="2">Designation And Nature Of Work Performed</th>
            
            <th class="st1" colspan="2" style="horizontal-align : middle;text-align:center; width: 50%;">Educational  Qualification</th>
            <th class="st1" rowspan="2">Permanent Account Number(PAN)</th>
            <th class="st1" rowspan="2">Amount Of Salary/Remuneration Paid During The Year</th>
            <th class="st1" rowspan="2">Account No. And Bank Address of The Employee In Which Salary/Remuneration Deposited</th>
        </tr>
        <tr>
            <th class="st1" scope="col">Academic</th>
            <th class="st1" scope="col">Technical/Professional</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employee_list as $val)
@php
    $academic1=emp_academic($val->emp_no);
    $emp_tec1=emp_tec($val->emp_no);
@endphp
            <tr>
        <td>{{ $sl1++ }}</td>
        <td>{{ $val->emp_name }}</td>
        <td>
            @if($val->active_type=="I")
            Inactive
            @elseif ($val->active_type=="A")
            Active
            @endif
        </td>
        <td>{{ $val->present_address1 }}<br>{{ $val->present_address2 }}<br>{{ $val->present_address3 }}</td>
        <td>{{ $val->desg_name }}</td>
        <td>
        @if ($academic1!==0)            
        <ul>
        @foreach ($academic1 as $key2 => $val2)
        @if ($val2->emp_quali!==null)
        <li  style="font-size:smaller;">{{ $val2->emp_quali }}</li> 
        @endif
        @endforeach
        </ul>
        @endif
                    </td>
                    <td>
        @if ($emp_tec1!==0)                       
        <ul>
        @foreach ($emp_tec1 as $key1 => $val1)
        @if ($val1->emp_quali!==null)
        <li  style="font-size:smaller;">{{ $val1->emp_quali }}</li> 
        @endif

        @endforeach
        </ul>
        @endif
        </td>
        <td>{{ $val->pan_no }}</td>
        <td>{{ $val->pay_scale }}</td>
        <td>ACC NO- {{ $val->bank_ac_no }}, BANK NAME- {{ $val->bank_name }}, IFSC CODE- {{ $val->ifsc_code }}, ADDRESS- {{ $val->addrerss }}</td>
</tr>
@endforeach
             </tbody>      
        </table> 

    </body>
    </html>     
          