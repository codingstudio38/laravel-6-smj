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

if(isset($_GET['from_date']) && isset($_GET['to_date']) && isset($_GET['active_type'])){
    if($_GET['from_date']==""){
    $from_date = "All"; 
} else {
    $from_date = date('d-M-Y', strtotime($_GET['from_date']));  
}
if($_GET['from_date']==""){
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
$from_date = "All";  
$to_date = "All";  
$print_active_type = "All";  
}

@endphp 
<table class="printtbl" width="100%">
    <thead>
        <tr style="background-color: white">
            <th align="left" colspan="9" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-top: 2px solid rgb(255, 255, 255); background-color: white;">
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
            <th align="center" colspan="9" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-bottom: 2px solid rgb(255, 255, 255);border-top: 2px dashed #000000;background-color: white;">
                <h3 style="font-weight: 600; font-size: 27px; margin-top: 10px; margin-bottom: -0.5px;text-align: center;">RETIREMENT DUE REPORTS</h3>
            </th>
        </tr>
        <tr style="background-color: white;">
            <th align="center" colspan="9" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255); background-color: rgb(255, 255, 255);">
<table width="100%" border="0" style="background-color: white;">
    <tr>
        <th width="33%" align="center" style="border: solid rgb(255, 255, 255);background-color: white;">
            Date From: {{ $from_date }}
        </th>
        <th width="33%" align="center" style="border: 2px solid rgb(255, 255, 255);background-color: white;">
            Date To : {{ $to_date }}
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
            <th class="st1">Retirement Date</th>
            <th class="st1">Category</th>
        </tr>
    </thead>
    <tbody>
        <tbody>
            @foreach ($employee_list as $val)
            <tr>
                <td>{{ $val->employee_code }}</td>
                <td>{{ $val->emp_name }}</td>
                <td>{{ $val->desg_name }}</td>
                <td>{{ $val->dept_name }}</td>
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
                <td>
                    @if(!$val->retirement_date=="")
                    {{ date('d/m/Y', strtotime($val->retirement_date)) }}
                    @endif
                </td>
                <td>{{ $val->category_name }}</td>
                
                </tr>
            @endforeach  

        </tbody>  
        </table> 

    </body>
    </html>     
          