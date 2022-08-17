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
                                            <h3 class="data-heading p-0">EMPLOYEES LIST(Category Wise)
                                            </h3>
                                             <div style="text-align: right; margin-top:-35px; padding-bottom:7px;">

                <a href="{{ url('/') }}/employee-list-category-wise-print<?php echo $curl; ?>" class="btn btn-primary" target="_blank" id="print_btn" ><i class="fa fa-print"></i> Print</a>

                <a class="btn btn-primary" target="_blank" id="xl_btn" href="{{ url('/') }}/employee-list-category-wise-xl<?php echo $curl; ?>" >Excel</a>                                            
  
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
                    <td><a href="{{ url('/') }}/employee-list-category-wise" class="btn btn-info "><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
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
                        <th class="text-center">Emp Type</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">Employee Name</th>
                        <th class="text-center">Designation</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Active Type</th>
                        <th class="text-center">Joining Date</th>
                        <th class="text-center">Edit</th>
                    </tr>
                </thead>
<tbody>

@foreach ($categories as $v)
@if(in_array($v->category_code,$ucatg))
    <tr style="background: aliceblue;">
        <td colspan="8" align="left" style="padding: 0px; border-bottom: 1px solid white; ">
            <h5 class="tbh5" style="font-weight: 600;">{{ $v->category_name }}</h5>
        </td>
    </tr> 
@endif
    @foreach ($employee_list as $val)
        @if($v->category_code==$val->catg)
            <tr>
                <td class="text-center">
                    @if ($val->emp_type=="PE")
                    PERMANENT
                    @elseif ($val->emp_type=="PR")
                    PROBATION
                    @elseif ($val->emp_type=="CO")
                    CONTARCT
                    @endif
                </td>
                <td class="text-center">{{ $val->employee_code }}</td>
                <td class="text-primary text-center">{{ $val->emp_name }}</td>
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
                    @if(!$val->DOJ=="")
                    {{ date('d/m/Y', strtotime($val->DOJ)) }}
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
@endforeach 

</tbody>
<tfoot>
                    <tr>
                        <td align="right" colspan="8">{{ $employee_list->links('paginate.pager1') }} </td>
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