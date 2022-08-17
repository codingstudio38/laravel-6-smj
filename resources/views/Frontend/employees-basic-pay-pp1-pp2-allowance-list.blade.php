@extends('Frontend.employee-report-header')
@extends('Frontend.employee-report-footer')
<body>

<style>
    body{
        height: 98% !important;
    }
     .active>a{
            background-color: #1b55e2 !important;
            color: #fff !important;
            width: 21px !important;
            text-align: center !important;
            font-weight: 700 !important;
            border: 0px !important;
            margin-top: -6px !important;
    }
    </style>
<?php 
if(count($_GET)==0){
   $curl = "";
} else {
   foreach($_GET as $key => $value){
   $data[] = $key."=".$value."&";
   } 
   if(count($data) > 0){
       $seturl=substr(implode("",$data), 0, -1);
       $curl = "?".$seturl;
   } else {
       $curl="";
   }
}
?>    
@php
 date_default_timezone_set('Asia/Kolkata');
 
 $time = date("M d, Y h:i A");
if(count($_GET)==0){
    $category= "all_cat";
    $type= "all_type";
} else { 
    if(isset($_GET['category']) && isset($_GET['type'])){
    $category= $_GET['category'] ;
    $type=$_GET['type'];;
    } else {
    $category= "";
    $type= "";
    }
} 
if(isset($_GET['active_type'])){
      $active_type=$_GET['active_type'];
  } else {
      $active_type= "all";
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

// echo "<pre>";
// print_r($check_cat_exist); 
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
@endphp

        <!--  BEGIN CONTENT AREA  -->
<div  class="main-content">
    <div class="">
        <div class="row">
            <div id="tableCaption" class="col-lg-12 pb-0 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
                                <h5 class="data-heading1 pt-0">The Samaj<span>Report run on: {{ $time }}</span></h5>
                                <h3 class="data-heading p-0">EMPLOYEES BASIC PAY, PP1, PP2, SPL. ALLOWANCE & OTHER ALLOWANCE LIST</h3>

                        <div style="text-align: right; margin-top:-35px; padding-bottom:7px;">
                            <a href="{{ url('/') }}/employees-basic-pay-pp1-pp2-allowance-list-print<?php echo $curl; ?>" class="btn btn-primary" target="_blank" id="print_btn" ><i class="fa fa-print"></i> Print</a>
 
            <a class="btn btn-primary" target="_blank" id="xl_btn" href="{{ url('/') }}/employees-basic-pay-pp1-pp2-allowance-list-xl<?php echo $curl; ?>" >Excel</a>
                            
                            </div>
                            </div>
                             
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="padding-right:10px;  background-color: #ece9e9 !important;padding-left:16px !important;">

                                        
            <form method="get" id="mySearchForm" action="#" class="form-inline report-area" method="GET">
                <label>Employee Type:</label>
            <select name="type" class="col-lg-2 form-control" required>
                <option value="all_type" @php if($type=="all_type"){echo "selected";} @endphp >All</option>
                @foreach ($employee_type as $val)
                @if ($val->emp_type=="PE")
                <option value="{{ $val->emp_type }}" @php if($type==$val->emp_type){echo "selected";} @endphp >PERMANENT</option>
                @elseif ($val->emp_type=="PR")
                <option value="{{ $val->emp_type }}" @php if($type==$val->emp_type){echo "selected";} @endphp >PROBATION</option>
                @elseif ($val->emp_type=="CO")
                <option value="{{ $val->emp_type }}" @php if($type==$val->emp_type){echo "selected";} @endphp >CONTARCT</option>
                @endif
                @endforeach
            </select>
                &nbsp;&nbsp;
                <label>Category:</label>
            <select name="category" class="col-lg-2 form-control" required>
                <option value="all_cat" @php if($category=="all_cat"){echo "selected";} @endphp >All Category</option>
            @foreach ($categories as $val)
                <option value="{{ $val->category_code }}" @php if($category==$val->category_code){echo "selected";} @endphp>{{ $val->category_name }}</option>
                @endforeach
            </select>
            &nbsp;&nbsp;
        <label>Emp Status:</label>
        <select name="active_type" class="col-lg-2 form-control" required>
            <option value="all" @php if($active_type=="all"){echo "selected";} @endphp>All</option>
            <option value="A" @php if($active_type=="A"){echo "selected";} @endphp>Active</option>
            <option value="I" @php if($active_type=="I"){echo "selected";} @endphp>Inactive</option>
        </select>
        &nbsp;&nbsp;
            
                    <button type="submit" id="searchsubmit" class="btn btn-primary report-btn" value="">Search</button>
                    &nbsp;&nbsp;
                    <a href="{{ url('/') }}/employees-basic-pay-pp1-pp2-allowance-list" class="btn btn-info " style="padding: 10px 15px;"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                </form>
<script>
// document.getElementById("searchsubmit").addEventListener("click", function (e) {
//     //e.preventDefault();
//     alert();
//     document.getElementById("mySearchForm").submit();
// });
</script>


                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area"  style="padding-bottom: 0px;">
                        
<div class="table-responsive" style="margin-top: 5px;height:595px; overflow:scroll;">
           <style> 
            .tbh5{
                text-decoration: underline;
                margin-left:20px; 
                margin-top: 5px;
            }
            .tbh6{
                text-decoration: underline;
                margin-left:20px; 
                margin-top: 5px;
                font-style: italic;
                font-size: inherit;
                font-weight: bolder;
            }
            </style>              
            <table class="table mb-4" id="myTable" width="100%">
<thead>
    <tr>
        <th class="text-center">Emp Code</th>
        <th>Name Of The Employee</th>
        <th>Designation</th>
        <th>Department</th>
        <th>Active Type</th>
        <th>Pay Grade</th>
        <th>Basic Pay/Cont. Salary</th>
        <th>pp_1</th>
        <th>pp_2</th>
        <th>Spl Allowance</th>
        <th>Other Allowance</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach($utype as $k=>$ty)

    <tr>
        <td colspan="12" align="left" style="padding: 0px; border-bottom: 1px solid white; ">
            <h5 class="tbh5" style="font-weight: 600;">{{ @gtype($ty) }}</h5>
        </td>
    </tr>

    @foreach ($categories as $c=>$cat)
    @if(array_key_exists($ty."_".$cat->category_code,$check_cat_exist))
    <tr style="background: #e4eaef;">
        <td colspan="12" align="left" style="padding: 0px; border-bottom: 1px solid white; ">
            <h6 class="tbh6">{{ $cat->category_name }}</h6>
        </td>
    </tr>
    @endif
    @foreach($employee_list as $val)
    @if ($ty==$val->emp_type && $cat->category_code== $val->catg)
        @php
            $pay = getPay($val->emp_no);
        @endphp
    <tr>  
        <td class="text-center">
            {{ $val->employee_code}}
        </td>
        <td class="text-center text-primary">{{ $val->emp_name }}</td> 
        <td class="text-center">
            @php
                $dese = getDesgmst($val->emp_no);
                echo @$dese->desg_name;
            @endphp
        </td>
        <td class="text-center">
            @php
                $dep = getDeptmaster($val->emp_no);
                echo @$dep->dept_name;
            @endphp
        </td>
        <td class="text-center">
            @if($val->active_type=="I")
            <button style="font-size: initial;padding: revert;" class="btn btn-danger btn-sm">Inactive</button>
            @elseif ($val->active_type=="A")
            <button style="font-size: initial;padding: revert;" class="btn btn-success btn-sm">Active</button>
            @endif
        </td>
        <td class="text-center">
            @php
                echo @$pay->pay_grade_code;
            @endphp
        </td>
        <td class="text-center">
            @if ($val->emp_type=="CO")
            {{ $val->CONT_SAL }}
            @else
            {{ $val->new_basic_pay }}
            @endif
        </td> 
        <td class="text-center">{{ $val->pp1 }}</td>
        <td class="text-center">{{ $val->pp2 }}</td>
        <td class="text-center">
            {{ $val->spl_allow }}
            {{-- @php  
                echo @$pay->special_allowance;
            @endphp --}}
        </td>
        <td class="text-center">
            {{ $val->conv_allow }}
            {{-- @php
            echo @$pay->other_special_allowance;
            @endphp --}}
        </td>
        <td>
            <a onclick="storetype('OFFICIAL_DETAILS','{{ $val->emp_no }}')" href="javascript:void(0)" title="Edit" class="editbtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
            </a> 
        </td>
    </tr>
    @else
    @endif
    @endforeach 

    @endforeach
    
        
    @endforeach
                </tbody>
    <tfoot>
        <tr>
            <td align="right" colspan="12">{{ $employee_list->links('paginate.rp2_pager1') }} </td>
        </tr>
    </tfoot>
                                
                            </table>
                    
                        </div>


                    </div>
                        
                </div>
            </div>

        </div>
    </div>

        </div>

            <script type="text/javascript">
                function PrintTable() {
                    var printWindow = window.open('', '', 'height=800,width=800');
                    printWindow.document.write('<html><head><title>Table Contents</title>');
                    var style = '<style type = "text/css">';
                        style = style + "body{ font-family: Arial;font-size: 10pt; }";
                        style = style + "table{border: 1px solid #ccc;border-collapse: collapse;}";
                        style = style + "table th{ background-color: #F7F7F7; color: #333;font-weight: bold;}";
                        style = style + "table th, table td{padding: 5px; border: 1px solid #ccc;}";
                        style = style + ".st1{color:black; font-weight: 700; font-size: 13px; letter-spacing: 1px; text-transform: uppercase;}";
                        style = style + "</style>";
                    printWindow.document.write(style);
                    printWindow.document.write('</head>');
                    printWindow.document.write('<body>');
                    var divContents = document.getElementById("dvContents").innerHTML;
                    printWindow.document.write(divContents);
                    printWindow.document.write('</body>');
                    printWindow.document.write('</html>');
                    printWindow.document.close();
                    printWindow.print();
                }
            </script>








        <script>
            var g_url = `{{ url('/') }}`;
            function storetype(type,num){
              window.localStorage.clear();
              var expires = "";
              var date = new Date();
              let data = {"lastbtn":type,"date": date};
              window.localStorage.setItem("samaj_data", JSON.stringify(data));
              date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
              expires = "; expires=" + date.toUTCString();
              document.cookie = "samaj_data" + "=" + (type || "") + expires + "; path=/";
              window.open(`${g_url}/employee_edit_master?search_emp=${num}`, '_blank')
             }
        </script>
        <!--  END CONTENT AREA  -->
     