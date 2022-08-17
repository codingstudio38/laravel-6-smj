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
        $count2 = DB::table('emp_qualification_dtl')->where(['emp_no'=>$id,'qualification_type'=>"T"])->count();
        if($count2 > 0){
        $data = DB::table('emp_qualification_dtl')->where(['emp_no'=>$id,'qualification_type'=>"T"])->get();
        return $data;
        } else {
            return 0;
        }
        
    }

    function emp_experience($id)
    {
        $count = DB::table('emp_experience_dtl')->where(['emp_no'=>$id])->count();
        if($count > 0){
        $data = DB::table('emp_experience_dtl')
        ->select('orgn_name','sector','position','start_date','end_date')
        ->where(['emp_no'=>$id])
        ->get();
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
            <th align="left" colspan="15" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-top: 2px solid rgb(255, 255, 255); background-color: white;">
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
            <th align="center" colspan="15" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255);border-bottom: 2px solid rgb(255, 255, 255);border-top: 2px dashed #000000;background-color: white;">
                <h3 style="font-weight: 600; font-size: 27px; margin-top: 10px; margin-bottom: -0.5px;text-align: center;">EMPLOYEE QUALIFICATION AND EXPERIENCE DETAILS REPORT</h3>
            </th>
        </tr> 
        <tr style="background-color: white;">
            <th align="center" colspan="15" style="border-left: 2px solid rgb(255, 255, 255);border-right: 2px solid rgb(255, 255, 255); background-color: rgb(255, 255, 255);">
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
            <th class="st1" align="center" rowspan="2">Sl.No</th>
            <th class="st1" align="center" rowspan="2" >Employee Name</th>
            <th class="st1" align="center" rowspan="2" style="width:130px">Designation</th>
            <th class="st1" align="center" rowspan="2">Department</th>
            <th class="st1" align="center" rowspan="2">Active Type</th>
            <th class="st1" align="center" colspan="5" style="horizontal-align : middle;text-align:center; width: 50%;">Educational  Details</th>
            <th class="st1" align="center" colspan="4" style="horizontal-align : middle;text-align:center; width: 50%;">Experience Details</th>
            <th ></th>
          </tr>
          <tr> 
            <th class="st1" align="center" scope="col">Academic-Degree/Details</th>
            <th class="st1" align="center" scope="col">Professional/Technical Degree/Details</th>
            <th class="st1" align="center" scope="col">Board/University</th>
            <th class="st1" align="center" scope="col">Year Of Passing</th>
            <th class="st1" align="center" scope="col">% Of Mark</th>
            <th class="st1" align="center" scope="col">Organisation Name</th>
            <th class="st1" align="center" scope="col">Position</th>
            <th class="st1" align="center" scope="col">from Date</th>
            <th class="st1" align="center" scope="col">To Date</th>
            <th class="st1" align="center"scope="col">Sector</th>
          </tr>
    </thead>
    <tbody>
        @foreach ($employee_list as $val)
        @php
            $academic = emp_academic($val->emp_no);
            $technical =emp_tec($val->emp_no);
            $experience = emp_experience($val->emp_no);
        @endphp
        <tr> 
            <td>{{ $sl1++ }}</td>
            <td class="text-center text-primary">{{ $val->emp_name }}</td>
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
    @if ($academic!==0)
    <ol>
        @foreach ($academic as $key2 => $val2)
            @if(!$val2->emp_quali=="")
            <li class="ullis">{{ @$val2->emp_quali }}</li> 
            @endif
        @endforeach
    </ol>
    @endif
    </td>
    <td>
    @if ($technical!==0)                       
    <ol>
        @foreach ($technical as $key1 => $val1)
            @if(!$val1->emp_quali=="")
            <li class="ullis">{{ @$val1->emp_quali }}</li> 
            @endif
        @endforeach
    </ol>
    @endif  
    </td>
    <td>
        <c style="list-style: none;font-size: initial;font-weight: 600; text-decoration: underline;text-align: start;">Technical</c> <br>
    @if ($technical!==0)
    <ol>
        @foreach ($technical as $key3 => $val3)
        @if(!$val3->institution=="")
        <li class="ullis">{{ @$val3->institution }}</li> 
        @endif
        @endforeach
    </ol>
    @endif 
    <c style="list-style: none;font-size: initial;font-weight: 600; text-decoration: underline;text-align: start;">Academic</c>      
    @if ($academic!==0)     
    <ol>
        @foreach ($academic as $key4x3 => $val43x)
        @if(!$val43x->institution=="")
        <li style="font-size:smaller; text-align: start;">{{ @$val43x->institution }}</li> 
        @endif
        @endforeach
    </ol> 
    @endif  
    
    </td>
    <td>
        <c style="list-style: none;font-size: initial;font-weight: 600; text-decoration: underline;text-align: start;">Technical</c><br>      
    @if ($technical!==0)                       
    <ol>
        @foreach ($technical as $key4 => $val4)
        @if(!$val4->year_passing=="")
        <li style="font-size:smaller; text-align: start;">{{ @$val4->year_passing }}</li> 
        @endif
        @endforeach
    </ol>
    @endif  
    <c style="list-style: none;font-size: initial;font-weight: 600; text-decoration: underline;text-align: start;">Academic</c>     
    @if ($academic!==0)          
    <ol>
        @foreach ($academic as $key44 => $val44)
        @if(!$val44->year_passing=="")
        <li style="font-size:smaller; text-align: start;">{{ @$val44->year_passing }}</li> 
        @endif
        @endforeach
    </ol>
    @endif
    </td>
    <td>
    <c style="list-style: none;font-size: initial;font-weight: 600; text-decoration: underline;text-align: start;">Technical</c> <br>    
    @if ($technical!==0)   
    <ol>
        @foreach ($technical as $key5 => $val5)
        @if(!$val5->mark_perc=="")
        <li style="font-size:smaller; text-align: start;">{{ @$val5->mark_perc }}</li> 
        @endif
        @endforeach
    </ol>
    @endif
    <c style="list-style: none;font-size: initial;font-weight: 600; text-decoration: underline;text-align: start;">Academic</c>     
    @if ($academic!==0)   
    <ol>
        @foreach ($academic as $key55 => $val55)
        @if(!$val55->mark_perc=="")
        <li style="font-size:smaller; text-align: start;">{{ @$val55->mark_perc }}</li> 
        @endif
        @endforeach
    </ol>
    @endif
    
    </td>
            <td>
    
    @if ($experience!==0)        
    <ol>
        @foreach ($experience as $key6 => $val6)
        @if(!$val6->orgn_name=="")
        <li style="font-size:smaller; text-align: start;">{{ @$val6->orgn_name }}</li> 
        @endif
        @endforeach
    </ol>  
    @endif          
    
            </td>
            <td>
    
    @if ($experience!==0)        
    <ol>
        @foreach ($experience as $key7 => $val7)
        @if(!$val7->position=="")
        <li style="font-size:smaller; text-align: start;">{{ @$val7->position }}</li> 
        @endif
        @endforeach
    </ol>  
    @endif          
    
            </td>
            <td>
    
    @if ($experience!==0)        
    <ol>
        @foreach ($experience as $key8 => $val8)
        @if(!$val8->start_date=="")
        <li style="font-size:smaller; text-align: start;"> {{ date('d/m/Y', strtotime($val8->start_date)) }}</li> 
        @endif 
        @endforeach
    </ol>  
    @endif          
    
            </td>
            <td>
    
    @if ($experience!==0)        
    <ol>
        @foreach ($experience as $key9 => $val9)
        @if(!$val9->end_date=="")
        <li style="font-size:smaller; text-align: start;"> {{ date('d/m/Y', strtotime($val9->end_date)) }}</li> 
        @endif 
        @endforeach
    </ol>  
    @endif          
    
            </td>
            <td>
    
    @if ($experience!==0)  
    <ol>
        @foreach ($experience as $key1 => $val11)
        @if(!$val11->sector=="")
        <li style="font-size:smaller; text-align: start;"> {{ @$val11->sector }}</li> 
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
          