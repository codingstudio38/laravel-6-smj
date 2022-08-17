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
        <!--  BEGIN CONTENT AREA  -->
        <div  class="main-content">
                <div class="">
                    <div class="row">
                        <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
      <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center" >
        @php
        date_default_timezone_set('Asia/Kolkata');
        $time = date("M d, Y h:i A");
        @endphp
        <h5 class="data-heading1 pt-0" >The Samaj<span>Report run on: {{ $time }}</span></h5>
                                            <h3 class="data-heading p-0">EMPLOYEES MASTER LIST
                                            </h3>
                                            <div style="text-align: right; margin-top:-35px; padding-bottom:7px;">
                        <a href="{{ url('/') }}/employee-master-list-print<?php echo $curl; ?>" class="btn btn-primary" target="_blank" id="print_btn" ><i class="fa fa-print"></i> Print</a>
                        
<a class="btn btn-primary" target="_blank" id="xl_btn" href="{{ url('/') }}/employee-master-list-xl<?php echo $curl; ?>" >Excel</a>
                                        </div>
                                        </div>
                                      

@php
if(!isset($_GET['category']) && !isset($_GET['type'])){
    $category= "all_cat";
    $type= "all_type";
} else {
    $category= $_GET['category'];
    $type= $_GET['type'];
}
if(isset($_GET['active_type'])){
    $active_type= $_GET['active_type'];
} else {
    $active_type= "";
}
$check_catg = array();
foreach ($employee_list as $key => $val) {
    $check_catg[] = $val->catg;
}
$ucatg = array_unique($check_catg);
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
  function getCatV($catg)
  {
    return DB::table('category')->where(['category_code'=>$catg])->first();
  }
  function paginateSerial($data)
{
        return $data->perPage() * ($data->currentPage() - 1);
}
function emp_contract($emp_no)
  {
    $check = DB::table('emp_contract_dtl')->where(['emp_no'=>$emp_no])->count();
    if($check > 0){
        $data = DB::table('emp_contract_dtl')->where(['emp_no'=>$emp_no])->orderBy('id','DESC')->first();
        return $data;
    } else {
        return 0;
    }
  } 
  $serial = paginateSerial($employee_list); 
$sl = $serial+1;
@endphp         
         <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="padding-right:0px !important;padding-left:0px !important;">
                                         
            <form method="get" action="#" class="form-inline report-area" method="GET">
                <label>Category:</label>
            <select name="category" class="col-lg-2 form-control" required>
                <option value="all_cat" @php if($category=="all_cat"){echo "selected";} @endphp >All Category</option>
            @foreach ($categories as $val)
                <option value="{{ $val->category_code }}" @php if($category==$val->category_code){echo "selected";} @endphp>{{ $val->category_name }}</option>
                @endforeach
            </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                    <td><a href="{{ url('/') }}/employee-master-list" class="btn btn-info "><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
                </tr>
            </table>

            </form>
        
                                        </div>
                                    </div>
                                </div>
    <div class="widget-content widget-content-area"  style="padding-bottom: 0px; padding-left: 7px;padding-right: 7px;">
        <style>
            .tbh5{
                text-decoration: underline;
                margin-left:20px; 
                margin-top: 5px;
            }
            </style>
        <div class="table-responsive" style="margin-top: 5px; height:595px; overflow:scroll;">
         
            <table class="table" id="myTable" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">Sl No.</th>
                        <th class="text-center">Employee Name</th>
                        <th class="text-center">Employee Code</th>
                        <th class="text-center">Designation</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Employee Type</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">DOJ</th>
                        <th class="text-center">Date of Confirmation</th>
                        <th class="text-center">DOB</th>
                        <th class="text-center">Date of Retirement</th>
                        <th class="text-center">Contract End Date</th>
                        <th class="text-center">Active Type</th>
                        <th class="text-center">Inactive Reason</th>
                        <th class="text-center">Edit</th>
                    </tr>
                </thead>
<tbody>

    @foreach ($employee_list as $val)
       @php
           $cat = getCatV($val->catg);
           $contractdata = emp_contract($val->emp_no);
       @endphp
    <tr>
        <td class="text-center">
           {{ $sl++ }}
        </td>
        <td class="text-primary text-center">{{ $val->emp_name }}</td>
        <td class="text-center">{{ $val->employee_code }}</td>
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
            @if ($val->emp_type=="PE")
            PERMANENT
            @elseif ($val->emp_type=="PR")
            PROBATION
            @elseif ($val->emp_type=="CO")
            CONTARCT
            @endif
        </td>
        <td class="text-center">
            @if (!$val->catg=="")
                {{ $cat->category_name }}
            @endif
        </td>
        <td class="text-center">
            @if(!$val->DOJ=="")
            {{ date('d/m/Y', strtotime($val->DOJ)) }}
            @endif
        </td>
        <td class="text-center">
            @if(!$val->confirm_date=="")
            {{ date('d/m/Y', strtotime($val->confirm_date)) }}
            @endif
        </td>
        <td class="text-center">
            @if(!$val->DOB=="")
            {{ date('d/m/Y', strtotime($val->DOB)) }}
            @endif
        </td>
        <td class="text-center">
            @if(!$val->retirement_date=="")
            {{ date('d/m/Y', strtotime($val->retirement_date)) }}
            @endif
        </td>
        <td class="text-center">
            @if ($contractdata!==0)            
                @if(!$contractdata->cont_end_date=="")
                {{ date('d/m/Y', strtotime($contractdata->cont_end_date)) }}
                @endif
            @endif
        </td>
        <td class="text-center">
            @if($val->active_type=="I")
            <button style="font-size: initial;padding: revert;" class="btn btn-danger btn-sm">Inactive</button>
            @elseif ($val->active_type=="A")
            <button style="font-size: initial;padding: revert;" class="btn btn-success btn-sm">Active</button>
            @endif
        </td> 
        <td class="text-center">
            @if($val->active_type=="I")
                @if(strlen($val->reason_desc) > 16)
                    {{ substr($val->reason_desc,0,16) }}...
                @else
                    {{ $val->reason_desc }}
                @endif
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
                        <td align="right" colspan="15">{{ $employee_list->links('paginate.pager17') }} </td>
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
                style = style + '.page-count:after{counter-increment:page;content:"Page" counter(page) " of " counter(pages);}';
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
    td = tr[i].getElementsByTagName("td")[2];
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