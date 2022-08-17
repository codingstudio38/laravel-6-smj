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

if(isset($_GET['active_type'])){
    $active_type=$_GET['active_type'];
} else {
    $active_type= "";
} 
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
    date_default_timezone_set('Asia/Kolkata');
    $time = date("M d, Y h:i A");
    function emp_Dep($id)
  {
    $check = DB::table('emp_dependent_dtl')->where(['emp_no'=>$id])->count();
    if($check > 0){
        $data = DB::table('emp_dependent_dtl')->where(['emp_no'=>$id])->get();
        return $data;
    } else {
        return 0;
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
            <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
                                <h5 class="data-heading1 pt-0">The Samaj<span>Report run on: {{ $time }}</span></h5>
                                <h3 class="data-heading p-0">DATA REQUIRED FOR INSURANCE SCHEME</h3>
                       
                                <div style="text-align: right; margin-top:-35px; padding-bottom:7px;">
                            <a href="{{ url('/') }}/employee-life-insurance-scheme-print<?php echo $curl; ?>" class="btn btn-primary" target="_blank" id="print_btn" ><i class="fa fa-print"></i> Print</a>        
                           
                            <a class="btn btn-primary" target="_blank" id="xl_btn" href="{{ url('/') }}/employee-life-insurance-scheme-xl<?php echo $curl; ?>" >Excel</a>
                            
                            </div>
                            
                            </div>
                          
                            
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="padding-right:0px !important;padding-left:0px !important;">
                                        
            <form method="get" action="" class="form-inline report-area">

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
            <a href="{{ url('/') }}/employee-life-insurance-scheme" class="btn btn-info "><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </form>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area"  style="padding-bottom: 0px; padding-left: 7px;padding-right: 7px;">
<div class="table-responsive" style="margin-top: 5px;height:595px; overflow:scroll;">
<table width="100%" class="table mb-4" >
    
    <table class="table" id="myTable" width="100%">
    <thead>
        <tr>
            <th class="text-center">Sl No</th>
            <th class="text-center">Employee Name</th>
            <th class="text-center">Designation</th>
            <th class="text-center">Active Type</th>
            <th class="text-center">Date Of Birth</th>
            <th class="text-center">Basic Salary</th>
            <th class="text-center">Gross salary</th>
            <th class="text-center">Dependent Name</th>
            <th class="text-center">DOB</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
    
        @foreach ($employee_list as $val)
        @php
            $emp_Dep=emp_Dep($val->emp_no);
        @endphp
        <tr> 
            <td class="text-center">{{ $sl++ }}</td>
            <td class="text-center">{{ $val->emp_name }}</td> 
            <td class="text-center">{{ $val->desg_name }}</td>
            <td class="text-center">
                @if($val->active_type=="I")
                <button style="font-size: initial;padding: revert;" class="btn btn-danger btn-sm">Inactive</button>
                @elseif ($val->active_type=="A")
                <button style="font-size: initial;padding: revert;" class="btn btn-success btn-sm">Active</button>
                @endif
            </td>
            <td class="text-center">
                @if(!$val->DOB=="")
                {{ date('d/m/Y', strtotime($val->DOB)) }}
                @endif
            </td>
            <td class="text-center">{{ $val->new_basic_pay }}</td>
            <td class="text-center"></td> 
            <td class="text-center">
                @if(!$emp_Dep==0)
                <ol>
                    @foreach($emp_Dep as $key => $vall)
                    @if(!$vall->depd_name=="")
                    <li>{{$vall->depd_name}}</li>
                    @endif
                    @endforeach
                </ol>
                @endif
            </td> 

            <td class="text-center">
                @if(!$emp_Dep==0)
                <ol>
                    @foreach($emp_Dep as $key => $valll)
                    @if(!$valll->depd_dob=="")
                    <li>{{ date('d/m/Y', strtotime($valll->depd_dob)) }}</li>
                    @endif
                    @endforeach
                </ol>
                @endif
            </td>
            <td>
                <a onclick="storetype('OFFICIAL_DETAILS','{{ $val->emp_no }}')" href="javascript:void(0)" title="Edit" class="editbtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                </a> 
            </td>
        @endforeach 
        
    </tbody>
    <tfoot>
        <tr>
            <td align="right" colspan="10">{{ $employee_list->links('paginate.rp2_pager3') }} </td>
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

@include('Frontend.employee-report-footer')
    