@include('Frontend.employee-report-header')

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

    .ullis{
        font-size:smaller; font-weight: 800;text-align: start;
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
        $category= $_GET['category'];
        } else {
            $category= "";
        }
    if(isset($_GET['type'])){
            $type= $_GET['type'];
        } else {
            $type= "";
        }
    if(isset($_GET['active_type'])){
            $active_type= $_GET['active_type'];
        } else {
            $active_type= "";
        }
    if(isset($_GET['to'])){
        $to= $_GET['to'];
    } else {
        $to= "";
    }
    if(isset($_GET['from'])){
        $from = $_GET['from']; 
    } else {
        $from = "";
    }
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
   
@endphp 
        <!--  BEGIN CONTENT AREA  -->
        <div  class="main-content">
                <div class="">
                    <div class="row">
                        <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">

                                    	<div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
                                            <h5 class="data-heading1 pt-0">The Samaj<span>Report run on: {{ $time }}</span></h5>
                                            <h3 class="data-heading p-0">EMPLOYEE YEAR OF SERVICE, QUALIFICATION AND PAY GRADE DETAILS REPORT</h3>

                                            <div style="text-align: right; margin-top:-35px; padding-bottom:7px;">
                                <a href="{{ url('/') }}/employee-yr-of-service-qualification-pay-grade-details-print<?php echo $curl; ?>" class="btn btn-primary" target="_blank" id="print_btn" ><i class="fa fa-print"></i> Print</a>

                                <a class="btn btn-primary" target="_blank" id="xl_btn" href="{{ url('/') }}/employee-yr-of-service-qualification-pay-grade-details-xl<?php echo $curl; ?>" >Excel</a>
                                                 
                                              </div>
                                        </div>

                                        
                                        </div>
                                            
                                    <form action="#" method="GET" style="padding: 10px; margin-top: 5px ; background: #ece9e9;">
                                        <div class="row">
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Employee Type:</label>
<select  name="type" class="form-control" required>
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
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Category:</label>
                                                <select name="category" class="form-control" required>
<option value="all_cat" @php if($category=="all_cat"){echo "selected";} @endphp >All Category</option>
@foreach ($categories as $val)
<option value="{{ $val->category_code }}" @php if($category==$val->category_code){echo "selected";} @endphp>{{ $val->category_name }}</option>
@endforeach
                                                   </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Emp Status</label>
<select name="active_type" class="form-control" required>
    <option value="all" @php if($active_type=="all"){echo "selected";} @endphp>All</option>
    <option value="A" @php if($active_type=="A"){echo "selected";} @endphp>Active</option>
    <option value="I" @php if($active_type=="I"){echo "selected";} @endphp>Inactive</option>

     </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>DOJ From:</label>
                                                <input type="date" class="form-control" name="from"  value="{{ $from }}" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>DOJ To:</label>
                                                <input type="date" class="form-control" name="to" value="{{ $to }}" required>
                                            </div>
                                        </div>

                                        <table style="margin-left:10px;">
                                            <tr>
                                                <td><button type="submit" class="btn btn-primary report-btn" style="margin-top: 25px;" value="">Search</button></td>
                                                <td><a style="margin-top: 25px;"  href="{{ url('/') }}/employee-yr-of-service-qualification-pay-grade-details" class="btn btn-info "><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
                                            </tr>
                                        </table>
                                    </div>
                                    </form>
                 
                                    
                                </div>
                                <div class="widget-content widget-content-area"  style="padding-bottom: 0px; padding-left: 7px;padding-right: 7px;">
        
                                    <div class="table-responsive" style="margin-top: 5px;height:550px; overflow:scroll;">
{{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for code.." title="Type Code" class="form-control " style="width: 15%; float: right; margin-bottom: 5px;"> --}}

<table width="100%" class="table mb-4" id="myTable" >

                                          <thead>
                    <tr>
                    <th class="t-th text-center" rowspan="2">Emp. Code</th>
                    <th class="t-th text-center" rowspan="2">Employee Name</th>
                    <th class="t-th text-center" rowspan="2">Designation</th>
                    <th class="t-th text-center" rowspan="2">Department</th>
                    <th class="t-th text-center" rowspan="2">Active Type</th>
                    <th class="t-th text-center" rowspan="2">DOB</th>
                    <th class="t-th text-center" rowspan="2">DOJ</th>
                    <th class="t-th text-center" rowspan="2">Date Of Confirmation</th>
                    <th class="t-th text-center" rowspan="2">Year Of Service</th>
                    <th class="t-th text-center" colspan="2" style="horizontal-align : middle;text-align:center; width: 50%;">Educational  Qualification</th>
                    <th class="t-th text-center" rowspan="2">Grade In Majithia WageBoard</th>
                    <th class="t-th text-center" rowspan="2">Remarks</th>
                    <th class="t-th text-center" rowspan="2">Edit</th>
                   
                </tr>

                <tr>
                    <th class="t-th text-center" scope="col">Academic</th>
                    <th class="t-th text-center" scope="col">Technical/Professional</th>
                </tr>
                                            </thead>
                                            <tbody>
                @foreach ($employee_list as $val)
                @php
                $academic1 = emp_academic($val->emp_no);
                $technical1 =emp_tec($val->emp_no);
                $remark1 =emp_remark($val->emp_no);
                @endphp
                    <tr>
                        <td class="text-center">{{ $val->employee_code}}</td>
                        <td class="text-center text-primary">{{ $val->emp_name}}</td>
                        <td class="text-center">{{ $val->desg_name}}</td>
                        <td class="text-center">{{ $val->dept_name}}</td>
                        <td class="text-center">
                            @if($val->active_type=="I")
                            <button style="font-size: initial;padding: revert;" class="btn btn-danger btn-sm">Inactive</button>
                            @elseif ($val->active_type=="A")
                            <button style="font-size: initial;padding: revert;" class="btn btn-success btn-sm">Active</button>
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!$val->DOB=="")
                            {{ date('d/m/Y', strtotime($val->DOB))}}
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!$val->DOJ=="")
                            {{ date('d/m/Y', strtotime($val->DOJ))}}
                            @endif
                        </td> 
                        <td class="text-center">
                            @if(!$val->confirm_date=="")
                            {{ date('d/m/Y', strtotime($val->confirm_date))}}
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!$val->DOJ=="")
                              {{ counter($val->DOJ,$val->retirement_date)}}
                            @endif
                        </td>
                        <td class="text-center">
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
                        <td class="text-center">
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
                        <td class="text-center">{{ $val->pay_grade_code }}</td>
                        <td class="text-center">
                            @if ($remark1!==0)                       
                            <ol>
                                @foreach ($remark1 as $key1 => $valc)
                                @if(strlen($valc->remark_text) > 8)
                                    <li  class="ullis">{{ substr($valc->remark_text,0,8) }}...</li> 
                                @else
                                    <li  class="ullis">{{ $valc->remark_text }}</li> 
                                @endif
                                @endforeach
                            </ol>
                            @endif 
                        </td>
                        <td class="text-center">
                            <a onclick="storetype('OFFICIAL_DETAILS','{{ $val->emp_no }}')" href="javascript:void(0)" title="Edit" class="editbtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
                                               
                                            </tbody>
        <tfoot>
            <tr>
                <td align="right" colspan="14">{{ $employee_list->links('paginate.pager16') }} </td>
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
        <!--  END CONTENT AREA  -->
        @include('Frontend.employee-report-footer')