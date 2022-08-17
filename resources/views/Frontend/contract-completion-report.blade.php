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
        <!--  BEGIN CONTENT AREA  -->
        <div  class="main-content">
                <div class="">
                    <div class="row ">
                        <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                    	<div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
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
    $from_date= "";
    $to_date= "";
} else {
    if(isset($_GET['from_date'])){
        $to_date= $_GET['to_date'];
    }else {
        $to_date= "";
    }
    if(isset($_GET['from_date'])){
        $from_date= $_GET['from_date'];
    } else {
        $from_date="";
    }
} 
if(isset($_GET['active_type'])){
      $active_type=$_GET['active_type'];
  } else {
      $active_type= "all";
  } 
  function getCategory($emp_no)
  {
    if($emp_no==""){
        return 0;
    } else {
        if(DB::table('emp_mst')->where(['emp_no'=>$emp_no])->count() > 0){
        $user = DB::table('emp_mst')->where(['emp_no'=>$emp_no])->first();
        $data = DB::table('category')->where(['category_code'=>$user->catg])->first();
        return $data->category_name;
    } else {
            return 0;
        }
    }
  }
  function getDesgmst($emp_no)
  {
    if($emp_no==""){
        return 0;
    } else {
        if(DB::table('emp_mst')->where(['emp_no'=>$emp_no])->count() > 0){
            $user = DB::table('emp_mst')->where(['emp_no'=>$emp_no])->first();
            $data = DB::table('desg_mst')->where(['desg_code'=>$user->desg_code])->first();
            return $data->desg_name;
        } else {
            return 0;
        }
    }
  }
  function getDeptmaster($emp_no)
  {
    if($emp_no==""){
    return 0; 
   } else {
    if(DB::table('emp_mst')->where(['emp_no'=>$emp_no])->count() > 0){
            $user = DB::table('emp_mst')->where(['emp_no'=>$emp_no])->first();
            $data = DB::table('dept_master')->where(['dept_no'=>$user->dept_no])->first();
            return $data->dept_name; 
        } else {
            return 0; 
        }
    }
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
@endphp    
        <h5 class="data-heading1 pt-0">The Samaj<span>Report run on: {{ $time }}</span></h5>
                                            <h3 class="data-heading p-0">CONTRACT COMPLETION REPORT</h3>
                    <div style="text-align: right; margin-top:-35px; padding-bottom:7px;">
                        <a href="{{ url('/') }}/contract-completion-report-print<?php echo $curl; ?>" class="btn btn-primary" target="_blank" id="print_btn" ><i class="fa fa-print"></i> Print</a>
                       
                       <a class="btn btn-primary" target="_blank" id="xl_btn" href="{{ url('/') }}/contract-completion-report-xl<?php echo $curl; ?>" >Excel</a>
                </div>

                                        </div>
                                        
   <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="padding-right:0px !important;padding-left:0px !important;">
    <form method="GET" action="#" class="form-inline report-area">
                    <label>From Date:</label>
                <input type="date" class="col-lg-2 form-control" value="{{ $from_date }}" name="from_date" required>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>To Date:</label>
                <input type="date" class="col-lg-2 form-control" value="{{ $to_date }}"  name="to_date" required>
                &nbsp;&nbsp;
                <label>Emp Status:</label>
                <select name="active_type" class="col-lg-2 form-control" required>
                    <option value="all" @php if($active_type=="all"){echo "selected";} @endphp>All</option>
                    <option value="A" @php if($active_type=="A"){echo "selected";} @endphp>Active</option>
                    <option value="I" @php if($active_type=="I"){echo "selected";} @endphp>Inactive</option>
                </select>
                    &nbsp;&nbsp;
                    <table style="margin-left:10px;">
                        <tr>
                            <td><button type="submit" class="btn btn-primary report-btn" value="">Search</button></td>
                            <td><a href="{{ url('/') }}/contract-completion-report" class="btn btn-info "><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
                        </tr>
                    </table>
                </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area"  style="padding-bottom: 0px; padding-left: 7px;padding-right: 7px;">
        
<div class="table-responsive" style="margin-top: 5px; height:595px; overflow:scroll;">
    {{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Emp. Code" title="Type in a SL No" class="form-control " style="width: 15%; float: right; margin-bottom: 5px;"> --}}
    <table class="table" id="myTable" width="100%" >
                    <thead>
                        <tr>
                            <th class="text-center">Emp. Code</th>
                            <th class="text-center">Employee Name</th>
                            <th class="text-center">Designation</th>
                            <th class="text-center">Department</th>
                            <th class="text-center">Active Type</th>
                            <th class="text-center">DOJ</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Basic Salary</th>
                            <th class="text-center">Contract Start Date</th>
                            <th class="text-center">Contract End Date</th>
                            <th class="text-center">Edit</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach ($employee_list as $val)
@php 
$userd = empDetails($val->emp_no);
@endphp                        
 @if(!$userd==0)                       

                        <tr>
                        <td class="text-center">
                        @if(!$userd==0)
                            {{ $userd->employee_code }}
                        @endif
                            </td>
                        <td class="text-center">
                        @if(!$userd==0)
                            {{ $userd->emp_name }}
                        @endif
                        </td>
                        <td class="text-center">
                        @if(!getDesgmst($val->emp_no)==0)
                            {{ getDesgmst($val->emp_no) }}
                        @endif
                        </td>
                        <td class="text-center">
                            @if(!getDeptmaster($val->emp_no)==0)
                                {{ getDeptmaster($val->emp_no) }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!$userd==0)
                            @if($userd->active_type=="I")
                            <button style="font-size: initial;padding: revert;" class="btn btn-danger btn-sm">Inactive</button>
                            @elseif ($userd->active_type=="A")
                            <button style="font-size: initial;padding: revert;" class="btn btn-success btn-sm">Active</button>
                            @endif
                            @endif
                        </td>
                        <td class="text-center">
                        @if(!$userd==0)
                            @if(!$userd->DOJ=="")
                                {{ date('d/m/Y', strtotime($userd->DOJ)) }}
                            @endif
                        @endif
                        </td>
                        <td class="text-center">
                        @if(!getCategory($val->emp_no)==0)
                            {{ getCategory($val->emp_no) }}
                        @endif
                        </td>
                        <td class="text-center">
                        @if(!$userd==0)
                            {{ $userd->new_basic_pay }}
                        @endif 
                        </td>
                        <td class="text-center">
                            @php $contractdata = emp_contract($val->emp_no);  @endphp     
                            @if (emp_contract($val->emp_no)!==0)            
                                @foreach ($contractdata as $key2 => $val2)
                                @if(!$val2->cont_start_date=="")
                                    <span class="ullis">{{ date('d/m/Y', strtotime($val2->cont_start_date)) }}</span><br>
                                @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            @if (emp_contract($val->emp_no)!==0)            
                                @foreach ($contractdata as $key2 => $val2)
                                @if(!$val2->cont_end_date=="")
                                    <span class="ullis">{{ date('d/m/Y', strtotime($val2->cont_end_date)) }}</span><br>
                                @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            <a onclick="storetype('OFFICIAL_DETAILS','{{ $val->emp_no }}')" href="javascript:void(0)" title="Edit" class="editbtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                            </a>
                        </td>
                        </tr>
 @endif                       
                        @endforeach  
                </tbody>
                <tfoot>
                    <tr>
                        <td align="right" colspan="11">{{ $employee_list->links('paginate.pager7') }} </td>
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