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
    .col-lg-3 {
    max-width: 35% !important;
}

    .ullif{
        list-style: none;font-size: initial;font-weight: 600; text-decoration: underline;text-align: start;
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
if(count($_GET)==0){
    $category= "all_cat";
    $type= "all_type";
} else {
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
}
if(isset($_GET['active_type'])){
      $active_type=$_GET['active_type'];
  } else {
      $active_type= "all";
  }
$i=1;
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
                <h3 class="data-heading p-0">EMPLOYEE QUALIFICATION AND EXPERIENCE DETAILS REPORT</h3>

                <div style="text-align: right; margin-top:-35px; padding-bottom:7px;">
                <a href="{{ url('/') }}/employee-qualification-experience-details-report-print<?php echo $curl; ?>" class="btn btn-primary" target="_blank" id="print_btn" ><i class="fa fa-print"></i> Print</a>    
                    
                <a class="btn btn-primary" target="_blank" id="xl_btn" href="{{ url('/') }}/employee-qualification-experience-details-report-xl<?php echo $curl; ?>" >Excel</a>        
                    </div>

            </div>
                                         
                                           <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="padding-right:0px !important;padding-left:0px !important;">
                                                  
                                            <form method="GET" action="#" class="form-inline report-area">
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            
                <table style="margin-left:10px;">
                <tr>
                    <td><button type="submit" class="btn btn-primary report-btn" value="">Search</button></td>
                    <td><a href="{{ url('/') }}/employee-qualification-experience-details-report" class="btn btn-info "><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
                </tr>
            </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area"  style="padding-bottom: 0px; padding-left: 7px;padding-right: 7px;">
        
                    <div class="table-responsive" style="margin-top: 5px;height:595px; overflow:scroll;">
{{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for code.." title="Type Code" class="form-control " style="width: 15%; float: right; margin-bottom: 5px;"> --}}

<table width="100%" class="table mb-4" id="myTable" >
            <thead>
                <tr>
                    <th class="t-th" rowspan="2">Sl.No</th>
                    <th class="t-th" rowspan="2" >Employee Name</th>
                    <th class="t-th" rowspan="2" style="width:130px">Designation</th>
                    <th class="t-th" rowspan="2">Department</th>
                    <th class="t-th" rowspan="2">Active Type</th>
                    <th class="t-th" colspan="5" style="horizontal-align : middle;text-align:center; width: 50%;">Educational  Details</th>
                    <th class="t-th" colspan="5" style="horizontal-align : middle;text-align:center; width: 50%;">Experience Details</th>
                    <th ></th>
                </tr>
                   
                <tr>
                    <th class="t-th" scope="col">Academic-Degree/Details</th>
                    <th class="t-th" scope="col">Professional/Technical Degree/Details</th>
                    <th class="t-th" scope="col">Board/University</th>
                    <th class="t-th" scope="col">Year Of Passing</th>
                    <th class="t-th" scope="col">% Of Mark</th>

                    <th class="t-th" scope="col">Organisation Name</th>
                    <th class="t-th" scope="col">Position</th>
                    <th class="t-th" scope="col">from Date</th>
                    <th class="t-th" scope="col">To Date</th>
                    <th class="t-th" scope="col">Sector</th>
                    <th class="text-center">Edit</th>
                    
                </tr>
                </thead>
            <tbody>
                @foreach ($employee_list as $val)
                @php
                $academic1 = emp_academic($val->emp_no);
                $technical1 = emp_tec($val->emp_no);
                $experience1 = emp_experience($val->emp_no);
                @endphp
                <tr>
                <td class="text-center">{{ $sl++ }}</td>
                <td class="text-center text-primary">{{ $val->emp_name }}</td>
                <td class="text-center">{{ $val->desg_name }}</td>
                <td class="text-center">{{ $val->dept_name }}</td>
                <td class="text-center">
                    @if($val->active_type=="I")
                    <button style="font-size: initial;padding: revert;" class="btn btn-danger btn-sm">Inactive</button>
                    @elseif ($val->active_type=="A")
                    <button style="font-size: initial;padding: revert;" class="btn btn-success btn-sm">Active</button>
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
        <td class="text-center">
        <c class="ullif">Technical</c><br> 
        @if ($technical1!==0)
        <ol>
            @foreach ($technical1 as $key3 => $val3)
                @if(!$val3->institution=="")
                    <li class="ullis">{{ @$val3->institution }}</li> 
                @endif
            @endforeach
        </ol>
        @endif 
        <c class="ullif">Academic</c>      
        @if ($academic1!==0)  
        <ol>
            @foreach ($academic1 as $key4x3 => $val43x)
                @if(!$val43x->institution=="")
                    <li class="ullis">{{ @$val43x->institution }}</li> 
                @endif
            @endforeach
        </ol> 
        @endif  

    </td>
        <td class="text-center">
            <c class="ullif">Technical</c><br>        
        @if ($technical1!==0) 
        <ol>
            @foreach ($technical1 as $key4 => $val4)
                @if(!$val4->year_passing=="")
                    <li class="ullis">{{ @$val4->year_passing }}</li> 
                @endif
            @endforeach
        </ol>
        @endif  
        <c class="ullif">Academic</c>         
        @if ($academic1!==0)       
        <ol>
            @foreach ($academic1 as $key44 => $val44)
            @if(!$val44->year_passing=="")
                <li class="ullis">{{ @$val44->year_passing }}</li> 
            @endif
            @endforeach
        </ol>
        @endif
    </td>
        <td class="text-center">
            <c class="ullif">Technical</c><br>                
        @if ($technical1!==0) 
        <ol>
            @foreach ($technical1 as $key5 => $val5)
            @if(!$val5->mark_perc=="")
                <li class="ullis">{{ @$val5->mark_perc }}</li> 
            @endif
            @endforeach
        </ol>
        @endif
        <c class="ullif">Academic</c>               
        @if ($academic1!==0) 
        <ol>
            @foreach ($academic1 as $key55 => $val55)
            @if(!$val55->mark_perc=="")
                <li class="ullis">{{ @$val55->mark_perc }}</li> 
            @endif
            @endforeach
        </ol>  
        @endif 
    </td>

            <td class="text-center">
        @if ($experience1!==0)        
        <ol>
            @foreach ($experience1 as $key6 => $val6)
            @if(!$val6->orgn_name=="")
                <li class="ullis">{{ @$val6->orgn_name }}</li> 
            @endif
            @endforeach
        </ol>  
        @endif          
        
                    </td>
                    <td class="text-center">
        @if ($experience1!==0)        
        <ol>
            @foreach ($experience1 as $key7 => $val7)
            @if(!$val7->position=="")
                <li class="ullis">{{ @$val7->position }}</li> 
            @endif
            @endforeach
        </ol>  
        @endif          
        
                    </td>
                    <td class="text-center">
        @if ($experience1!==0)        
        <ol>
            @foreach ($experience1 as $key8 => $val8)
            @if(!$val8->start_date=="")
            <li class="ullis"> {{ date('d/m/Y', strtotime($val8->start_date)) }}</li> 
                @endif 
            @endforeach
        </ol>  
        @endif          
        
                    </td>
                    <td class="text-center">
        @if ($experience1!==0)        
        <ol>
            @foreach ($experience1 as $key9 => $val9)
            @if(!$val9->end_date=="")
            <li class="ullis"> {{ date('d/m/Y', strtotime($val9->end_date)) }}</li> 
                @endif 
            @endforeach
        </ol>  
        @endif          
        
                    </td>
                    <td class="text-center">
@if ($experience1!==0)        
<ol> 
@foreach ($experience1 as $key1 => $val11)
    @if(!$val11->sector=="")
        <li class="ullis">{{ @$val11->sector }}</li> 
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
                                    <td align="right" colspan="16">{{ $employee_list->links('paginate.pager15') }} </td>
                                </tr>
                            </tfoot>
                          </table>
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
        @include('Frontend.employee-report-footer')