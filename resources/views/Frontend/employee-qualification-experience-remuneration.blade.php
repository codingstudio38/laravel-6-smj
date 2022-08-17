@extends('Frontend.employee-report-header')
{{-- @extends('Frontend.employee-report-footer') --}}
<body>

     <style>
        body{
  height: 98%;
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
 
if(isset($_GET['category'])){
      $category=$_GET['category'];
  } else {
      $category= "";
  } 
  if(isset($_GET['type'])){
      $type=$_GET['type'];
  } else {
      $type= "";
  }
  if(isset($_GET['active_type'])){
      $active_type=$_GET['active_type'];
  } else {
      $active_type= "";
  }

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
    function emp_experience($id)
    {
        $room_slider_count = DB::table('emp_experience_dtl')->where(['emp_no'=>$id])->count(); 
        if($room_slider_count > 0){
        $data = DB::table('emp_experience_dtl')->where(['emp_no'=>$id])->get();
        return $data;
        } else {
            return 0;
        }
        
    } 
use Carbon\Carbon;
function counter($from, $to){
    if($to==""){
        return 0;
    } else if($from==""){
        return 0;
    } else {
        $date = Carbon::parse($from)->diff($to)->format('%yY');
        return $date;
    }
}


function paginateSerial($data)
{
    return $data->perPage() * ($data->currentPage() - 1);
}
$serial = paginateSerial($employee_list); 
$sl = $serial+1;
$sl1 = $serial+1;
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
    <h3 class="data-heading p-0">EMPLOYEE QUALIFICATION , EXPERIENCE AND REMUNERATION REPORT</h3>
    <div style="text-align: right; margin-top:-35px; padding-bottom:7px;">
        <a href="{{ url('/') }}/employee-qualification-experience-remuneration-print<?php echo $curl; ?>" class="btn btn-primary" target="_blank" id="print_btn" ><i class="fa fa-print"></i> Print</a>

        <a class="btn btn-primary" target="_blank" id="xl_btn" href="{{ url('/') }}/employee-qualification-experience-remuneration-xl<?php echo $curl; ?>" >Excel</a>
        
      </div>
</div>
 

<div class="col-xl-12 col-md-12 col-sm-12 col-12" style="padding-right:0px !important;padding-left:0px !important;">
          
    <form method="GET" action="#" class="form-inline report-area">

        <label>Employee Type:</label>
        
        <select name="type" class="form-control" required>
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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>Category:</label>
      <select name="category" class="form-control" required>
        <option value="all_cat" @php if($category=="all_cat"){echo "selected";} @endphp >All Category</option>
        @foreach ($categories as $val)
        <option value="{{ $val->category_code }}" @php if($category==$val->category_code){echo "selected";} @endphp>{{ $val->category_name }}</option>
        @endforeach
      </select>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>Emp Status:</label>
        <select name="active_type" class="col-lg-2 form-control" required>
            <option value="all" @php if($active_type=="all"){echo "selected";} @endphp>All</option>
            <option value="A" @php if($active_type=="A"){echo "selected";} @endphp>Active</option>
            <option value="I" @php if($active_type=="I"){echo "selected";} @endphp>Inactive</option>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
      
      <button type="submit" class="btn btn-primary report-btn" value="">Search</button>&nbsp;
      <a href="{{ url('/') }}/employee-qualification-experience-remuneration" class="btn btn-info " style="padding: 10px;"><i class="fa fa-refresh" aria-hidden="true"></i></a>
      </form>






</div>
</div>
</div>
<div class="widget-content widget-content-area"  style="padding-bottom: 0px;">

    <div class="table-responsive" style="margin-top: 5px;height:595px; overflow:scroll;">
        {{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Emp No." title="Type in a SL No" class="form-control " style="width: 15%; float: right; margin-bottom: 5px;">
         --}}
       
        
       <table id="myTable" class="table mb-4">
          <thead>
                <tr>
                <th class="t-th" rowspan="2">Sl No</th>
                <th class="t-th" rowspan="2" >Employee Name</th>
                <th class="t-th" rowspan="2">Designation</th>
                <th class="t-th" rowspan="2">Department</th>
                <th class="t-th" rowspan="2">Date Of Birth</th>
                <th class="t-th" rowspan="2">Date Of Joining</th>
                <th class="t-th" rowspan="2">Active Type</th>
               
                <th class="t-th" colspan="2" style="horizontal-align : middle;text-align:center;  ">Educational  Qualification</th>
                <th class="t-th" colspan="2" style="horizontal-align : middle;text-align:center;  ">Experience</th>
                <th class="t-th" rowspan="2">Basic Salary</th>
                <th class="t-th" rowspan="2">Allowances</th>
                <th class="t-th" rowspan="2">Gross Salary</th>
                <th class="t-th" rowspan="2">Net Salary</th>
                <th class="t-th" rowspan="2">Action</th>

            </tr>

            <tr>
                <th class="t-th" scope="col">Academic</th>
                <th class="t-th" scope="col">Technical/Professional</th>
                <th class="t-th" scope="col">No. Of Years</th>
                <th class="t-th" scope="col">Sector</th>
            </tr>
            </thead>
             <tbody>
            @foreach ($employee_list as $val)
            @php
            $academic1 = emp_academic($val->emp_no);
            $emp_tec1 = emp_tec($val->emp_no);
            $experience1 = emp_experience($val->emp_no);
            @endphp
                <tr> 
                    <td class="text-center">{{ $sl++ }}</td>
                    <td class="text-center">{{ $val->emp_name }}</td> 
                    <td class="text-center">{{ $val->desg_name }}</td>
                    <td class="text-center">{{ $val->dept_name }}</td>
                    <td class="text-center">
                        @if(!$val->DOB=="")
                       {{ date('d/m/Y', strtotime($val->DOB)) }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(!$val->DOJ=="")
                        {{ date('d/m/Y', strtotime($val->DOJ)) }}
                         @endif
                    </td>
                    <td >
                        <center>
                        @if($val->active_type=="A")
                            <span class="badge badge-success">Active</span>
                        @else
                             <span class="badge badge-danger">Inactive</span>
                        @endif
                       </center> 
                    </td>
                               
                    <td>
                        @if ($academic1!==0)            
                        <ul>
                        @foreach ($academic1 as $key2 => $val2)
                        @if ($val2->emp_quali!==null)
                    <li  style="font-size:smaller; font-weight: 800;">{{ $val2->emp_quali }}</li> 
                        @endif
                        @endforeach
                        </ul>
                        @endif
                            </td>
                            <td>
                            @if($emp_tec1!==0)                       
                            <ul>
                                @foreach ($emp_tec1 as $key1 => $val1)
                                @if ($val1->emp_quali!==null)
                                <li style="font-size:smaller; font-weight: 800;">{{ $val1->emp_quali }}</li> 
                                @endif
                                @endforeach
                            </ul>
                            @endif
                        </td>

                    <td class="text-center">
                        @if ($experience1!==0)   
                        <ul>
                            @foreach ($experience1 as $key1 => $val3)
                            @if ($val3->sector!==null)
                            <li style="font-size:smaller; font-weight: 800;">{{ counter($val3->start_date,$val3->end_date) }}</li> 
                            @endif
                            @endforeach
                        </ul>     
                        @endif
                    </td>

                    <td>
                        @if ($experience1!==0)                       
                        <ul>
                            @foreach ($experience1 as $key1 => $val2)
                            @if ($val2->sector!==null)
                            <li style="font-size:smaller; font-weight: 800;">{{ $val2->sector }}</li> 
                            @endif
                            @endforeach
                        </ul>
                        @endif
                        </td>
                    <td class="text-center">{{ $val->new_basic_pay }}</td>
                    <td class="text-center">{{ $val->spl_allow }}</td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center">
                        <a onclick="storetype('OFFICIAL_DETAILS','{{ $val->emp_no }}')" href="javascript:void(0)" title="Edit" class="editbtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </a>
                    </td>
                @endforeach 
            </tbody> 
            <tfoot>
                <tr>
                    <td align="right" colspan="16">{{ $employee_list->links('paginate.rp2_pager4') }} </td>
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

function myFunction() {
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("myInput");
filter = input.value.toUpperCase();
table = document.getElementById("myTable");
tr = table.getElementsByTagName("tr");
for (i = 0; i < tr.length; i++) {
td = tr[i].getElementsByTagName("td")[0];
if (td) {
txtValue = td.textContent || td.innerText;
if (txtValue.toUpperCase().indexOf(filter) > -1) {
tr[i].style.display = "";
} else {
tr[i].style.display = "none";
}
}       
}
}
</script>

<script>
let dateDropdown = document.getElementById('date-dropdown');

let currentYear = new Date().getFullYear();
let earliestYear = 1970;

while (currentYear >= earliestYear) {
let dateOption = document.createElement('option');
dateOption.text = currentYear;
dateOption.value = currentYear;
dateDropdown.add(dateOption);
currentYear -= 1;
}
</script>
<script src="{{url('/')}}/public/assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="{{url('/')}}/public/bootstrap/js/popper.min.js"></script>
<script src="{{url('/')}}/public/bootstrap/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/public/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{url('/')}}/public/assets/js/app.js"></script>
<script type="text/javascript">
var doc = new jsPDF();
var specialElementHandlers = {
'#editor': function (element, renderer) {
return true;
}
};

$('#cmd').click(function () {
doc.fromHTML($('#content').html(), 15, 15, {
'width': 170,
'elementHandlers': specialElementHandlers
});
doc.save('sample-file.pdf');
});
</script>
<script>
$(document).ready(function() {
App.init();
});
</script>

<script src="{{url('/')}}/public/plugins/highlight/highlight.pack.js"></script>
<script src="{{url('/')}}/public/assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
<script src="{{url('/')}}/public/assets/js/scrollspyNav.js"></script>
<script>
checkall('todoAll', 'todochkbox');
$('[data-toggle="tooltip"]').tooltip()
</script>

<!-- END PAGE LEVEL CUSTOM SCRIPTS -->
</body>
</html>