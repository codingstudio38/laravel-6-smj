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
.ullis{
        font-size:smaller; font-weight: 800;text-align: start;
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
    $count2 = DB::table('emp_qualification_dtl')->where(['emp_no'=>$id,'qualification_type'=>"T"])->count();
    if($count2 > 0){
    $data = DB::table('emp_qualification_dtl')->where(['emp_no'=>$id,'qualification_type'=>"T"])->get();
    return $data;
    } else {
        return 0;
    }
    
}
function emp_remark($id)
{
    $count2 = DB::table('emp_remark_dtl')->where(['emp_no'=>$id])->count();
    if($count2 > 0){
    $data = DB::table('emp_remark_dtl')->where(['emp_no'=>$id])->get();
    return $data;
    } else {
        return 0;
    }
    
}
use Carbon\Carbon;
function counter($from,$to){
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
if(isset($_GET['category']) && isset($_GET['type']) && isset($_GET['active_type']) && isset($_GET['from'])  && isset($_GET['to'])){
    $print_category = getcat($_GET['category']);  
    $print_type = gettypetbl($_GET['type']);
    if($_GET['active_type']=="all"){
    $print_active_type = "All";  
    } elseif($_GET['active_type']=="A") {
    $print_active_type = "Active";  
    } elseif($_GET['active_type']=="I") {
    $print_active_type = "Inactive";  
    }
if($_GET['from']==""){
    $print_from= "All";
} else {
    $print_from= date('d-M-Y', strtotime($_GET['from']));
}
if($_GET['to']==""){
    $print_to= "All";
} else {
    $print_to = date('d-M-Y', strtotime($_GET['to']));  
}
}  else {
    $print_from = "All";  
    $print_to = "All";  
    $print_category = "All";  
    $print_type = "All";  
    $print_active_type = "All";  
}
@endphp 
<table class="printtbl" width="100%">
    <thead>
        <tr style="background-color: white">
            <th align="left" colspan="13" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-top: 2px solid rgb(255, 255, 255); background-color: white;">
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
            <th align="center" colspan="13" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-bottom: 2px solid rgb(255, 255, 255);border-top: 2px dashed #000000;background-color: white;">
                <h3 style="font-weight: 600; font-size: 27px; margin-top: 10px; margin-bottom: -0.5px;text-align: center;">EMPLOYEE YEAR OF SERVICE, QUALIFICATION AND PAY GRADE DETAILS REPORT</h3>
            </th>
        </tr>
        <tr style="background-color: white;">
            <th align="center" colspan="13" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255); background-color: rgb(255, 255, 255);">
                <table width="100%" border="0" style="background-color: white;">
                    <tr>
                        <th width="20%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                            Type: {{ $print_type }}
                        </th>
                        <th width="20%" align="center" style="border: solid rgb(255, 255, 255);background-color: white;">
                            Category: {{ $print_category }}
                        </th>
                        <th  width="20%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                            Status: {{ $print_active_type }}
                        </th>
                        <th  width="20%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                            From: {{  $print_from }}
                        </th>
                        <th  width="20%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
                            To: {{  $print_to }}
                        </th>
                    </tr>
                    </table>
            </th>
        </tr>
            <tr>
                <th class="st1" rowspan="2">Emp. Code</th>
                <th class="st1" rowspan="2">Employee Name</th>
                <th class="st1" rowspan="2">Designation</th>
                <th class="st1" rowspan="2">Department</th>
                <th class="st1" rowspan="2">Active Type</th>
                <th class="st1" rowspan="2">DOB</th>
                <th class="st1" rowspan="2">DOJ</th>
                <th class="st1" rowspan="2">Date Of Confirmation</th>
                <th class="st1" rowspan="2">Year Of Service</th>
                <th class="st1" colspan="2" style="horizontal-align : middle;text-align:center; width: 50%;">Educational  Qualification</th>
                <th class="st1" rowspan="2">Grade In Majithia WageBoard</th>
                <th class="st1" rowspan="2">Remarks</th>
            </tr>

            <tr>
                <th class="st1" scope="col">Academic</th>
                <th class="st1" scope="col">Technical/Professional</th>
            </tr>
                    </thead>
    <tbody>
@foreach ($employee_list as $val)
@php
$academic1 = emp_academic($val->emp_no);
$technical1 =emp_tec($val->emp_no);
$remark =emp_remark($val->emp_no);
@endphp
<tr>
    <td>{{ $val->employee_code}}</td>
    <td>{{ $val->emp_name}}</td>
    <td>{{ $val->desg_name}}</td>
    <td>{{ $val->dept_name}}</td>
    <td>
        @if($val->active_type=="I")
        Inactive
        @elseif ($val->active_type=="A")
        Active
        @endif
    </td>
    <td>
        @if(!$val->DOB=="")
        {{ date('d/m/Y', strtotime($val->DOB))}}
        @endif
    </td>
    <td>
        @if(!$val->DOJ=="")
        {{ date('d/m/Y', strtotime($val->DOJ))}}
        @endif
    </td> 
    <td>
        @if(!$val->confirm_date=="")
        {{ date('d/m/Y', strtotime($val->confirm_date))}}
        @endif
    </td>
    <td>
        @if(!$val->DOJ=="")
            {{ counter($val->DOJ,$val->retirement_date)}}
        @endif
    </td>
    <td>
@if ($academic1!==0)            
<ol>
@foreach ($academic1 as $key2 => $val2)
@if(!$val2->emp_quali=="")
<li class="ullis">{{ @$val2->emp_quali }}</li> 
@endif
@endforeach
</ol>
@endif     
 </td>
    <td>
@if ($technical1!==0)                       
<ol>
@foreach ($technical1 as $key1 => $val1)
    @if(!$val1->emp_quali=="")
    <li class="ullis">{{ @$val1->emp_quali }}</li> 
    @endif
@endforeach
</ol>
@endif                                        
    </td>
    <td>{{ $val->pay_grade_code }}</td>
    <td>
        @if ($remark!==0)                       
        <ol>
            @foreach ($remark as $key1 => $valc)
            @if(strlen($valc->remark_text) > 8)
                <li class="ullis">{{ substr($valc->remark_text,0,8) }}...</li> 
            @else
                <li class="ullis">{{ $valc->remark_text }}</li> 
            @endif
            @endforeach
        </ol>
        @endif 
    </td>
    
</tr>
@endforeach
             </tbody>      
        </table> 

    </body>
    </html>     
          