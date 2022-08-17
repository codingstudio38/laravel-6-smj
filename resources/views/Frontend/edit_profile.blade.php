@extends('Frontend.footer')

@extends('Frontend.inner_master')

@section('content')
<?php 
if (isset($_COOKIE['samaj_data'])) { 
  $button = trim($_COOKIE['samaj_data']);
} else {
  $button = "0";
}
?>
 

<style type="text/css">
    #bank
{
    font-size: 13px;
    color: black;
}
#wrong-egn{
  display: none;
  font-size: 12px;
  color: red;
}
#wrong-egn3{
  display: none;
  font-size: 12px;
  color: red;
}
#wrong-egn2{
  display: none;
  font-size: 12px;
  color: red;
}
#wrong-egn1{
  display: none;
  font-size: 12px;
  color: red;
}
.employeemaster{
    color: #f70c0c;
}
#ui-datepicker-div
{
  position: absolute;

    width: 299px;
}
.fa-file-pdf{
  color: #91111a;
}
.fa-file-excel{
  color: #77a957;
}
.fa-file-word{
  color: #6193ca;
}

     .tableFixHead {
        overflow-y: auto;
        height: 350px;
      }
      .tableFixHead thead th {
        position: sticky;
        top: 0;
      }
      .tableFixHead table {
        border-collapse: collapse;
        width: 100%;
      }
      .tableFixHead th,
      .tableFixHead td {
          text-align: center;
        padding:4px; 
        border: 1px solid #ccc;
      }
      .tableFixHead th {
        background: #eee;
        z-index: 9999999999;
      }
      .tableFixHead td{
        z-index: -4;
      }
      .tableFixHead th{
        z-index: 1 !important;
      }
.td2{
  width: 70px;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}


label{
    margin-bottom: 0px !important;
}
</style>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />

        <!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
<div class="layout-px-spacing">                

<div class="account-settings-container layout-top-spacing">

<div class="account-content">
<div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
<div class="row">

@php
   use Carbon\Carbon;
    function agecounter($data){
      $user_age = Carbon::parse($data)->diff(Carbon::now())->format('%y');
      //$user_age = Carbon::parse($data)->diff(Carbon::now())->format('%y_%m_%d');
      return $user_age;
    }
@endphp





  <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
  
    <form onsubmit="return form_validation()" id="general-info" class="section general-info"
     action="{{url('/')}}/updateEmployeeDetails" method="post" enctype="multipart/form-data" novalidate>
    
      <div class="form-group" style="text-align: right;color: white;">
        <button type="submit" class="btn btn button1"
          style="background-color: #1b55e2;">
        Save</button>
      </div> 

@if(session()->has('SuccessStatus'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="color: black; font-size: initial;">
    {{ session()->get('SuccessStatus') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

    <input type="hidden" class="form-control "  name="emp_id" value="{{ $EmployeeAllInfo->id }}">  
    
    {!! csrf_field() !!}  
    
        <div class="info">
    
        <h6 class="">EMPLOYEE MASTER</h6>
    
        <div class="row">
        <div class="col-lg-11 mx-auto">
            <div class="row">
                 <div class="col-xl-2 col-lg-12 col-md-4">
                    <div class="upload mt-4 pr-md-4">
                       </div>
                    @if($EmployeeAllInfo->image!="")
                       
                       
                       <input type="file" accept="image/png, image/gif, image/jpeg" id="input-file-max-fs" class="dropify" data-default-file="{{ url('public/image/'.$EmployeeAllInfo->image) }}" data-max-file-size="2M" name="image" />
                          <input type="hidden" name="old_empImage" value="{{$EmployeeAllInfo->image}}">
                                @else
                                
                                <div class="upload mt-4" >
                              <input type="file" accept="image/png, image/gif, image/jpeg" id="input-file-max-fs" class="dropify" data-default-file="{{url('/')}}/public/assets/img/download.jpg" data-max-file-size="2M"  name="image" />
                          </div>
                           @endif
                </div>
    
    <style>
      .hide{
        display: none;
      }
    </style>
                <div class="col-xl-10 col-lg-10 col-md-10 mt-md-0 mt-4">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="fullName">Employee no<span class="employeemaster">*</span></label>
                                    <input type="text" class="form-control " id="emp_no"  name="emp_no" value="{{ $EmployeeAllInfo->emp_no }}" readonly="readonly">
                         <label class="text-danger hide" id="emp_no_label">This field is required </label>
                                </div>
                            </div>
                           <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="fullName">Employee List</label>
                                   <button type="button" class="btn btn-primary " data-toggle="modal" data-target=".bd-example-modal-xl">List</button>
                                  
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <label class="dob-input">Active Type<span class="employeemaster">*</span></label>
                          
                                    <div class="form-group mr-1">
                                        <select class="form-control" id="active_type" name="type" onchange="showfield(this.value)" 
                                        value ="{{$EmployeeAllInfo->active_type }}">
                                          <option <?php if($EmployeeAllInfo->active_type == 'A'){ echo "selected"; } else { echo ""; } ?> value="A">Active</option>
                                           <option <?php if($EmployeeAllInfo->active_type == 'I'){ echo "selected"; } else { echo ""; } ?> value="I">Inactive</option>
                                        </select>
                                        <div id="div1"></div>
                                      </div>
    
                                      @if($EmployeeAllInfo->active_type == 'I')
                                        <div class="form-group mt-2">
                                         <div class="row">
                                           <div class="col-6 r_class ">
                                              <select class="form-control" name="inactive_reason" id="reason" >
                                                <option>select</option>
                                                <option <?php if($EmployeeAllInfo->inactive_reason == 'Superannuation'){ echo "selected"; } else { echo ""; } ?> value="Superannuation">Superannuation</option>
                                                <option <?php if($EmployeeAllInfo->inactive_reason == 'Resignation'){ echo "selected"; } else { echo ""; } ?> value="Resignation">Resignation</option>
                                                <option <?php if($EmployeeAllInfo->inactive_reason == 'Termination'){ echo "selected"; } else { echo ""; } ?> value="Termination">Termination</option>
                                                <option <?php if($EmployeeAllInfo->inactive_reason == 'Death'){ echo "selected"; } else { echo ""; } ?> value="Death">Death</option>
                                                <option <?php if($EmployeeAllInfo->inactive_reason == 'Illness'){ echo "selected"; } else { echo ""; } ?> value="Illness">Illness</option>
                                                <option <?php if($EmployeeAllInfo->inactive_reason == 'Others'){ echo "selected"; } else { echo ""; } ?> value="Others">Others</option>
                                                
                                              </select>
                                           </div>
                                           <div class="col-6 r_class" >
                                              <input type="date" class="form-control "  
                                              name="inactive_date" 
                                              value="{{ $EmployeeAllInfo->inactive_date }}" id="r_dob">
                                           </div>
                                           <div class="col-12 r_class">
                                         
                                             <textarea  class="form-control " id="r_txtReason" name="reason_desc" rows="2" cols="" placeholder="describe your reason">{{$EmployeeAllInfo->reason_desc }}</textarea>
                                           </div>
                                         </div>
                                      </div>
                                      @elseif($EmployeeAllInfo->active_type == 'A')
                                       <div class="form-group mt-2">
                                         <div class="row">
                                           <div class="col-6 r_class " style="display: none">
                                              <select class="form-control" name="inactive_reason" id="reason" >
                                                <option>Select</option>
                                                <option value="Superannuation">Superannuation</option>
                                                <option value= "Resignation">Resignation</option>
                                                <option value= "Termination">Termination</option>
                                                <option value= "Death">Death</option>
                                                <option value= "Illness">Illness</option>
                                                <option value= "Others">Others</option>
                                                
                                              </select>
                                           </div>
                                           <div class="col-6 r_class"  style="display: none">
                                              <input type="date" class="form-control "  
                                              name="inactive_date" value="" id="r_dob" required>
                                           </div>
                                           <div class="col-12 r_class" style="display: none">
                                             <textarea  class="form-control " id="r_txtReason" name="reason_desc" rows="2" cols=""placeholder="describe your reason"></textarea required>
                                           </div>
                                         </div>
                                      </div>
                                      
                                      @endif
    
                               </div>
    
    
                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="fullName">Employee Name<span class="employeemaster">*</span></label>
                                    <input type="text" class="form-control " id="emp_name" name="emp_name"  value="{{ $EmployeeAllInfo->emp_name }}" required=""/>
                                    <label class="text-danger hide" id="emp_name_label">This field is required </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="fullName">Employee Code<span class="employeemaster">*</span></label>
                                    <input type="text" class="form-control " id="emp_code" name="emp_code"   value="{{ $EmployeeAllInfo->employee_code }}" required>
                                    <label class="text-danger hide" id="emp_code_label">This field is required </label>
                                </div>
                            </div>
    
    
                             <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="fullName">Department<span class="employeemaster">*</span></label>
                                 <select class="form-control" name="department" id="department" required> 
                                  <option value="">select</option>
                                     @foreach($Department_fetch as $ky=>$val)
                                          <option  value="{{$val->dept_no}}"
                                              {{$val->dept_no==$EmployeeAllInfo->dept_no 
                                                  ? 'selected':''}}>{{$val->dept_name}}
                                          </option>      
                                     @endforeach
                                          </select>
                                          <label class="text-danger hide" id="department_label">This field is required </label>        
                                </div>
                            </div>
    
    
                             <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="fullName">Employeement Type<span class="employeemaster">*</span></label>
                                    <select class="form-control " onchange="check()" id="emp_type" name="emp_type" required>
                                        <option value="">select</option>
                                     @foreach($Employee_type_fetch as $ky=>$val)
                                    <option value="{{substr($val->employee_type_name, 0, 2)}}"{{substr($val->employee_type_name, 0, 2)==$EmployeeAllInfo->emp_type ? 'selected':''}}>{{$val->employee_type_name}}</option>
                                               @endforeach
                           
                                        </select>
                                        <label class="text-danger hide" id="emp_type_label">This field is required </label>
                                </div>
                            </div>
    
                              <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="fullName">Designation<span class="employeemaster">*</span></label>
                                    <select class="form-control " id="designation" name="designation" required>
                                        <option value="">select</option>
                                             @foreach($Designation as $ky=>$val)
                                                  <option value="{{$val->desg_code}}"{{$val->desg_code==$EmployeeAllInfo->desg_code 
                                                            ? 'selected':''}}>
                                                            {{$val->desg_name}}</option>
                                               @endforeach
                                        </select>
                                        <label class="text-danger hide" id="designation_label">This field is required </label>
                                </div>
                            </div>
    
    
    
                             <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="category">Category<span class="employeemaster">*</span></label>
                                    <select class="form-control " id="category" name="category" required>
                                        <option value="">select</option>
                                    @foreach($Category_fetch as $ky=>$val)
                                        <option value="{{$val->category_code}}"{{$val->category_code==$EmployeeAllInfo->catg ? 'selected':''}}>{{$val->category_name}}
                                        </option>
                                           @endforeach
                                        </select>
                                        <label class="text-danger hide" id="category_label">This field is required </label>
                                </div>
                            </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="workplace">Workplace<span class="employeemaster">*</span></label>
                                    <select class="form-control " id="workplace" name="workplace" required>
                                        <option value="">select</option>
                                            @foreach($Workplace_fetch as $ky=>$val)
                                                  <option value="{{$val->id}}"{{$val->id==$EmployeeAllInfo->work_place ? 'selected':''}}>{{$val->workplace_name}}
                                                  </option>
                                               @endforeach
                             
                                        </select>
                                        <label class="text-danger hide" id="workplace_label">This field is required </label>
    
                                </div>
                            </div>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />      --}}
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label for="fullName">Date Of Birth<span class="employeemaster">*</span></label>
                                  <input  id="DOB" type='date' class="form-control " name="DOB" value="@php
                                    if(!$EmployeeAllInfo->DOB=="")
                                    echo date('Y-m-d', strtotime($EmployeeAllInfo->DOB));
                                  @endphp"required >
                                  <label class="text-danger hide" id="dtpFrDate_label">This field is required </label>  
    
                                </div>
                            </div>
    
                      <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="fullName">Date Of Joining<span class="employeemaster">*</span></label>
                                    @if($EmployeeAllInfo->DOJ==null)
                                    <input id="dtpFrDate1" type="date" class="form-control "  name="DOJ"  >
                                    @else
                                    <input id="dtpFrDate1" type="date" class="form-control "  name="DOJ"  value="{{date('Y-m-d', strtotime( $EmployeeAllInfo->DOJ)) }}" >
                                    @endif
                                    

                                    <label class="text-danger hide" id="dtpFrDate1_label">This field is required </label>  
                                </div>
                            </div>
    
                               <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="fullName">Date Of Probation<span class="employeemaster" id="dop_div"></span></label>
                                    
                                    @if($EmployeeAllInfo->DOP==null)
                                    
                                 <input type="date" class="form-control " name="DOP" id="dtpFrDate2" value="" >
                                    
                                    @else
                                       <input type="date" class="form-control " name="DOP" id="dtpFrDate2" value="{{ date('Y-m-d', strtotime($EmployeeAllInfo->DOP)) }}" >
                                   @endif
                                   <label class="text-danger hide" id="dtpFrDate2_label">This field is required </label>   
    
                                </div>
                            </div> 
                                <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="fullName">Date of Confirmation<span class="employeemaster" id="doc_div"></span></label>
                                  
                                      @if($EmployeeAllInfo->confirm_date==null)
                                      <input type="date" class="form-control " name="DOC" id="dtpFrDate3" >
                                      @else
                                       <input type="date" class="form-control " name="DOC" id="dtpFrDate3" value="{{date('Y-m-d', strtotime( $EmployeeAllInfo->confirm_date ))}}">
                                      @endif
                                      <label class="text-danger hide" id="dtpFrDate3_label">This field is required </label>               
                           
                              </div>
                                    </div>
                        <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="fullName">Retirement Date<span class="employeemaster" id="retire_div"></span></label>
                                    @if($EmployeeAllInfo->emp_type=="CO")
                                    <input type="date" class="form-control " name="retirement_date"  disabled>
                                    @else
                                     @if($EmployeeAllInfo->retirement_date==null)
                                    <input type="date" class="form-control " name="retirement_date" >
                                      @else
                                    <input type="date" class="form-control " name="retirement_date"  value="{{ date('Y-m-d', strtotime($EmployeeAllInfo->retirement_date)) }}">
                                    @endif
                                    @endif
                                    <label class="text-danger hide" id="dtpFrDate4_label">This field is required </label>    
                              </div>
                                    </div>
                                  
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
    
                 <script>
      
                  var emp_type = document.getElementById('emp_type');
    
                  var DOP = document.getElementById('dtpFrDate2');
                  var DOC = document.getElementById('dtpFrDate3');
                  var retirement = document.getElementById('dtpFrDate4');
                  
                  var dop_div = document.getElementById('dop_div');
                  var doc_div = document.getElementById('doc_div');
                  var retire_div = document.getElementById('retire_div');
                  
                  function check(){
                      if(emp_type.value=="CO"){
                          DOP.removeAttribute("required");
                          dop_div.innerHTML="";
                          DOC.removeAttribute("required");
                          doc_div.innerHTML="";
                          retirement.setAttribute("disabled", "disabled");
                          retire_div.innerHTML="";
                      }else if(emp_type.value=="PR"){
                          DOP.setAttribute("required", "required");
                          dop_div.innerHTML="*";
                          DOC.removeAttribute("required");
                          doc_div.innerHTML="";
                          retirement.removeAttribute("disabled");
                          retirement.removeAttribute("required");
                          retire_div.innerHTML="";
                      }else if(emp_type.value=="PE"){
                          // DOP.setAttribute("required", "required");
                          // dop_div.innerHTML="*";
                          // DOP.value="";
                          DOP.removeAttribute("required");
                          dop_div.innerHTML="";
                          DOC.setAttribute("required", "required");
                          doc_div.innerHTML="*";
                          retirement.removeAttribute("disabled");
                          retirement.setAttribute("required", "required");
                          retire_div.innerHTML="*";
                      } else {
                          DOP.setAttribute("required", "required");
                          DOC.setAttribute("required", "required");
                          retirement.removeAttribute("disabled");
                          retirement.removeAttribute("required");
                          dop_div.innerHTML="";
                          doc_div.innerHTML="";
                          retire_div.innerHTML="";
                      }
                  }
    
                </script>
    
    <style>
      .nav-link {
          padding: 0.5rem 7.5px !important;
      } 
      </style>
    
    
                                    <div class="statbox widget box box-shadow">
                                      <div class="widget-content widget-content-area border-tab">
                                        
                          <ul class="nav nav-tabs" id="border-tabs" role="tablist">
                       
                              <li class="nav-item">
                                  <a class="nav-link <?php if($button==="0"){echo "active";}elseif($button==='OFFICIAL_DETAILS'){echo 'active';}?>" onclick="storetype('OFFICIAL_DETAILS')" id="OFFICIAL_DETAILS" data-toggle="tab" href="#tab1" role="tab" aria-controls="border-home" aria-selected="true"> OFFICIAL DETAILS</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link <?php if($button==='PERSONNEL_DETAILS'){echo 'active';} ?>" onclick="storetype('PERSONNEL_DETAILS')" id="PERSONNEL_DETAILS"  data-toggle="tab" href="#tab2" role="tab" aria-controls="border-profile" aria-selected="false"> PERSONNEL DETAILS</a>
                              </li>
                              
                              
                              <li class="nav-item">
                                  <a class="nav-link <?php if($button==='DEPENDENT'){echo 'active';} ?>" onclick="storetype('DEPENDENT')" id="DEPENDENT" data-toggle="tab" href="#tab3" role="tab" aria-controls="border-contact" aria-selected="false"> DEPENDENT</a>
                              </li>
                                                 
                             <li class="nav-item">
                                  <a class="nav-link <?php if($button==='QUALIFICATION'){echo 'active';} ?>" onclick="storetype('QUALIFICATION')" id="QUALIFICATION" data-toggle="tab" href="#tab4" role="tab" aria-controls="border-contact" aria-selected="false"> QUALIFICATION</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link <?php if($button==='EXPERIENCE'){echo 'active';} ?>" onclick="storetype('EXPERIENCE')" id="EXPERIENCE" data-toggle="tab" href="#tab5" role="tab" aria-controls="border-contact" aria-selected="false">EXPERIENCE</a>
                              </li>
     
                              <li class="nav-item">
                                  <a class="nav-link <?php if($button==='TRANSFER'){echo 'active';} ?>" onclick="storetype('TRANSFER')" id="TRANSFER" data-toggle="tab" href="#tab6" role="tab" aria-controls="border-contact" aria-selected="false"> TRANSFER</a>
                              </li>
                              
                                <li class="nav-item">
                                  <a class="nav-link <?php if($button==='PROMOTION'){echo 'active';} ?>" onclick="storetype('PROMOTION')" id="PROMOTION" data-toggle="tab" href="#tab7" role="tab" aria-controls="border-contact" aria-selected="false"> PROMOTION</a>
                              </li>
    
                              <li class="nav-item">
                                  <a class="nav-link <?php if($button==='PROBATION'){echo 'active';} ?>" onclick="storetype('PROBATION')" id="PROBATION" data-toggle="tab" href="#tab8" role="tab" aria-controls="border-contact" aria-selected="false"> PROBATION</a>
                              </li>
                               
    
                              <li class="nav-item">
                                  <a class="nav-link <?php if($button==='CONTRACT'){echo 'active';} ?>" onclick="storetype('CONTRACT')" id="CONTRACT" data-toggle="tab" href="#tab9" role="tab" aria-controls="border-contact" aria-selected="false"> CONTRACT</a>
                              </li>
    
                              <li class="nav-item">
                                  <a class="nav-link <?php if($button==='ANTECEDENT'){echo 'active';} ?>" onclick="storetype('ANTECEDENT')" id="ANTECEDENT" data-toggle="tab" href="#tab10" role="tab" aria-controls="border-contact" aria-selected="false"> ANTECEDENT</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link <?php if($button==='REVOCATION'){echo 'active';} ?>" onclick="storetype('REVOCATION')" id="REVOCATION" data-toggle="tab" href="#tab11" role="tab" aria-controls="border-contact" aria-selected="false"> REVOCATION</a>
                              </li>
                                <li class="nav-item">
                                  <a class="nav-link <?php if($button==='APPRECIATION'){echo 'active';} ?>" onclick="storetype('APPRECIATION')" id="APPRECIATION" data-toggle="tab" href="#tab12" role="tab" aria-controls="border-contact" aria-selected="false">APPRECIATION</a>
                              </li>
                                <li class="nav-item">
                                  <a class="nav-link <?php if($button==='REWARD'){echo 'active';} ?>" onclick="storetype('REWARD')" id="REWARD" data-toggle="tab" href="#tab13" role="tab" aria-controls="border-contact" aria-selected="false"> REWARD </a>
                              </li>
                                <li class="nav-item ">
                                  <a class="nav-link <?php if($button==='INITIATION'){echo 'active';} ?>" onclick="storetype('INITIATION')" id="INITIATION" data-toggle="tab" href="#tab14" role="tab" aria-controls="border-contact" aria-selected="false"> INITIATION</a>
                              </li>
                                <li class="nav-item">
                                  <a class="nav-link <?php if($button==='ACHIEVEMENT'){echo 'active';} ?>" onclick="storetype('ACHIEVEMENT')" id="ACHIEVEMENT" data-toggle="tab" href="#tab15" role="tab" aria-controls="border-contact" aria-selected="false"> ACHIEVEMENT</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link <?php if($button==='REMARK'){echo 'active';} ?>" onclick="storetype('REMARK')" id="REMARK" data-toggle="tab" href="#tab16" role="tab" aria-controls="border-contact" aria-selected="false"> REMARK</a>
                            </li>
                          </ul>
    
    
    
                    <div class="tab-content  p-sec" id="border-tabsContent">
    
     <div class="tab-pane fade <?php if($button==="0"){echo "show active";}elseif($button==='OFFICIAL_DETAILS'){echo 'show active';}?>" id="tab1" role="tabpanel" aria-labelledby="border-home-tab">
    
        <div class="col-lg-12 emp-sec">
          <div class="row">
            <div class="col-sm-12">
                <h4 class="">Pay Scale Details</h4>
             </div>
          
    
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="fullName"> Grade</label>
    
                                            <select class="form-control"   id="packageid" name="grade_code_arr" @php if(Auth::user()->role !== "Administrator"){echo "disabled";}@endphp>
    
                                                <option value="">--Select--</option>
    
                                                @foreach($pay_grade_view as $ky=>$val)
                                              
    
                                                  <option value="{{$val->pay_grade_code}}"{{$val->pay_grade_code==$EmployeeAllInfo->PAY_GRADE_CODE ? 'selected':''}}>{{$val->pay_grade_code}}
                                                  </option>
    
                                               @endforeach
                                               
    
                                          </select>
                                         
                                    </div>
                                </div>
    
                            <div class="col-sm-2">
                                    <div class="form-group">
                                      <?php
                                      $ps=array();
                                        foreach($pay_grade_view as $ky=>$val)
                                        {
                                         if($val->pay_grade_code == $EmployeeAllInfo->PAY_GRADE_CODE){
                                                  $ps = DB::table('pay_grade_mst')->where('pay_grade_code',$val->pay_grade_code)->get();
                                                 // print_r($ps[0]->pay_scale);
                                                }
                                        }
                                            
                                       
                                           ?>
                                           <label for="fullName" >Pay Grade</label>
                                        <input type="text" class="form-control "   value="{{@$ps[0]->pay_scale}}" name ="pay_grade" id='catch_value' style="font-size: 13px;color: black;" readonly="readonly">
    
                                       
    
                                    </div>
                                </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
    
                                        <label for="fullName">PF A/C No</label>
                                        <input type="text" class="form-control "  value="{{$EmployeeAllInfo->pf_ac_no}}" name="pf">
    
                                    </div>
                                </div>
    
                            <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="fullName">VPF %</label>
                                        <input type="text" class="form-control " id="vperc_textbox" value="{{$EmployeeAllInfo->vp_perc}}" name ="vpf" placeholder="Ex: 10.00">
                                    </div>
                                </div>
                            <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="fullName">ESI A/C No</label>
                                        <input type="number" class="form-control " onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10" value="{{$EmployeeAllInfo->esi_ac_no}}"  name ="esi" id="esiacc">
                                    </div>
                                </div>
    
                            <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="fullName">PAN No</label>
                                        <input type="text" class="form-control "   value="{{$EmployeeAllInfo->pan_no}}" name="PAN">
                                    </div>
                                </div>
    
    
                            
    
                                
                                <div class="col-sm-4">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">

                                        <label for="fullName">Initial Basic</label>
                                        <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control "   value="{{@$EmployeeAllInfo->intial_basic}}" name="intial_basic" id="intial_basic" @php if(Auth::user()->role !== "Administrator"){echo "readonly";}@endphp>
                                      
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="fullName">Initial PP1</label>
                                        <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control "    value="{{@$EmployeeAllInfo->initial_pp1}}" name="initial_pp1" id="initial_pp1" @php if(Auth::user()->role !== "Administrator"){echo "readonly";}@endphp>
                                      </div>
                                      
                                    </div>
                                  </div>

                              </div>

<div class="col-sm-4">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="fullName">Initial PP2</label>
        <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control "    value="{{@$EmployeeAllInfo->initial_pp2}}" name="initial_pp2" id="initial_pp2" @php if(Auth::user()->role !== "Administrator"){echo "readonly";}@endphp>
    </div>
    </div>
  
    <div class="col-md-8">
        <div class="form-group">
          <?php
    // $ps=array();
    // foreach($pay_grade_view as $ky=>$val)
    // {
    // if($val->pay_grade_code == $EmployeeAllInfo->PAY_GRADE_CODE){
    // $ps1 = DB::table('pay_grade_mst')->where('special_allowance',$val->special_allowance)->get();
    // }
    // }
    // @$ps1[0]->intial_special
    ?>
    <label for="fullName">Initial Special Allowance</label>
    <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="initial_allowance" class="form-control "   name ="intial" value="{{$EmployeeAllInfo->intial_special}}" style="font-size: 13px;color: black;" @php if(Auth::user()->role !== "Administrator"){echo "readonly";}@endphp>
    </div>
    </div>
  </div>
</div>

<div class="col-sm-4">
  <div class="form-group">
              <?php
    // $ps=array();
    //   foreach($pay_grade_view as $ky=>$val)
    //   {
    //    if($val->pay_grade_code == $EmployeeAllInfo->PAY_GRADE_CODE){
    //             $ps2 = DB::table('pay_grade_mst')->where('other_special_allowance',$val->other_special_allowance)->get();
    //           // print_r($ps1[0]->special_allowance);
    //           }
    //   }
          
    //   @$ps2[0]->other_special_allowance
         ?>
      <label for="fullName">Initial Other Allowance</label>
      <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control "   value="{{$EmployeeAllInfo->intial_other_special}}" name="initial_other" id="initial_other"  style="font-size: 13px;color: black;" @php if(Auth::user()->role !== "Administrator"){echo "readonly";}@endphp>
      
  </div>
</div>


                                

                              <div class="col-sm-4">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="fullName">Current Basic</label>
                                      <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control "    value="{{@$EmployeeAllInfo->new_basic_pay}}" name="current_basic" id="current_basic" @php if(Auth::user()->role !== "Administrator"){echo "readonly";}@endphp>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="fullName">Current PP1</label>
                                      <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control "    value="{{@$EmployeeAllInfo->pp1}}" name="pp1" id="pp1" @php if(Auth::user()->role !== "Administrator"){echo "readonly";}@endphp>
                                  </div>
                                    
                                  </div>
                                </div>
                            </div>


      <div class="col-sm-4">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="fullName">Current PP2</label>
              <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control "    value="{{@$EmployeeAllInfo->pp2}}" name="pp2" id="pp2" @php if(Auth::user()->role !== "Administrator"){echo "readonly";}@endphp>
          </div>
          </div>
      
          <div class="col-md-8">
            <div class="form-group">
              <?php
            // $ps=array();
            // foreach($pay_grade_view as $ky=>$val)
            // {
            // if($val->pay_grade_code == $EmployeeAllInfo->PAY_GRADE_CODE){
            //   $ps1 = DB::table('pay_grade_mst')->where('special_allowance',$val->special_allowance)->get();
            // }
            // }
            // @$ps1[0]->special_allowance
            ?> 
            <label for="fullName">Current Special Allowance</label>
            <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control "   value="{{@$EmployeeAllInfo->spl_allow}}"  name="current" id="current_allowance"  style="font-size: 13px;color: black;" @php if(Auth::user()->role !== "Administrator"){echo "readonly";}@endphp>
            </div>
            
          </div>
        </div>
      </div>


      <div class="col-sm-4">
        <div class="form-group">
              <?php
          // $ps=array();
          //   foreach($pay_grade_view as $ky=>$val)
          //   {
          //    if($val->pay_grade_code == $EmployeeAllInfo->PAY_GRADE_CODE){
          //             $ps2 = DB::table('pay_grade_mst')->where('other_special_allowance',$val->other_special_allowance)->get();
          //           // print_r($ps1[0]->special_allowance);
          //           }
          //   }
                
          //   @$ps2[0]->other_special_allowance
               ?>  
            <label for="fullName">Current Other Allowance</label>
            <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control "   value="{{ $EmployeeAllInfo->conv_allow}}" name="current_other" id="cuurent_other"  style="font-size: 13px;color: black;" @php if(Auth::user()->role !== "Administrator"){echo "readonly";}@endphp>
      
        </div>
      </div>

                                
                                 

                                <div class="col-sm-4">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="fullName">UAN</label>
                                        <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  class="form-control " id="uano" value="{{$EmployeeAllInfo->UAN}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="uan">
                                    </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="fullName">Aadhaar No</label>
                                        <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="12" maxlength="12" name="adhar"  onkeypress="return event.charCode >= 48 && event.charCode <= 57"  id="input-payment-egn3" class="form-control" 
                                        value="{{$EmployeeAllInfo->AADHAAR_NO}}"/>
                                       <div id="wrong-egn3">Please provide 12 digit  Aadhaar Number.</div>
                                    </div>
                                    </div>
                                  </div>
                                 
                                </div>
                               
                                 
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="fullName">Contract Salary</label>
                                        <input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control"  value="{{$EmployeeAllInfo->CONT_SAL}}" id="CONT_SAL" name="CONT_SAL" >
                                    </div>
                                </div>
                                 


                                <div class="col-sm-2">
                                  <div class="form-group"> 
                                 <label for="fullName">PF Deduction</label><br>
                                       <label class="radio-inline">
                                            <input type="radio" name="optradio" value="Y" 
                                            {{ ($EmployeeAllInfo->pf_ded=="Y")? "checked" : "" }}> Yes
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="optradio" value="N" {{ ($EmployeeAllInfo->pf_ded=="N")? "checked" : "" }}> No
                                          </label>
     
  
                                  </div>
                              </div>
  
                               <div class="col-sm-2">
                                  <div class="form-group">
  
                                      <label for="fullName">ESI Deduction</label><br>
                                      <label class="radio-inline">
                                            <input type="radio" name="optradio1" value="Y"  {{ ($EmployeeAllInfo->esi_ded=="Y")? "checked" : "" }}> Yes
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="optradio1"  value="N" {{ ($EmployeeAllInfo->esi_ded=="N")? "checked" : "" }}> No
                                          </label>
  
                                  </div>
                              </div>
                                    
    
                                <div class="user-info">
                                   
                                        
                               </div>
                 
                              </div>
    
                            </div>
    
           <div class="col-lg-12 emp-sec"> 
          <div class="row b-sec">
       <div class="col-lg-6 "> 
        <div class="card component-card_4">
                <div class="card-body">
                  
                    <div class="user-info">
                        <h5 class="card-user_name">Bank Details</h5>
                            <div class="col-sm-12">
                                    <div class="form-group">
    
                                        <label for="fullName">Payment Mode </label>
                                        <input type="text" class="form-control "   value="{{@$EmployeeAllInfo->payment_mode}}" name="payment_bank_mode" >
    
                                    </div>
                                </div>
                   
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <label for="fullName">Bank: </label>
                                           <lable for="fullName" id="bank"></lable>
                                        <!--  <input type="text" class="form-control "   value="{{@$EmployeeAllInfo->bank_code}}" name="bank_name"  > -->
    
                                          <select class="form-control " id="exampleFormControlSelect1" name="bank_name" required>
                                        <option>Select</option>
                                    @foreach($Bank_view as $ky=>$val)
                                        <option value="{{$val->bank_code}}"{{$val->bank_code==$EmployeeAllInfo->bank_code ? 'selected':''}}>{{$val->bank_name}}
                                        </option>
                                           @endforeach
                                        </select>
    
                                    </div>
                                  </div>
                                   <div class="col-sm-12">
                                    <div class="form-group">
    
                                        <label for="fullName">Bank A/C No: </label>
                                        <lable for="fullName" id="bank"></lable>
                                        <input type="text" class="form-control "   value="{{@$EmployeeAllInfo->bank_ac_no}}" \
                                        name="account_num" >
    
                                    </div>
                                  </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-lg-6 "> 
             <div class="card component-card_4">
                <div class="card-body">
                  
                    <div class="user-info">
                        <h5 class="card-user_name">Increment Details</h5>
                       
                                          <div class="col-sm-12">
                                          <div class="form-group">
                                        <label for="fullName">Increment Due Date :</label>
                                       <lable for="fullName" id="bank"> </lable>
                                        <input type="date" class="form-control "   value="{{@$EmployeeAllInfo->incr_due_date}}" name="incr_date"  >
                                     </div>
    
                                    </div>
                                       <div class="col-sm-12">
                                        <div class="form-group">
                                        <label for="fullName">Increment Amount: </label>
                                           <lable for="fullName" id="bank"></lable>
                                           <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control "   value="{{@$EmployeeAllInfo->incr_amt}}" name="incr_amount"  >
                                        </select>
    
                                    </div>
                                  </div>
                    </div>
                </div>
            </div>
        </div>
    
                               
    
                 </div>
            </div>
    
    
        </div>
      
    
       
        <div class="tab-pane fade <?php if($button==='PERSONNEL_DETAILS'){echo 'show active';}?>" id="tab2" role="tabpanel" aria-labelledby="border-profile-tab">
        <div class="col-lg-12 emp-sec">
        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                <label for="fullName">Gender</label><br>
                <input type="radio"  name="sex" value="M" {{ ($EmployeeAllInfo->sex=="M")? "checked" : "" }}>
                <label for="vehicle1">Male</label>&nbsp;&nbsp;
                <input type="radio" name="sex" value="F" {{ ($EmployeeAllInfo->sex=="F")? "checked" : "" }}>
                <label for="vehicle1">Female</label>
    
            </div>
        </div>
    
        <div class="col-sm-3">
            <div class="form-group">
                <label for="fullName">Marital Status</label>
                <select class="form-control" name="marital" id="ddlModels">
                  <option>select</option>
                 <option <?php if($EmployeeAllInfo->marital_status == 'M'){ echo "selected"; } else { echo ""; } ?> value="M">Married</option>
                 <option <?php if($EmployeeAllInfo->marital_status == 'U'){ echo "selected"; } else { echo ""; } ?> value="U">UnMarried</option>
                </select>
            </div>
        </div>
    
    
                                                  
        <div class="col-sm-3">
            <div class="form-group">
                <label for="fullName">Blood Group</label>
                <select class="form-control" name="blood">
                  <option>select</option>
                   <option <?php if($EmployeeAllInfo->blood_group == 'O+'){ echo "selected"; } else { echo ""; } ?> value="O+">O+</option>
                <option <?php if($EmployeeAllInfo->blood_group == 'A+'){ echo "selected"; } else { echo ""; } ?> value="A+">A+</option>
                <option <?php if($EmployeeAllInfo->blood_group == 'A-'){ echo "selected"; } else { echo ""; } ?> value="A-">A-</option>
                <option <?php if($EmployeeAllInfo->blood_group == 'B+'){ echo "selected"; } else { echo ""; } ?> value="B+">B+</option>
                <option <?php if($EmployeeAllInfo->blood_group == 'B-'){ echo "selected"; } else { echo ""; } ?> value="B-">B-</option>
                <option <?php if($EmployeeAllInfo->blood_group == 'AB+'){ echo "selected"; } else { echo ""; } ?> value="AB+">AB+</option>
                <option <?php if($EmployeeAllInfo->blood_group == 'AB-'){ echo "selected"; } else { echo ""; } ?> value="AB-">AB-</option>
          
                <option <?php if($EmployeeAllInfo->blood_group == 'O-'){ echo "selected"; } else { echo ""; } ?> value="O-">O-</option>
                </select>
            </div>
        </div>
       <div class="col-sm-4">
          <div class="form-group">
            <label for="fullName">Identification Mark</label>
            <input type="text" class="form-control " name="id"   value="{{$EmployeeAllInfo->id_mark}}">
    
          </div>
       </div>
                                     
       <div class="col-sm-2">
          <div class="form-group">
            <label for="fullName">Spouse Name</label>
            <input type="text" class="form-control " name="spouse"  id="spouseName"  value="{{$EmployeeAllInfo->spouse_name}}">
    
           </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="fullName">Spouse's Date Of Birth</label>
                <input type="date" class="form-control " name="spouse_dob" id="spouseDOB"   value="{{$EmployeeAllInfo->spouse_dob}}">
            </div>
        </div>
    
        <div class="col-sm-2">
           <div class="form-group">
            <label for="fullName">Father Name</label>
            <input type="text" class="form-control " name="father"   value="{{$EmployeeAllInfo->father_name}}">
            </div>
       </div>
    
    
     <div class="col-sm-2">
            <div class="form-group">
    
                <label for="fullName">Father's Date Of Birth</label>
                <input type="date" class="form-control " name="father_dob"  value="{{$EmployeeAllInfo->father_dob}}">
    
            </div>
     </div>
    
     <div class="col-sm-2">
            <div class="form-group">
    
                <label for="fullName">Mother Name</label>
                <input type="text" class="form-control " name="mother"   value="{{$EmployeeAllInfo->mother_name}}">
    
            </div>
        </div>
    
    
        <div class="col-sm-2">
                <div class="form-group">
    
                    <label for="fullName">Mother's Date Of Birth</label>
                    <input type="date" class="form-control " name="mother_dob"  value="{{$EmployeeAllInfo->mother_dob}}">
    
                </div>
        </div>
    
     <div class="col-sm-3">
        <div class="form-group">
    
            <label for="fullName">Present Address</label>
            <input type="text" class="form-control "  placeholder="line1"  name="line_11" value="{{$EmployeeAllInfo->present_address1}}">
            <input type="text" class="form-control " placeholder="line2" name="line_22"  value="{{$EmployeeAllInfo->present_address2}}">
            <input type="text" class="form-control " placeholder="line3" name="line_33"  value="{{$EmployeeAllInfo->present_address3}}">
    
        </div>
    </div>
    
     <div class="col-sm-3">
        <div class="form-group">
    
            <label for="fullName">Permanent Address</label>
            <input type="text" class="form-control "  placeholder="per_line1" name="per_line1" value="{{$EmployeeAllInfo->PERM_ADDRESS1}}">
            <input type="text" class="form-control " placeholder="per_line2" name="per_line2"  value="{{$EmployeeAllInfo->PERM_ADDRESS2}}">
            <input type="text" class="form-control " placeholder="per_line3" name="per_line3"  value="{{$EmployeeAllInfo->PERM_ADDRESS3}}">
    
        </div>
    </div>
    
     <div class="col-sm-3">
        <div class="form-group">
            <label for="fullName">Contact No</label><br>
    
            <input type="number"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" value="{{$EmployeeAllInfo->ph_no}}" name="contactnumber" id="input-payment-egn">
            <div id="wrong-egn">Please provide 10digit number.</div>
        </div>
    </div>
     <div class="col-sm-3">
        <div class="form-group">
            <label for="fullName">Email</label><br>
            <input type="email" id="email" class="form-control" value="{{$EmployeeAllInfo->email}}" name="email">
        </div>
    </div>
    </div>
    </div>
    </div>
    
    
    <div class="tab-pane fade <?php if($button==='DEPENDENT'){echo 'show active';}?>" id="tab3" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
        <div class="offset-lg-11 col-lg-1 new" id="addBtn1">ADD NEW</div>
    
        <div class="tableFixHead">    
    <table class="table table-bordered table-hover e-table" >
    <thead class="e-head">
    <tr>
      <th>Sl No</th>
    <th>Dependent Name: <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Type</th>
    <th>Date Of Birth:</th>
    <th>Age:</th>
    <th>Relationship:</th>
    <th>Aadhaar No:</th>
    <th>Address</th>
    <th>Upload Aadhaar</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Cancel</th>
    </tr>
    </thead>
    <tbody id="e-body">
    @php 
    $ctr=0;
    $i=0;
    $counter=0;
    @endphp
    
    @foreach($EmployeeDependentInfo as $key=>$value)
    @php
      $ctr++;
    @endphp
    <tr>
    <td><input type="number" value="{{$value->SL_NO}}" class="form-control td2" onkeypress="return isNumberKey(event)" name="depend_snno[]" id="depend_snno{{$i}}"  ></td>
    <td class="td2">
    <input type="hidden" class="form-control" name="depedent_sql_id[]" placeholder="enter dependent name" value="{{$value->id}}">
      <input type="text" class="form-control width" name="name[]" placeholder="enter dependent name" value="{{$value->depd_name}}"></td>
      <td><select class="form-control nm" name="dependent_type[] "style="width: 124px"  onchange="nominee_select(this.value,{{$i}})"  value="{{$value->type}}" id="one{{$i}}" >
       
         <option <?php if($value->type == 'Dependent'){ echo "selected"; } else { echo ""; } ?> value="Dependent">Dependent</option>
                 <option <?php if($value->type == 'Nominee'){ echo "selected"; } else { echo ""; } ?> value="Nominee">Nominee</option>
      </select></td>
    <td><input type="date" class="form-control" name="dob1[]" id="dob_{{ $i }}" onchange="check_age('dob_{{ $i }}','age_{{ $i }}','{{$i}}')" placeholder="enter DOB" value="{{$value->depd_dob}}"></td>
    
    <td class="td1"><input type="text" readonly class="form-control" id="age_{{ $i }}" name="age[]" value="{{agecounter($value->depd_dob)}}"style="width: 50px;" >
      {{-- $value->age --}}
    </td>
    <td><input type="text" class="form-control" name="relation[]" placeholder="" value="{{$value->relationship}}" style="width: 207px;"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width" name="num[]" placeholder="enter aadhaar" value="{{$value->DEPD_AADHAAR_NO}}" style="width: 207px;"></td>
    <td><textarea rows="3" cols="40" class="form-control"  name="dependent_addr[]" style="width:200px;">{{$value->address}}</textarea></td>
    @if($value->upload_adhara!="")
    <td class="">
      <input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="dependent_file[]" style="width: 215px;">
    </td>
      <td>
        <?php if(!$value->upload_adhara==""){
          if(file_exists(public_path()."/dependent/".$value->upload_adhara)) {?>
        <button type="button" onclick="openmodal('public/dependent/{{$value->upload_adhara}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
    </td>
      <td>
        <?php if(!$value->upload_adhara==""){
    
          if(file_exists(public_path()."/dependent/".$value->upload_adhara)) {?>
          <div class="row">
            <div class="col-md-4">
              <a href="{{ url('public/dependent/'.$value->upload_adhara) }}" download="{{ $value->upload_adhara }}">
                <i class="fa fa-download" style="font-size:22px;"></i>
              </a>
            </div>
            <div class="col-md-4">
              <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("dependent") }}&file={{ $value->upload_adhara }}&t={{ base64_encode("emp_dependent_dtl") }}&c={{ base64_encode("upload_adhara") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
                <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
              </a>
            </div>
            <div class="col-md-4">
              @php
              $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
              $explodeImage = explode('.', $value->upload_adhara);
              $extension = end($explodeImage);
            @endphp
            @if(in_array($extension, $imageExtensions))
            <img src="{{ url('public/dependent/'.$value->upload_adhara) }}" style="width:20px;height:20px;" >
              {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
            @elseif(strpos($extension, 'pdf') !== false)
              <i class="fa fa-file-pdf" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'xlsx') !== false)
              <i class="fa fa-file-excel" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'doc') !== false)
              <i class="fa fa-file-word" style="font-size:22px;"></i>
            @endif
            </div>
          </div>
        
        
    
       
        
         <?php } ?>
    
    
         <?php } ?>
      </td>
     @else
    
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="dependent_file[]" style="width: 215px;"></td> 
          <td></td>   
          <td></td>       
    @endif
    
    <td><button type="button" onclick="deletedependent({{$value->id}});" style="background-color: #7d98da" >X</button></td>
    
    </tr>
    
    @php
    $counter =$i;
    $i++;
    @endphp
    @endforeach
    
    
    @if($ctr==0)
        <tr>
          <td><input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="depend_snno[]" id="depend_snno{{$i}}"  ></td>
            <input type="hidden" class="form-control" name="depedent_sql_id[]">
    <td class="td2"><input type="text" class="form-control width" name="name[]" placeholder="" ></td>
    <td><select class="form-control nm" name="dependent_type[] "style="width: 124px"  onchange="nominee_select(this.value,{{$i}})"   id="one{{$i}}" >
        <option>Dependent</option>
        <option>Nominee</option></select></td>
    <td><input type="date" class="form-control" name="dob1[]" id="dob_{{ $i }}" onchange="check_age('dob_{{ $i }}','age_{{ $i }}','{{$i}}')" placeholder="enter DOB"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control  td1" readonly id="age_{{ $i }}"  name="age[]" ></td>
    <td class="td2"><input type="text" class="form-control " name="relation[]" placeholder="enter your relation" style="width: 207px;"></td>
    <td  class="td2"><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width" name="num[]" placeholder="enter adhara"  ></td>
    <td><textarea rows="3" cols="40" class="form-control"  name="dependent_addr[]" style="width:200px;"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="dependent_file[]" style="width: 215px;"></td>
    <td></td>
    <td></td>
    <td>
       <button type="button" class="deletebtn" title="Remove row" style="background-color: #7d98da">X</button>
    </td>
    
    </tr>
    
    @endif
    
    </tbody>
    
    </table>
        </div>
    </div>
    </div> 
    
    <div class="tab-pane fade show <?php if($button==='QUALIFICATION'){echo 'show active';}?>" id="tab4" role="tabpanel" aria-labelledby="border-home-tab">
        <div class="col-lg-12 emp-sec">
          <div class="row">
            <div class="col-sm-12">
                <h4 class="">Academic</h4>
            </div>
            <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
     <div class="offset-lg-11 col-lg-1 new" id="addBtnQual">ADD NEW</div>
     <div class="tableFixHead">
    <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>Sl No</th>
    <th>Qualification Level <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Academic Qualification</th>
    <th>Stream/ Subject:</th>
    <th style="padding-left: 22px;"> Board/University </th>
    <th>Year Of Passing:</th>
    <th>% Of Mark:</th>
    <th>Division</th>
    <th>Remark</th>
    <th>Upload Document:</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    
    </tr>
    </thead>
    
    <tbody id="e-body_qual">
      @php 
      $ctr_qual=0;
      @endphp
      @foreach($EmployeeQualificationInfo as $key=>$value)
      @php
      $ctr_qual++;
    @endphp
    <tr>
    @if($value->qualification_type=="A")
    <td>
      <input type="number" value="{{$value->SL_NO}}" class="form-control td2" onkeypress="return isNumberKey(event)" name="academic_snno[]" id="academic_snno{{$value->id}}"  >
    </td> 
    <td> <input type="hidden" class="form-control" name="qlf_hiddenSqlid[]" value="{{$value->id}}"> 
       <input type="hidden" class="form-control" name="typcce[]" value ="{{$value->qualification_type}}"> 
    <select class="form-control width" name="academic[]">
      <option>Select</option>
         @foreach($Qual_lvl as $ky=>$val)
          <option value="{{$val->id}}"{{$val->QUALIFICATION_LEVEL_CODE==$value->qualification_level_code ? 'selected':''}}>{{$val->QUALIFICATION_LEVEL}}
                                          </option>      
                                     @endforeach
      
    
        </select></td>
         <td><input type="text" class="form-control width" placeholder="" name="qualification[]" value="{{$value->emp_quali}}"></td>
    <td><input type="text" class="form-control width" placeholder="Arts" name="stream[]" value="{{$value->stream_subject}}"> </td>
    <td>
    <!--      <select class="form-control" name="board_name_ajax1[]" style="    width: 409px;">
             @foreach($Board_view as $ky=>$val) 
                 <option value="{{$val->board_name}}"
                        {{$val->board_name==$value->institution
                              ? 'selected':''}}>{{$val->board_name}}
                      </option>      
                
            @endforeach --> 
             <input type="text" class="form-control" name="board_name_ajax1[]" value="{{$value->institution}}" style="width: 409px;">
        </select>
    <!--     <div class="container box">
              <input type="text" class="form-control" name="board_name_ajax1[]" style="width: 409px;margin-left: -16px;" value="{{$value->institution}}">
          <div id="boardList">
      
        </div> -->
    
    </td>
    <td> 
      {{-- @php
        echo isset($value->year_passing);
      @endphp --}}
      <input type="text" class="form-control"  name="year[]" value="{{$value->year_passing}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width:75px">
    </td>
    <td><input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="per_mark[]" value="{{$value->mark_perc}}" style="width:54px"></td>
    <td>
       <select class="form-control width" width="130px"  name="division_qualification[]" >
        <option value="">select</option>
        <option value="P" <?php if($value->division == 'P'){ echo "selected"; } ?> >Pass</option>
     <option <?php if($value->division == 'F'){ echo "selected"; } else { echo ""; } ?> value="F">First</option>
     <option <?php if($value->division == 'S'){ echo "selected"; } else { echo ""; } ?> value="S">Second</option>
      <option <?php if($value->division == 'T'){ echo "selected"; } else { echo ""; } ?> value="T">Third</option>
    </select>
    
    </td>
    <td><textarea rows="3" cols="40" class="form-control"  name="remark_qualification[]" style="width:200px;">{{$value->remark_qualification}}</textarea></td>
    @if($value->upload!="")
    <td class="">
      <input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67" name="qualification_file[]" style="width: 215px;">
    </td>
      <td>
        <?php if($value->upload!==""){
          if(file_exists(public_path()."/qualification/".$value->upload)) {?>
        <button type="button" onclick="openmodal('public/qualification/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
        <?php }} ?>
      </td>
      <td>
    
        <?php if(!$value->upload==""){
    
          if(file_exists(public_path()."/qualification/".$value->upload)) {?>
          <div class="row">
            <div class="col-md-4">
              <a href="{{ url('public/qualification/'.$value->upload) }}" download="{{ $value->upload }}">
                <i class="fa fa-download" style="font-size:22px;"></i>
              </a>
            </div>
            <div class="col-md-4">
              <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("qualification") }}&file={{ $value->upload }}&t={{ base64_encode("emp_qualification_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
                <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
              </a>
            </div>
            <div class="col-md-4">
              @php
              $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
              $explodeImage = explode('.', $value->upload);
              $extension = end($explodeImage);
            @endphp
            @if(in_array($extension, $imageExtensions))
            <img src="{{ url('public/qualification/'.$value->upload) }}" style="width:20px;height:20px;" >
              {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
            @elseif(strpos($extension, 'pdf') !== false)
              <i class="fa fa-file-pdf" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'xlsx') !== false)
              <i class="fa fa-file-excel" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'doc') !== false)
              <i class="fa fa-file-word" style="font-size:22px;"></i>
            @endif
            </div>
          </div>
         <?php } ?>
        
        
         <?php } ?>
    
    
    
      </td>
    @else
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="qualification_file[]" style="width: 215px;"></td> 
    <td></td>      
      <td></td>       
    @endif
    
    <td><button type="button" style="background-color: #7d98da" onclick="deletequalification({{$value->id}});" >X</button></td>
    
    
    
    </tr>
    @endif
    @endforeach
    
    @if($ctr_qual==0)
    
      <tr>
        <td>
          <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="academic_snno[]"  >
        </td>  
    
        <td>
          <input type="hidden" class="form-control" name="qlf_hiddenSqlid[]"> 
          <input type="hidden" class="form-control width" placeholder="" value="A" name="typcce[]">
     <select class="form-control width" name="academic[]">
      <option>Select</option>
         @foreach($Qual_lvl as $ky=>$val)
        <option value="{{$val->QUALIFICATION_LEVEL_CODE}}">{{$val->QUALIFICATION_LEVEL}}</option>
            @endforeach
    
        </select></td>
            <td><input type="text" class="form-control width" placeholder="" name="qualification[]"></td>
    <td><input type="text" class="form-control width" placeholder="" name="stream[]"></td>
    
    <td> 
          <div class="container box">
    
     <input type="text" class="form-control" name="board_name_ajax1[]" value="" style="width: 409px;">
        <div id="boardList">
    
      </div>
         </td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="" name="year[]"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="" name="per_mark[]" style="    width: 68px;"></td>
    <td> <select class="form-control width" name="division_qualification[]">
      <option value="">select</option>
      <option value="P" >Pass</option>
                    <option value="F">First</option>
                    <option value="S">Second</option>
                    <option value="T">Third</option>
                 
                </select></td>
    <td><textarea rows="3" cols="40" class="form-control"  name="remark_qualification[]" style="width:200px;"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="" name="qualification_file[]" style="width: 215px;"></td>
    <td></td>      
      <td></td>
      <td><button type="button" class="deletebtn" title="Remove row" 
    style="background-color: #7d98da">X</button></td>
    
      </tr>
      
    @endif
    
    </tbody>
    </table>
     </div>
    </div>
    </td>
    </tr>
    </tbody>
    </td>
    </tr></tbody></table></div></div>
     <div class="col-lg-12 emp-sec">
          <div class="row">
            <div class="col-sm-12">
               <h4 class="">Technical/Professional</h4>
            </div>
            <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
     <div class="offset-lg-11 col-lg-1 new" id="addBtnQual1">ADD NEW</div>
    
     <div class="tableFixHead">
    <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>Sl No</th>
    <th>Qualification Level <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Academic Qualification</th>
    <th>Stream/ Subject:</th>
    <th style="padding-left: 22px;"> Board/University </th>
    <th>Year Of Passing:</th>
    <th>% Of Mark:</th>
    <th>Division</th>
    <th>Remark</th>
    <th>Upload Document:</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    
    </tr>
    </thead>
    
    
    
    <tbody id="e-body_qual1">
      @php 
      $ctr_qual1=0;
      @endphp
      @foreach($EmployeeQualificationInfo as $key=>$value)
      @php
      $ctr_qual1++;
    @endphp
    <tr>
    @if($value->qualification_type=="T")
    <td>
      <input type="number" value="{{$value->SL_NO}}" class="form-control td2" onkeypress="return isNumberKey(event)" name="academic_snno[]" id="academic_snno{{$value->id}}"  >
    </td> 
    
    <td>
      <input type="hidden" class="form-control" name="qlf_hiddenSqlid[]" value="{{$value->id}}"> 
       <input type="hidden" class="form-control" name="typcce[]" value ="{{$value->qualification_type}}"> 
    <select class="form-control width" name="academic[]">
      <option>Select</option>
         @foreach($Qual_lvl as $ky=>$val)
          <option value="{{$val->id}}"{{$val->QUALIFICATION_LEVEL_CODE==$value->qualification_level_code ? 'selected':''}}>{{$val->QUALIFICATION_LEVEL}}
                                          </option>      
                                     @endforeach
      
    
        </select></td>
         <td><input type="text" class="form-control width" placeholder="" name="qualification[]" value="{{$value->emp_quali}}"></td>
    <td><input type="text" class="form-control width" placeholder="Arts" name="stream[]" value="{{$value->stream_subject}}"> </td>
    <td>
    <!--      <select class="form-control" name="board_name_ajax1[]" style="    width: 409px;">
             @foreach($Board_view as $ky=>$val) 
                 <option value="{{$val->board_name}}"
                        {{$val->board_name==$value->institution
                              ? 'selected':''}}>{{$val->board_name}}
                      </option>      
                
            @endforeach --> 
             <input type="text" class="form-control" name="board_name_ajax1[]" value="{{$value->institution}}" style="width: 409px;">
        </select>
    <!--     <div class="container box">
              <input type="text" class="form-control" name="board_name_ajax1[]" style="width: 409px;margin-left: -16px;" value="{{$value->institution}}">
          <div id="boardList">
      
        </div> -->
    
    </td>
    <td><input type="text" class="form-control"  name="year[]" value="{{$value->year_passing}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width:75px"></td>
    <td><input type="text" class="form-control"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="per_mark[]" value="{{$value->mark_perc}}" style="width:54px"></td>
    <td>
       <select class="form-control width" width="130px"  name="division_qualification[]" >
        <option value="">Select Division</option>
        <option <?php if($value->division == 'P'){ echo "selected"; } else { echo ""; } ?> value="P">Pass</option> 
     <option <?php if($value->division == 'F'){ echo "selected"; } else { echo ""; } ?> value="F">First</option>
     <option <?php if($value->division == 'S'){ echo "selected"; } else { echo ""; } ?> value="S">Second</option>
      <option <?php if($value->division == 'T'){ echo "selected"; } else { echo ""; } ?> value="T">Third</option>
    </select>
    
    </td>
    <td><textarea rows="3" cols="40" class="form-control"  name="remark_qualification[]" style="width:200px;">{{$value->remark_qualification}}</textarea></td>
    @if($value->upload!="")
    <td class=""><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67" name="qualification_file[]" style="width: 215px;"></td>
    <td><button type="button" onclick="openmodal('public/qualification/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></td>
      <td>
    
    
        <?php if(!$value->upload==""){
    
          if(file_exists(public_path()."/qualification/".$value->upload)) {?>
          <div class="row">
            <div class="col-md-4">
              <a href="{{ url('public/qualification/'.$value->upload) }}" download="{{ $value->upload }}">
                <i class="fa fa-download" style="font-size:22px;"></i>
              </a>
            </div>
            <div class="col-md-4">
              <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("qualification") }}&file={{ $value->upload }}&t={{ base64_encode("emp_qualification_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
                <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
              </a>
            </div>
            <div class="col-md-4">
              @php
              $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
              $explodeImage = explode('.', $value->upload);
              $extension = end($explodeImage);
            @endphp
            @if(in_array($extension, $imageExtensions))
            <img src="{{ url('public/qualification/'.$value->upload) }}" style="width:20px;height:20px;" >
              {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
            @elseif(strpos($extension, 'pdf') !== false)
              <i class="fa fa-file-pdf" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'xlsx') !== false)
              <i class="fa fa-file-excel" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'doc') !== false)
              <i class="fa fa-file-word" style="font-size:22px;"></i>
            @endif
            </div>
          </div>
         <?php } ?>
        
        
         <?php } ?>
    
    
    
    
      </td>
    @else
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="qualification_file[]" style="width: 215px;"></td> 
    <td></td>  
      <td></td>       
    @endif
    
    <td><button type="button" style="background-color: #7d98da" onclick="deletequalification({{$value->id}});" >X</button></td>
    
    
    
    </tr>
    @endif
    @endforeach
    
    @if($ctr_qual1==0)
    
      
    <tbody>
        <td>
          <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="academic_snno[]"  >
        </td> 
    
        <td>
           <input type="hidden" class="form-control" name="qlf_hiddenSqlid[]"> 
          <input type="hidden" class="form-control width" placeholder="" value="T" name="typcce[]">
    <select class="form-control width" name="academic[]">
      <option>Select</option>
         @foreach($Qual_lvl as $ky=>$val)
        <option value="{{$val->QUALIFICATION_LEVEL_CODE}}">{{$val->QUALIFICATION_LEVEL}}</option>
            @endforeach
    
        </select></td>
            <td><input type="text" class="form-control width" placeholder="" name="qualification[]"></td>
    <td><input type="text" class="form-control width" placeholder="" name="stream[]"></td>
    
    <td> 
          <div class="container box">
    
     <input type="text" class="form-control" name="board_name_ajax1[]" value="" style="width: 409px;">
        <div id="boardList">
    
      </div>
         </td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="" name="year[]"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="" name="per_mark[]" style="    width: 68px;"></td>
    <td> <select class="form-control width" name="division_qualification[]">
      <option value="">Select Division</option>
      <option value="P">Pass</option>
                    <option value="F">First</option>
                    <option value="S">Second</option>
                    <option value="T">Third</option>
                 
                </select></td>
    <td><textarea rows="3" cols="40" class="form-control"  name="remark_qualification[]" style="width:200px;"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="" name="qualification_file[]" style="width: 215px;"></td>
    <td></td>  
      <td></td>
      <td><button type="button" class="deletebtn" title="Remove row" 
    style="background-color: #7d98da">X</button></td>
    
      </tr>
      
    @endif
    
    </tbody>
    </table>
     </div>
         
    </div>
    
         </div>
        </div>
    <div class="col-lg-12"> 
      <div class="row b-sec">
    
                
    
    </div>
    </div>
    </div>   
    
     
    
    <div class="tab-pane fade <?php if($button==='EXPERIENCE'){echo 'show active';}?>" id="tab5" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    
        <div class="offset-lg-11 col-lg-1 new" id="addBtn2">ADD NEW</div>
    
        <div class="tableFixHead">    
    <table class="table table-bordered table-hover" id="maintable_dependent_exp">
    <thead>
    
    <tr>
      <th>Sl No</th>
    <th>Organisation Name: <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Sector:</th>
    <th>Position:</th>
    <th>From Date:</th>
    <th>To Date:</th>
    <th>Reason For Leave</th>
    <th>Remark</th>
    <th>Upload Document:</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    </tr>
    </thead>
    <tbody id="experience_body">
        @php 
      $ctr_exper=0;
      @endphp
      @foreach($EmployeeExperienceInfo as $key=>$value)
      @php
      $ctr_exper++;
    @endphp
    <tr>
      <td>
        <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="experience_snno[]"  value="{{$value->SL_NO}}" >
      </td>
    <td>
    <input type="hidden" class="form-control" name="experience_sql_id[]"  value="{{$value->id}}">
    <input type="text" class="form-control" placeholder=""  name="orgn[]" value="{{$value->orgn_name}}" style="width: 255px;"></td>
    <td><input type="text" class="form-control width2" placeholder="" name="sect[]" value="{{$value->sector}}"></td>
    <td><input type="text" class="form-control width2" placeholder="" name="pos[]" value="{{$value->position}}"></td>
    <td><input type="date" class="form-control" placeholder="01/03/2015" name="from[]"  value="{{$value->start_date}}"></td>
    <td><input type="date" class="form-control" placeholder="01/03/2017" name="to[]"  value="{{$value->end_date}}"></td>
    <td><textarea rows="3" cols="40" class="form-control width"  name="area[]" style="    width: 200px;">{{$value->reason}}</textarea></td>
      <td><textarea rows="3" cols="40" class="form-control"  name="remark_area[]" style="width:250px;">{{$value->remark_area}}</textarea></td>
    @if($value->upload!="")
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67" name="e_file[]" style="width: 215px;"></td>
    
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/experience/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/experience/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
    </td>
      <td>
    
        <?php if(!$value->upload==""){
      if(file_exists(public_path()."/experience/".$value->upload)) {?>
      <div class="row">
        <div class="col-md-4">
          <a href="{{ url('public/experience/'.$value->upload) }}" download="{{ $value->upload }}">
            <i class="fa fa-download" style="font-size:22px;"></i>
          </a>
        </div>
        <div class="col-md-4">
          <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("experience") }}&file={{ $value->upload }}&t={{ base64_encode("emp_experience_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
            <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
          </a>
        </div>
        <div class="col-md-4">
          @php
          $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
          $explodeImage = explode('.', $value->upload);
          $extension = end($explodeImage);
        @endphp
        @if(in_array($extension, $imageExtensions))
        <img src="{{ url('public/experience/'.$value->upload) }}" style="width:20px;height:20px;" >
          {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
        @elseif(strpos($extension, 'pdf') !== false)
          <i class="fa fa-file-pdf" style="font-size:22px;"></i>
        @elseif(strpos($extension, 'xlsx') !== false)
          <i class="fa fa-file-excel" style="font-size:22px;"></i>
        @elseif(strpos($extension, 'doc') !== false)
          <i class="fa fa-file-word" style="font-size:22px;"></i>
        @endif
        </div>
      </div>
     <?php } ?>
     <?php } ?>
    
      </td>
     
     @else
     
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="e_file[]" style="width: 215px;"></td> 
         <td></td>
    <td></td>
       
         
    @endif
    
    <td><button type="button" onclick="deleteorganization({{$value->id}});" style="background-color: #7d98da" >X</button></td>
    </tr>
    @endforeach
    
    @if($ctr_exper==0)
        <tr>
          <td>
            <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="experience_snno[]"  >
          </td>   
      <td>  
        <input type="hidden" class="form-control" name="experience_sql_id[]">
    <input type="text" class="form-control" placeholder=""  name="orgn[]" style="width: 255px;"></td>
    <td><input type="text" class="form-control width2" placeholder="" name="sect[]"></td>
    <td><input type="text" class="form-control width2" placeholder="" name="pos[]"></td>
    <td><input type="date" class="form-control" placeholder="01/03/2015" name="from[]"></td>
    <td><input type="date" class="form-control" placeholder="01/03/2017" name="to[]"></td>
    <td><textarea rows="3" cols="40" class="form-control"  name="area[]"  style="    width: 200px;"></textarea></td>
     <td><textarea rows="3" cols="40" class="form-control"  name="remark_area[]" style="width:250px;"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" name="e_file[]" style="width: 215px;"></td>
    <td></td>
    <td></td>
    <td><button type="button" class="deletebtn" title="Remove row" style="background-color: #7d98da">X</button></td>
    
    </tr>
    @endif
    
    
    </tbody>
    </table>
        </div>
         
    </div>
    </div>  
    
    <div class="tab-pane fade <?php if($button==='TRANSFER'){echo 'show active';}?>" id="tab6" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    <!-- <div class="offset-lg-11 col-lg-1 ">
        <button class="btn btn-md btn-primary" 
          id="addBtn3" type="button">
            Add new Row
        </button></div> -->
        <div class="offset-lg-11 col-lg-1 new" id="add_newtransferno">ADD NEW</div>
        <div class="tableFixHead">
    <table class="table table-bordered table-hover" id="maintable_dependent_trans">
    <thead>
    <tr>
      <th>Sl No</th>
    <th>Transfer Order No. <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Transfer Order Date:</th>
    <th>Type</th>
    <th>From Date:</th>
    <th>To Date:</th>
    <th>From Department:</th>
    <th>To Department:</th>
    <th>From Workplace</th>
    <th>To Workplace</th>
    <th>Reason</th>
    <th>Remarks:</th>
    <th>Upload Document</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    
    
    </tr>
    </thead>
    <tbody id="table_transfer">
      
    
          @php 
      $ctr_trans=0;
      $i=0;
      @endphp
    @foreach($EmployeeTransferInfo as $key=>$value)
      @php
      $ctr_trans++;
    @endphp 
    <tr>
      <td>
        <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="transfer_snno[]"  value="{{$value->SL_NO}}" >
      </td>
    <td>
      <input type="hidden" class="form-control" name="transfer_sql_id[]" value="{{$value->id}}">
    <input type="text" class="form-control width" name="trans_order[]" width="130px" value="{{$value->tranfer_order_no}}"></td>
    <td><input type="date"  class="form-control" width="130px"  value="{{$value->trans_date}}"  name="transfer_ord_date[]"></td>
    <td> <select class="form-control width" width="130px"  name="order_type[]" >
       <option <?php if($value->type == 'Transfer'){ echo "selected"; } else { echo ""; } ?> value="Transfer">Transfer</option>
     <option <?php if($value->type == 'Deputation'){ echo "selected"; } else { echo ""; } ?> value="Deputation">Deputation</option>
        </select></td>
 
    <td><input type="date"  class="form-control" value="{{$value->from_date}}" name="from_date[]"></td>
    <td><input type="date" class="form-control"  value="{{$value->to_date}}" name="to_date[]"></td>
    <td><select class="form-control width"  name="f_dept[]">
    <option>Select</option>
         @foreach($Department_fetch as $ky=>$val)
     <option value="{{$val->dept_no}}" {{$val->dept_no==$value->from_dept? 'selected':''}}>{{$val->dept_name}}</option>
            @endforeach
      </select></td>
    <td><select class="form-control width" name="t_dept[]" onchange="transfer({{$i}})"  id="transferid{{$i}}">
    <option>Select</option>
         @foreach($Department_fetch as $ky=>$val)
       
        <option value="{{$val->dept_no}}"  {{$val->dept_no==$value->to_dept 
                                                            ? 'selected':''}}>{{$val->dept_name}}</option>
        @endforeach
      </select></td>
    <td><select class="form-control width" name="from_work[]">
    <option>Select</option>
    @foreach($Workplace_fetch as $ky=>$val)
    <option value="{{$val->id}}"{{$val->id==$value->from_work ? 'selected':''}}>{{$val->workplace_name}}
                                                  </option>
                                               @endforeach
    </select></td>
    <td><select class="form-control width" name="to_work[]"  onchange="transferWork({{$i}})"  id="transferWorkid{{$i}}">
    <option>Select</option>
    @foreach($Workplace_fetch as $ky=>$val)
      <option value="{{$val->id}}"{{$val->id==$value->to_work ? 'selected':''}}>{{$val->workplace_name}}
        </option>
                           @endforeach
    </select></td>
    
    <td> <select class="form-control width" name="ord_rea[]">
    <option>Select</option>
       <option <?php if($value->reason == 'Reward'){ echo "selected"; } else { echo ""; } ?> value="Reward">Reward</option>
     <option <?php if($value->reason == 'Routine'){ echo "selected"; } else { echo ""; } ?> value="Routine">Routine</option>
      <option <?php if($value->reason == 'Displinary'){ echo "selected"; } else { echo ""; } ?> value="Displinary">Displinary</option>
     <option <?php if($value->reason == 'Other'){ echo "selected"; } else { echo ""; } ?> value="Other">Other</option>
    
        </select></td>
    <td><textarea rows="3" cols="40" class="form-control width" name="reamrks[]">{{$value->REMARK}} </textarea></td>
    @if($value->upload!="")
    
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="trans_file[]" style="width: 215px;"></td>
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/transfer/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/transfer/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
    </td>
    <td>
    
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/transfer/".$value->upload)) {?>
        <div class="row">
          <div class="col-md-4">
            <a href="{{ url('public/transfer/'.$value->upload) }}" download="{{ $value->upload }}">
              <i class="fa fa-download" style="font-size:22px;"></i>
            </a>
          </div>
          <div class="col-md-4">
            <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("transfer") }}&file={{ $value->upload }}&t={{ base64_encode("emp_trnasfer_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
              <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
            </a>
          </div>
          <div class="col-md-4">
            @php
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
            $explodeImage = explode('.', $value->upload);
            $extension = end($explodeImage);
          @endphp
          @if(in_array($extension, $imageExtensions))
          <img src="{{ url('public/transfer/'.$value->upload) }}" style="width:20px;height:20px;" >
            {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
          @elseif(strpos($extension, 'pdf') !== false)
            <i class="fa fa-file-pdf" style="font-size:22px;"></i>
          @elseif(strpos($extension, 'xlsx') !== false)
            <i class="fa fa-file-excel" style="font-size:22px;"></i>
          @elseif(strpos($extension, 'doc') !== false)
            <i class="fa fa-file-word" style="font-size:22px;"></i>
          @endif
          </div>
        </div>
       <?php } ?>
       <?php } ?>
    
    </td>
           
     @else
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="trans_file[]" style="width: 215px;"></td> 
         <td></td>  
         <td></td>        
    @endif
    
    <td><button type="button" onclick="deletetransfer({{$value->id}});"style="background-color: #7d98da">X</button></td>
    </tr>
    @php
    $i++;
    @endphp
    @endforeach
    @if($ctr_trans==0)
        <tr>
          <td>
            <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="transfer_snno[]"  >
          </td>    
      <td>  
        <input type="hidden" class="form-control" name="transfer_sql_id[]">
    <input type="text" class="form-control width" width="130px" name="trans_order[]"></td>
    <td><input type="date"  class="form-control"  width="130px" name="transfer_ord_date[]"></td>
    <td> <select class="form-control width" name="order_type[]" >
      <option value="Transfer">Transfer</option>
      <option value="Deputation">Deputation</option>
        </select></td>
    
    <td><input type="date"  class="form-control" name="from_date[]"></td>
    <td><input type="date" class="form-control" name="to_date[]" ></td>
    <td> <select class="form-control width"  name="f_dept[]">
    <option>Select</option>
         @foreach($Department_fetch as $ky=>$val)
        <option value="{{$val->dept_no}}">{{$val->dept_name}}</option>
            @endforeach
      </select>
    </td>
    <td><select class="form-control width" name="t_dept[]" onchange="transfer({{$i}})"  id="transferid{{$i}}">
    <option>Select</option>
         @foreach($Department_fetch as $ky=>$val)
    
        <option value="{{$val->dept_no}}">{{$val->dept_name}}</option>
            @endforeach
      </select></td>
    <td><select class="form-control width" name="from_work[]">
    <option>Select</option>
    @foreach($Workplace_fetch as $ky=>$val)
    
         <option value="{{$val->id}}">{{$val->workplace_name}}</option>
     @endforeach
    </select></td>
    <td><select class="form-control width" name="to_work[]"  onchange="transferWork({{$i}})"  id="transferWorkid{{$i}}">
    <option>Select</option>
    @foreach($Workplace_fetch as $ky=>$val)
         <option value="{{$val->id}}">{{$val->workplace_name}}</option>
     @endforeach
    </select></td>
    
    <td> <select class="form-control width"   name="ord_rea[]">
            <option>Select</option>
            <option>Reward</option>
            <option>Routine</option>
            <option>Displinary</option>
            <option>Other</option>
        </select></td>
    <td><textarea rows="3" cols="40" class="form-control width" name="reamrks[]"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" name="trans_file[]" style="width: 215px;"></td>
    <td></td>
    <td></td>
    <td><button type="button" class="deletebtn" title="Remove row" style="background-color: #7d98da">X</button></td>
    
    </tr>
    @endif
    </tbody>
    </table>
        </div>
         
    </div>
    </div>
    
    
    
    <div class="tab-pane fade <?php if($button==='PROMOTION'){echo 'show active';}?>" id="tab7" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    <div class="offset-lg-11 col-lg-1 new" id="add_newpromotion">ADD NEW</div>
    <div class="tableFixHead">
    <table class="table table-bordered table-hover" id="maintable_dependent_promo">
    <thead>
    <tr>
      <th>Sl No</th>
    <th>Promotion Order no <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Promotion Order Date:</th>
    <th>Promotion Effect Date:</th>
    <th>From grade</th>
    <th>From Designation/Position</th>
    <th>From Basic pay</th>
    <th>From special allowance</th>
    <th>From Other allowance</th>
    <th>To Grade:</th>
    <th>To Designation/Position </th>
    <th>To Basicpay:</th>
    <th>To Special allowance:</th>
    <th>To Other Allowance:</th>
    <th>Remark</th>
    <th>Upload Document:</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    
    </tr>
    </thead>
    <tbody id="promo_tbl">
         
     @php 
      $ctr_promo=0;
      $i=0;
      @endphp
      @foreach($EmployeePromotionInfo as $key=>$value) 
        @php
      $ctr_promo++;
    @endphp 
    <tr>
      <td>
        <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="promo_slno[]" value="{{$value->SL_NO}}" >
      </td>
      <td><input type="hidden" class="form-control" name="promotion_sql_id[]" value="{{$value->id}}">
    <input type="text" class="form-control width" name="promo_order_no[]" value="{{$value->promotion_order_no}}"></td>
    <td><input type="date" class="form-control" name="promo_date[]" value="{{$value->promotion_date}}"></td>
    <td><input type="date" class="form-control" placeholder="13/03/2008" name="effect_date[]" value="{{$value->promotion_effect_date}}"></td>
    <td><select class="form-control width" onchange="promotion({{$i}})"  id="promotionid{{$i}}"  name="from_grade[]">
    <option value="">--Select--</option>
    @foreach($pay_grade_view as $ky=>$val)
    <option value="{{$val->pay_grade_code}}"{{$val->pay_grade_code==$value->from_grade_code ? 'selected':''}}>{{$val->pay_grade_code}}
    </option>
    @endforeach
    
    <!--   @foreach($pay_grade_view as $ky=>$val)
    <option value="{{$val->pay_grade_code}}"{{$val->pay_grade_code==$EmployeeAllInfo->PAY_GRADE_CODE ? 'selected':''}}>{{$val->pay_grade_code}}
    </option>
    
     @endforeach -->
    
    </select></td>
    
    <td>
    <select class="form-control width"  name="from_design[]" >
    <option value="">--Select--</option>
    @foreach($Designation as $ky=>$val) 
  <option value="{{$val->id}}"{{$val->id==$value->from_desg_code? 'selected':''}}>{{$val->desg_name}}</option>
                                               @endforeach
    </select></td>
    <td>
    
    
      <input type="text" class="form-control width3" name="from_basic[]" value="{{$value->from_basic_pay}}" id='catch_paygrade_value{{$i}}' style="    width: 202px;color: black"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width" name="from_special[]" id="promtion_current_allowance{{$i}}" value="{{$value->special_allownace}}" style="    width: 202px;color: black"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width" name="from_other_special[]"  id="promtion_currentother_allowance{{$i}}" value="{{$value->other_special_allownace}}"  style="    width: 202px;color: black"></td>
    
    <td><select class="form-control width" onchange="topromotion({{$i}})" id="promotiontoid{{$i}}" name="to_grade[]">
    <option value="">--Select--</option>
    <!-- @foreach($pay_grade_view as $ky=>$val)
    <option value="{{$val->pay_grade_code}}"{{$val->pay_grade_code==$value->from_grade_code ? 'selected':''}}>{{$val->pay_grade_code}}
    </option>
    @endforeach -->
    @foreach($pay_grade_view as $ky=>$val)
    <option value="{{$val->pay_grade_code}}"{{$val->pay_grade_code==$value->to_grade_code ? 'selected':''}}>{{$val->pay_grade_code}}
    </option>
    @endforeach
    </select></td>
    <td>
    <select class="form-control width"   name="to_portion[]" onchange="portionDropdown({{$i}})"  id="portionDropdownid{{$i}}">
    <option value="">--Select--</option>
    @foreach($Designation as $ky=>$val)
    <option value="{{$val->id}}"{{$val->id==$value->to_portion
                                                            ? 'selected':''}}>{{$val->desg_name}}</option>
                                               @endforeach
    </select></td>
    <td><input type="text" class="form-control width" name="to_basic[]" value="{{$value->to_basic_pay}}" style="width: 202px; color: black" id='catch_topaygrade_value{{$i}}' ></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width" name="total_allow[]" value="{{$value->total_allowance}}" id="promtion_tocurrent_allowance{{$i}}"  style="width: 202px; color: black"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width" name="to_other_allowance[]" value="{{$value->other_allowance}}" id="promtion_tocurrentother_allowance{{$i}}" style="width: 202px; color: black"></td>
    <!-- <td><input type="text" class="form-control" name="to_oth_allow[]" ></td> -->
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remark[]">{{$value->remark}}</textarea></td>
    @if($value->upload!="")
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="upload_promo[]" style="width: 215px;"></td>
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/promotion/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/promotion/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
    </td>
    <td>
    
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/promotion/".$value->upload)) {?>
        <div class="row">
          <div class="col-md-4">
            <a href="{{ url('public/promotion/'.$value->upload) }}" download="{{ $value->upload }}">
              <i class="fa fa-download" style="font-size:22px;"></i>
            </a>
          </div>
          <div class="col-md-4">
            <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("promotion") }}&file={{ $value->upload }}&t={{ base64_encode("employee_promotion_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
              <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
            </a>
          </div>
          <div class="col-md-4">
            @php
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
            $explodeImage = explode('.', $value->upload);
            $extension = end($explodeImage);
          @endphp
          @if(in_array($extension, $imageExtensions))
          <img src="{{ url('public/promotion/'.$value->upload) }}" style="width:20px;height:20px;" >
            {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
          @elseif(strpos($extension, 'pdf') !== false)
            <i class="fa fa-file-pdf" style="font-size:22px;"></i>
          @elseif(strpos($extension, 'xlsx') !== false)
            <i class="fa fa-file-excel" style="font-size:22px;"></i>
          @elseif(strpos($extension, 'doc') !== false)
            <i class="fa fa-file-word" style="font-size:22px;"></i>
          @endif
          </div>
        </div>
       <?php } ?>
       <?php } ?>
    
    </td>
     @else
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="upload_promo[]" style="width: 215px;"></td> 
         <td></td>
         <td></td>          
    @endif
    
    <td><button type="button" onclick="deletepromotion({{$value->id}});" style="background-color: #7d98da">X</button></td>
    </tr>
    @php
    $i++;
    @endphp
    @endforeach
    @if($ctr_promo==0)
        <tr>
          <td>
            <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="promo_slno[]" >
          </td>
    
      <td>  
        <input type="hidden" class="form-control" name="promotion_sql_id[]">
    <input type="text" class="form-control width" name="promo_order_no[]"></td>
    <td><input type="date" class="form-control" name="promo_date[]"></td>
    <td><input type="date" class="form-control" placeholder="13/03/2008" name="effect_date[]"></td>
    <td>
    <select class="form-control "  name="from_grade[]" onchange="promotion({{$i}})"  id="promotionid{{$i}}"  style="width: 202px;">
       <option value="">--Select--</option>
       @foreach($pay_grade_view as $ky=>$val)
             <option value="{{$val->pay_grade_code}}">{{$val->pay_grade_code}}
            </option>
     @endforeach
    </select>
    </td>
    <td>
    <select class="form-control width"   name="from_design[]">
    <option value="">--Select--</option>
                                        @foreach($Designation as $ky=>$val)
                                                  <option value="{{$val->desg_code}}">{{$val->desg_name}}</option>
                                               @endforeach
    </select></td>
    
    <td><input type="text" class="form-control width" name="from_basic[]" id='catch_paygrade_value{{$i}}' style="    width: 202px;color: black" ></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width3" name="from_special[]" id="promtion_current_allowance{{$i}}"   style="    width: 202px;color: black"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width3" name="from_other_special[]"  id="promtion_currentother_allowance{{$i}}"  style="    width: 202px;color: black"></td>
    <td> <select class="form-control "  onchange="topromotion({{$i}})" id="promotiontoid{{$i}}" name="to_grade[]" style="width: 202px;">
       <option value="">--Select--</option>
       @foreach($pay_grade_view as $ky=>$val)
             <option value="{{$val->pay_grade_code}}">{{$val->pay_grade_code}}
            </option>
     @endforeach
    </select>
    </td>
    <td>
    <select class="form-control width"   name="to_portion[]" onchange="portionDropdown({{$i}})"  id="portionDropdownid{{$i}}">
    <option value="">--Select--</option>
                                        @foreach($Designation as $ky=>$val)
                                                  <option value="{{$val->desg_code}}">{{$val->desg_name}}</option>
                                               @endforeach
    </select></td>
    <td><input type="text" class="form-control width" name="to_basic[]" id='catch_topaygrade_value{{$i}}' ></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width3" name="total_allow[]" id="promtion_tocurrent_allowance{{$i}}"  ></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width3" name="to_other_allowance[]" id="promtion_tocurrentother_allowance{{$i}}"  ></td>
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remark[]"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" name="upload_promo[]" style="width: 215px;"></td>
    <td></td>
    <td></td>
    <td><button type="button" class="deletebtn" title="Remove row" style="background-color: #7d98da">X</button></td>
    
    </tr>
    @endif
    </tbody>
    </table>  
    </div>   
    </div>
    </div>  
    <div class="tab-pane fade <?php if($button==='PROBATION'){echo 'show active';}?>" id="tab8" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    
        <div class="offset-lg-11 col-lg-1 new"     id="add_newprobation" type="button">
    ADD NEW</div>
    
    <div class="tableFixHead">
    <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>Sl No</th>
    <th>Probation Order No: <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Probation Order Date:</th>
    <th>Probation Start Date:</th>
    <th>Probation End Date:</th>
    <th>Pay Grade:</th>
    <th>Initial Basic:</th>
    <th>Special Allowance:</th>
    <th>Other Allowance:</th>
    <th>Remarks:</th>
    <th>Upload Document:</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    </tr>
    </thead>
    <tbody id="probationtable">
       @php 
      $ctrprob=0;
        $i=0;
      @endphp
      @foreach($EmployeeProbationInfo as $key=>$value)
          @php
      $ctrprob++;
    @endphp  
    <tr>
      <td>
        <input type="number" class="form-control td2" value="{{$value->SL_NO}}" onkeypress="return isNumberKey(event)" name="prob_slno[]"  >
      </td> 
      <td>
        <input type="hidden" name="prob_sqli_id[]" value="{{$value->id}}">
    <input type="text" class="form-control width" name="prob_order[]" value="{{$value->prob_order_no}}"></td>
    <td><input type="date" class="form-control"  value="{{$value->prob_order_date}}" name="prob_order_date[]"></td>
    <td><input type="date" class="form-control"   name="prob_start[]"value="{{$value->prob_start_date}}"></td>
    <td><input type="date" class="form-control"    name="prob_end[]"value="{{$value->prob_end_date}}"></td>
    <td><select class="form-control "   id="probationid{{$i}}" name="pay_grade1[]" style="width: 202px;">
       <option value="">--Select--</option>
         <!-- @foreach($pay_grade_view as $ky=>$val)
    <option value="{{$val->id}}"{{$val->id==$value->pay_grade ? 'selected':''}}>{{$val->pay_grade_desc}}
    </option>
    @endforeach -->
    @foreach($pay_grade_view as $ky=>$val)
    <option value="{{$val->pay_grade_code}}"{{$val->pay_grade_code==$value->pay_grade ? 'selected':''}}>{{$val->pay_grade_code}}
    </option>
    @endforeach
    </select></td>
    <td><input type="number" class="form-control width2" name="initial[]"   value="{{$value->intial_basic}}" id="promotion_catch_topaygrade_value{{$i}}" style="width: 219px;"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="special_allowance[]"value="{{$value->special_allowance}}" id="probation_current_allowance{{$i}}" ></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="other_allownace[]"value="{{$value->other_allowance}}" id="probation_tocurrentother_allowance{{$i}}" ></td>
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remark_prob[]">{{$value->remarks}}</textarea></td>
    
    @if($value->upload!="")
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="prob_upload[]" style="width: 215px;"></td>
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/probation/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/probation/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
    </td>
    <td>
    
      <?php if($value->upload!==""){
      if(file_exists(public_path()."/probation/".$value->upload)) {?>
      <div class="row">
        <div class="col-md-4">
          <a href="{{ url('public/probation/'.$value->upload) }}" download="{{ $value->upload }}">
            <i class="fa fa-download" style="font-size:22px;"></i>
          </a>
        </div>
        <div class="col-md-4">
          <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("probation") }}&file={{ $value->upload }}&t={{ base64_encode("emp_probation_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
            <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
          </a>
        </div>
        <div class="col-md-4">
          @php
          $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
          $explodeImage = explode('.', $value->upload);
          $extension = end($explodeImage);
        @endphp
        @if(in_array($extension, $imageExtensions))
        <img src="{{ url('public/probation/'.$value->upload) }}" style="width:20px;height:20px;" >
          {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
        @elseif(strpos($extension, 'pdf') !== false)
          <i class="fa fa-file-pdf" style="font-size:22px;"></i>
        @elseif(strpos($extension, 'xlsx') !== false)
          <i class="fa fa-file-excel" style="font-size:22px;"></i>
        @elseif(strpos($extension, 'doc') !== false)
          <i class="fa fa-file-word" style="font-size:22px;"></i>
        @endif
        </div>
      </div>
     <?php } ?>
     <?php } ?>
    
    
    </td>
     @else
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="prob_upload[]" style="width: 215px;"></td> 
         <td></td>   
         <td></td>             
    @endif
    
    <td><button type="button" onclick="deleteprobation({{$value->id}});" style="background-color: #7d98da">X</button></td>
    </tr>
    @php
    $i++;
    @endphp
    @endforeach
    @if($ctrprob==0)
        <tr>
          <td>
            <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="prob_slno[]"  >
          </td>    
    <td>    
      <input type="hidden" name="prob_sqli_id[]">
    
    <input type="text" class="form-control width" name="prob_order[]"></td>
    <td><input type="date" class="form-control"  name="prob_order_date[]"></td>
    <td><input type="date" class="form-control"   name="prob_start[]"></td>
    <td><input type="date" class="form-control"    name="prob_end[]"></td>
    <td>
      {{-- onchange="probation({{$i}})"  --}}
    <select class="form-control "  id="probationid{{$i}}" name="pay_grade1[]" style="width: 202px;">
       <option value="">--Select--</option>
       @foreach($pay_grade_view as $ky=>$val)
             <option value="{{$val->pay_grade_code}}">{{$val->pay_grade_code}}
            </option>
     @endforeach
    </select></td>
    <td><input type="number" class="form-control width2" name="initial[]" id="promotion_catch_topaygrade_value{{$i}}" style="width: 220px;"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="special_allowance[]"id="probation_current_allowance{{$i}}" ></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="other_allownace[]"id="probation_tocurrentother_allowance{{$i}}" ></td>
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remark_prob[]"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" name="prob_upload[]" style="width: 215px;"></td>
    <td></td>
    <td></td>
    <td><button type="button" class="deletebtn" title="Remove row" style="background-color: #7d98da"> X</button></td>
    
    </tr>
    @endif
    </tbody>
    </table>   
    </div>  
    </div>
    </div>  
    
    <div class="tab-pane fade <?php if($button==='CONTRACT'){echo 'show active';}?>" id="tab9" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    
        <div class="offset-lg-11 col-lg-1 new" id="add_new_contract">ADD NEW</div>
        <div class="tableFixHead">
    <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>Sl No</th>
    <th>Contract Order No. <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Contract Order Date:</th>
    <th>Contract Start Date:</th>
    <th>Contract End Date:</th>
    <th>Consolidated Pay</th>
    <th>Special Allowance</th>
    <th>Other Allowance</th>
    <th>Remarks:</th>
    <th>Upload Document:</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    </tr>
    </thead>
    <tbody id="tbody_contract">
    <tr>
          @php 
      $ctr_cont=0;
      @endphp
    @foreach($EmployeeContractInfo as $key=>$value)
         @php
      $ctr_cont++;
    @endphp  
    <td>
      <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="cont_slno[]" value="{{$value->Sl_NO}}" >
    </td>  
    <td>
      <input type="hidden"  name="contract_sqli_id[]" value="{{$value->id}}" >
    <input type="text" class="form-control width" name="cont_order[]" value="{{$value->cont_order_no}}"></td>
    <td><input type="date" class="form-control" value="{{$value->cont_order_date}}"  name="cont_order_date[]"></td>
    <td><input type="date" class="form-control"   name="cont_start_date[]" value="{{$value->cont_start_date}}"></td>
    <td><input type="date" class="form-control"  name="cont_end_date[]"value="{{$value->cont_end_date}}"></td>
    
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="con_pay[]"value="{{$value->sal}}"></td>
    
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="special[]"value="{{$value->special_allowance}}"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="other[]"value="{{$value->other_allowance}}"></td>
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remarks[]">{{$value->remarks}}</textarea></td>
    
    @if($value->upload!="")
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="cont_file[]" style="width: 215px;"></td>
    
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/contract/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/contract/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
    </td>
    
      <td>
    
        <?php if($value->upload!==""){
          if(file_exists(public_path()."/contract/".$value->upload)) {?>
          <div class="row">
            <div class="col-md-4">
              <a href="{{ url('public/contract/'.$value->upload) }}" download="{{ $value->upload }}">
                <i class="fa fa-download" style="font-size:22px;"></i>
              </a>
            </div>
            <div class="col-md-4">
              <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("contract") }}&file={{ $value->upload }}&t={{ base64_encode("emp_contract_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
                <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
              </a>
            </div>
            <div class="col-md-4">
              @php
              $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
              $explodeImage = explode('.', $value->upload);
              $extension = end($explodeImage);
            @endphp
            @if(in_array($extension, $imageExtensions))
            <img src="{{ url('public/contract/'.$value->upload) }}" style="width:20px;height:20px;" >
              {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
            @elseif(strpos($extension, 'pdf') !== false)
              <i class="fa fa-file-pdf" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'xlsx') !== false)
              <i class="fa fa-file-excel" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'doc') !== false)
              <i class="fa fa-file-word" style="font-size:22px;"></i>
            @endif
            </div>
          </div>
         <?php } ?>
         <?php } ?>
    
      </td>
    
    
     @else
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="cont_file[]" style="width: 215px;"></td>
         <td></td>
         <td></td>        
    @endif
    
    <td><button type="button" onclick="deletecontract({{$value->id}});" 
    style="background-color: #7d98da">X</button></td>
    </tr>
    @endforeach
    @if($ctr_cont==0)
    <tr>
      <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="cont_slno[]"  >
      </td>
    <td>
      <input type="hidden"  name="contract_sqli_id[]">
    <input type="text" class="form-control width" name="cont_order[]"></td>
    <td><input type="date" class="form-control" name="cont_order_date[]"></td>
    <td><input type="date" class="form-control"   name="cont_start_date[]"></td>
    <td><input type="date" class="form-control"   name="cont_end_date[]"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="con_pay[]"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="special[]"></td>
    <td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="other[]"></td>
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remarks[]"></textarea></td>
    
    <td><input type="file" accept="image/png, image/gif, image/jpeg" name="cont_file[]" style="width: 215px;"></td>
    <td></td>
    <td></td>
    <td><button type="button" class="deletebtn" title="Remove row" 
    style="background-color: #7d98da">X</button></td>
    
    </tr>
    @endif
    </tbody>
    </table> 
        </div>    
    </div>
    </div>  
    
    
    
    
    
    
    <div class="tab-pane fade <?php if($button==='ANTECEDENT'){echo 'show active';}?>" id="tab10" role="tabpanel" aria-labelledby="border-contact-tab" >
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    
        <div class="offset-lg-11 col-lg-1 new" id="addBtn">ADD NEW</div>
    
        <div class="tableFixHead">   
    <table class="table table-bordered table-hover"  id="maintable_dependent_ante" width="50%" cellpadding="0" cellspacing="0" class="pdzn_tbl1" border="#729111 1px solid" >
    <thead>
    <tr>
      <th>Sl No</th>
    <th>Order No: <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Order Date:</th>
    <th>Type:</th>
    <th>W.E.E Date:</th>
    <th>W.E.T Date:</th>
    <th>Remarks</th>
    <th>Uploads</th>
    <th>Preview</th>
    <th>Download</th>
    <th>remove</th>
    
    
    </tr>
    </thead>
    
    <tbody id="tbody">
    <tr>
     @php 
      $ctr_ante=0;
      @endphp
     @foreach($EmployeeAntecedentInfo as $key=>$value) 
          @php
      $ctr_ante++;
    @endphp 
    </head>
     <body>
    
      </div>
    </body>
      
    </html>
    <td>
      <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="antecedent_slno[]" value="{{$value->slno}}" >
    </td>
    <td>
      <input type="hidden" class="form-control" name="antecedent_sql_id[]"  value="{{$value->id}}">
    <input type="text" class="form-control width" name="ante_order_no[]" value="{{$value->order_no}}"></td>
    <td><input type="date" class="form-control" name="ante_order_date[]"
      value="{{$value->order_date}}"></td>
    <td>   <select class="form-control  width" name="ante_type[]">
    
         <option <?php if($value->type == 'Explanation'){ echo "selected"; } else { echo ""; } ?> value="Explanation">Explanation</option>
     <option <?php if($value->type == 'Termination'){ echo "selected"; } else { echo ""; } ?> value="Termination">Termination</option>
      <option <?php if($value->type == 'Warning'){ echo "selected"; } else { echo ""; } ?> value="Warning">Warning</option>
     <option <?php if($value->type == 'Salary Deduction'){ echo "selected"; } else { echo ""; } ?> value="Salary Deduction">Salary Deduction</option>
      <option <?php if($value->type == 'Demotion'){ echo "selected"; } else { echo ""; } ?> value="Demotion">Demotion</option>
     <option <?php if($value->type == 'Charge Sheet'){ echo "selected"; } else { echo ""; } ?> value="Charge Sheet">Charge Sheet</option>
      <option <?php if($value->type == 'Suspension'){ echo "selected"; } else { echo ""; } ?> value="Suspension">Suspension</option>
     <option <?php if($value->type == 'Others'){ echo "selected"; } else { echo ""; } ?> value="Others">Others</option>
            
        </select></td>
    <td><input type="date" class="form-control"   name="ante_w_e_e[]" value="{{$value->WEE_date}}"></td>
    <td><input type="date" class="form-control"   name="ante_w_e_t[]" value="{{$value->WET_date}}"></td>
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="ante_remarks[]">{{$value->remarks}}</textarea> </td>
    
    @if($value->upload!="")
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="antecedent_upload[]" style="width: 215px;"></td>
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/antecedent/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/antecedent/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>  
      <?php }} ?>
    </td>
      <td>
    
        <?php if($value->upload!==""){
          if(file_exists(public_path()."/antecedent/".$value->upload)) {?>
          <div class="row">
            <div class="col-md-4">
              <a href="{{ url('public/antecedent/'.$value->upload) }}" download="{{ $value->upload }}">
                <i class="fa fa-download" style="font-size:22px;"></i>
              </a>
            </div>
            <div class="col-md-4">
              <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("antecedent") }}&file={{ $value->upload }}&t={{ base64_encode("emp_antecedent_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
                <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
              </a>
            </div>
            <div class="col-md-4">
              @php
              $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
              $explodeImage = explode('.', $value->upload);
              $extension = end($explodeImage);
            @endphp
            @if(in_array($extension, $imageExtensions))
            <img src="{{ url('public/antecedent/'.$value->upload) }}" style="width:20px;height:20px;" >
              {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
            @elseif(strpos($extension, 'pdf') !== false)
              <i class="fa fa-file-pdf" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'xlsx') !== false)
              <i class="fa fa-file-excel" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'doc') !== false)
              <i class="fa fa-file-word" style="font-size:22px;"></i>
            @endif
            </div>
          </div>
         <?php } ?>
         <?php } ?>
    
      </td>
    
    
     @else
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="antecedent_upload[]" style="width: 215px;"></td>
         <td></td>     
         <td></td>        
    @endif
    <td><button type="button" onclick="deleteantecedent({{$value->id}});"  
    style="background-color: #7d98da">X</button></td>
    
    </tr>
    @endforeach
    @if($ctr_ante==0)
    <tr>
      <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="antecedent_slno[]"  >
      </td>  
      <td>
        <input type="hidden" class="form-control" name="antecedent_sql_id[]" >
       <input type="text" class="form-control width" name="ante_order_no[]"></td>
    <td><input type="date" class="form-control"   name="ante_order_date[]"></td>
    <td>   <select class="form-control  width" name="ante_type[]">
            <option>Explanation</option>
            <option>Termination</option>
            <option>Warning</option>
            <option>Salary Deduction</option>
            <option>Demotion</option>
            <option>Charge Sheet</option>
            <option>Suspension</option>
            <option>Others</option>
        </select></td>
    <td><input type="date" class="form-control"   name="ante_w_e_e[]"></td>
    <td><input type="date" class="form-control"   name="ante_w_e_t[]"></td>
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="ante_remarks[]"></textarea></td>
    
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="antecedent_upload[]" style="width: 215px;"></td>
    <td></td>
    <td></td>
    <td><button type="button" class="deletebtn" title="Remove row" 
    style="background-color: #7d98da">X</button></td>
    
    </tr>
    @endif
    <br>
    
    
    </tbody>
    </table>   
    </div>  
    </div>
    </div>  
    
    
    <div class="tab-pane fade <?php if($button==='REVOCATION'){echo 'show active';}?>" id="tab11" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
     
        <div class="offset-lg-11 col-lg-1 new" id="add_new_revocation">ADD NEW</div>
    
        <div class="tableFixHead">  
    <table class="table table-bordered table-hover" >
    <thead>
    <tr>
      <th>Sl No</th>
    <th>Revocation Order No: <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Revocation Order Date:</th>
    <th>Antecedent Order no:</th>
    <th>Antecedent Order Date:</th>
    <th>Antecedent Type:</th>
    <th>Antecedent W.E.F date:</th>
    <th>Antecedent W.E.T Date:</th>
    <th>Revocation Effected date:</th>
    <th>Remarks:</th>
    <th>Upload</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    
    </tr>
    </thead>
    <tbody id="maintable_dependent_revocation">
    <tr>
              @php 
      $ctr_revo=0;
      @endphp
       @foreach($EmployeeRevocationInfo as $key=>$value) 
             @php
      $ctr_revo++;
    @endphp 
    <td>
      <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="revo_slno[]" value="{{$value->slno}}" >
    </td>
    <td>
      <input type="hidden" class="form-control" name="revocation_sql_id[]"  value="{{$value->id}}">
    <input type="text" class="form-control width" name="revo_order_no[]" value="{{$value->revocation_order_no}}"></td>
    <td><input type="date" class="form-control width" value="{{$value->revocation_order_date}}" name="revo_order_date[]"></td>
    <td><select class="form-control width" name="ant_ord_no[]"value="{{$value->antecedent_order_no}}" >
       @foreach($antecendent_fetch as $ky=>$val)
                      <option value="{{$val->id}}"
                         {{$val->id==$value->antecedent_order_no
                              ? 'selected':''}}>{{$val->order_no}}
                      </option>      
                
                 @endforeach
    
    </select></td>
    <td><select class="form-control width" name="ant_ord_dat[]"value="{{$value->antecedent_order_date}}">
            @foreach($antecendent_fetch as $ky=>$val)
                @if(!$val->order_date=="")
                      <option value="{{$val->order_date}}"
                         {{$val->order_date==$value->antecedent_order_date
                              ? 'selected':''}}>{{$val->order_date}}
                      </option>      
                @endif
                 @endforeach
    </select></td>
    <td><select class="form-control width" name="ant_ord_type[]"value="{{$value->antecedent_type}}">
         <option <?php if($value->antecedent_type == 'Explanation'){ echo "selected"; } else { echo ""; } ?> value="Explanation">Explanation</option>
     <option <?php if($value->antecedent_type == 'Termination'){ echo "selected"; } else { echo ""; } ?> value="Termination">Termination</option>
      <option <?php if($value->antecedent_type == 'Warning'){ echo "selected"; } else { echo ""; } ?> value="Warning">Warning</option>
     <option <?php if($value->antecedent_type == 'Salary Deduction'){ echo "selected"; } else { echo ""; } ?> value="Salary Deduction">Salary Deduction</option>
      <option <?php if($value->antecedent_type == 'Demotion'){ echo "selected"; } else { echo ""; } ?> value="Demotion">Demotion</option>
     <option <?php if($value->antecedent_type == 'Charge Sheet'){ echo "selected"; } else { echo ""; } ?> value="Charge Sheet">Charge Sheet</option>
      <option <?php if($value->antecedent_type == 'Suspension'){ echo "selected"; } else { echo ""; } ?> value="Suspension">Suspension</option>
     <option <?php if($value->antecedent_type == 'Others'){ echo "selected"; } else { echo ""; } ?> value="Others">Others</option>
    </select></td>
    <td><select class="form-control width" name="ant_WEF[]"value="{{$value->antecedent_WEE_date}}">
          @foreach($antecendent_fetch as $ky=>$val)
          @if(!$val->WEE_date=="")
            <option value="{{$val->WEE_date}}">{{ date('d/m/Y', strtotime($val->WEE_date)) }}</option>
          @endif
          @endforeach
    </select></td>
    <td><select class="form-control width" name="ant_WET[]"value="{{$value->antecedent_WET_date}}">
          @foreach($antecendent_fetch as $ky=>$val)
          @if(!$val->WET_date=="")
            <option value="{{$val->WET_date}}">{{ date('d/m/Y', strtotime($val->WET_date)) }}</option>
            @endif
            
          @endforeach
    </select></td>
    <td><input type="date" class="form-control" name="revo_effected_date[]"value="{{$value->revocation_effected_date}}" ></td>
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="revo_remark[]">{{$value->remarks}}</textarea></td>
    
    @if($value->upload!="")
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="revocation_upload[]" style="width: 215px;"></td>
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/revocation/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/revocation/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
    </td>
      <td>
    
       <?php if($value->upload!==""){
      if(file_exists(public_path()."/revocation/".$value->upload)) {?>
      <div class="row">
        <div class="col-md-4">
          <a href="{{ url('public/revocation/'.$value->upload) }}" download="{{ $value->upload }}">
            <i class="fa fa-download" style="font-size:22px;"></i>
          </a>
        </div>
        <div class="col-md-4">
          <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("revocation") }}&file={{ $value->upload }}&t={{ base64_encode("emp_revocation_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
            <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
          </a>
        </div>
        <div class="col-md-4">
          @php
          $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
          $explodeImage = explode('.', $value->upload);
          $extension = end($explodeImage);
        @endphp
        @if(in_array($extension, $imageExtensions))
        <img src="{{ url('public/revocation/'.$value->upload) }}" style="width:20px;height:20px;" >
          {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
        @elseif(strpos($extension, 'pdf') !== false)
          <i class="fa fa-file-pdf" style="font-size:22px;"></i>
        @elseif(strpos($extension, 'xlsx') !== false)
          <i class="fa fa-file-excel" style="font-size:22px;"></i>
        @elseif(strpos($extension, 'doc') !== false)
          <i class="fa fa-file-word" style="font-size:22px;"></i>
        @endif
        </div>
      </div>
     <?php } ?>
     <?php } ?>
      
    </td>
    @else
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="revocation_upload[]" style="width: 215px;"></td>
         <td></td>     
         <td></td>        
    @endif
    <td><button type="button" onclick="deleterevocation({{$value->id}});" 
    style="background-color: #7d98da">X</button></td>
    </tr>
    @endforeach
    @if($ctr_revo==0)
    <tr>
      <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="revo_slno[]"  >
      </td>
    <td>
      <input type="hidden" class="form-control" name="revocation_sql_id[]">
    
    <input type="text" class="form-control width" name="revo_order_no[]"></td>
    <td><input type="date" class="form-control width"   name="revo_order_date[]"></td>
    <td><select class="form-control width" name="ant_ord_no[]">
      <option value="">--select--</option>
          @foreach($antecendent_fetch as $ky=>$val)
            <option value="{{$val->order_no}}">{{$val->order_no}}</option>
          @endforeach
    </select></td>
    <td><select class="form-control width" name="ant_ord_dat[]">
      <option value="">--select--</option>
          @foreach($antecendent_fetch as $ky=>$val)
          @if(!$val->order_date=="")
            <option value="{{$val->order_date}}">{{$val->order_date}}</option>
          @endif
    
          @endforeach
    </select></td>
    <td><select class="form-control width" name="ant_ord_type[]">
      <option value="">--select--</option>
       <option>Explanation</option>
            <option>Termination</option>
            <option>Warning</option>
            <option>Salary Deduction</option>
            <option>Demotion</option>
            <option>Charge Sheet</option>
            <option>Suspension</option>
            <option>Others</option>
        </select>
    </select></td>
    <td><select class="form-control width" name="ant_WEF[]">
      <option value="">--select--</option>
          @foreach($antecendent_fetch as $ky=>$val)
          @if(!$val->WEE_date=="")
            <option value="{{$val->WEE_date}}">{{$val->WEE_date}}</option>
            @endif
          @endforeach
    </select></td>
    <td><select class="form-control width" name="ant_WET[]">
      <option value="">--select--</option>
          @foreach($antecendent_fetch as $ky=>$val)
          @if(!$val->WET_date=="")
            <option value="{{$val->WET_date}}">{{$val->WET_date}}</option>
            @endif
          @endforeach
    </select></td>
    <td><input type="date" class="form-control" name="revo_effected_date[]" ></td>
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="revo_remark[]"></textarea></td>
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="revocation_upload[]" style="width: 215px;"></td>
         <td></td>
         <td></td>     
    <td><button type="button" class="deletebtn" title="Remove row" 
    style="background-color: #7d98da">X</button></td>
    </tr>
    
    
    @endif
    
    </tbody>
    </table>  
        </div>   
    </div>
    </div>  
    <div class="tab-pane fade <?php if($button==='APPRECIATION'){echo 'show active';}?>" id="tab12" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    <div class="offset-lg-11 col-lg-1 new" id="add_new_appreciation">ADD NEW</div>
    <div class="tableFixHead">
    <table class="table table-bordered table-hover"  id="table_appreciation">
    <thead>
    <tr>
      <th>Sl No</th>
    <th>Order No: <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Order Date:</th>
    <th>Appriciation Type:</th>
    <th>Recommended By</th>
    <th>Description</th>
    <th>Remarks</th>
    <th>Upload</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    
    
    </tr>
    </thead>
    <tbody>
    <tr>
    @php 
      $ctr_revo=0;
      @endphp
       @foreach($EmployeeAppreciationInfo as $key=>$value) 
             @php
      $ctr_revo++;
    @endphp 
    <td>
      <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="app_slno[]" value="{{$value->slno}}" >
    </td>
    <td>
      <input type="hidden" class="form-control" name="appr_sqli_id[]" value="{{$value->id}}">
    <input type="text" class="form-control width" name="app_order_no[]" value="{{$value->order_no}}"></td>
    <td><input type="date" class="form-control width"  name="app_order_date[]" value="{{$value->order_date}}"></td>
    <td><select class="form-control width" name="appreciation_type[]">
    <option>--select--</option>
        <option <?php if($value->appreciation_type == 'Cost-saving'){ echo "selected"; } else { echo ""; } ?> value="Cost-saving">Cost Saving</option>
        <option <?php if($value->appreciation_type == 'Process_Improvemnt'){ echo "selected"; } else { echo ""; } ?> value="Process_Improvemnt">Process Improvemnt</option>
     
    </select></td>
    <td><input type="text" class="form-control width" name="recommended_by[]" value="{{$value->recommended_by}}"></td>
    <td><textarea rows="3" cols="40" class="form-control" name="app_description[]" style="width:200px;">{{$value->app_description}}</textarea></td>
    
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150"name="app_remarks[]">{{$value->app_remarks}}</textarea></td>
    @if($value->upload!="")
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="appriciation_upload[]" style="width: 215px;"></td>
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/appreciation/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/appreciation/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
    </td>
      <td>
    
        <?php if($value->upload!==""){
          if(file_exists(public_path()."/appreciation/".$value->upload)) {?>
          <div class="row">
            <div class="col-md-4">
              <a href="{{ url('public/appreciation/'.$value->upload) }}" download="{{ $value->upload }}">
                <i class="fa fa-download" style="font-size:22px;"></i>
              </a>
            </div>
            <div class="col-md-4">
              <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("appreciation") }}&file={{ $value->upload }}&t={{ base64_encode("emp_appreciation") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
                <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
              </a>
            </div>
            <div class="col-md-4">
              @php
              $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
              $explodeImage = explode('.', $value->upload);
              $extension = end($explodeImage);
            @endphp
            @if(in_array($extension, $imageExtensions))
            <img src="{{ url('public/appreciation/'.$value->upload) }}" style="width:20px;height:20px;" >
              {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
            @elseif(strpos($extension, 'pdf') !== false)
              <i class="fa fa-file-pdf" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'xlsx') !== false)
              <i class="fa fa-file-excel" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'doc') !== false)
              <i class="fa fa-file-word" style="font-size:22px;"></i>
            @endif
            </div>
          </div>
         <?php } ?>
         <?php } ?>
    
      </td>
    @else
         <td><input type="file" accept="image/png, image/gif, image/jpeg"  placeholder="67%" name="appriciation_upload[]" style="width: 215px;"></td>
         <td></td>        
         <td></td>        
    @endif
    <td><button type="button" onclick="deleteAppreciation({{$value->id}});" 
    style="background-color: #7d98da">X</button></td>
    </tr>
    @endforeach
    @if($ctr_revo==0)
    <tr id="R">
      <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="app_slno[]" >
      </td>
     <td> 
       <input type="hidden" class="form-control" name="appr_sqli_id[]">
    <input type="text" class="form-control width" name="app_order_no[]"></td>
    <td><input type="date" class="form-control width"  name="app_order_date[]"></td>
    <td><select class="form-control width" name="appreciation_type[]">
        <option>--select--</option>
        <option value="Cost-saving">Cost Saving</option>
        <option value="Process_Improvemnt">Process Improvemnt</option>
     
    </select></td>
    <td><input type="text" class="form-control width" name="recommended_by[]"></td>
    <td><textarea rows="3" cols="40" class="form-control"  name="app_description[]" style="width:200px;"></textarea></td>
    
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="app_remarks[]"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" name="appriciation_upload[]" style="width: 215px;"></td>
    <td></td>
    <td></td>
    <td><button type="button" class="deletebtn" 
      style="background-color: #7d98da">X</button></td>
    </tr>
    
    @endif
    
    
       </tbody>
     </table>   
    </div>  
    </div>
    </div> 
    
    <div class="tab-pane fade <?php if($button==='REWARD'){echo 'show active';}?>" id="tab13" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    <div class="offset-lg-11 col-lg-1 new" id="add_new_reward">ADD NEW</div>
    
    <div class="tableFixHead">
    <table class="table table-bordered table-hover" id="tablereward">
    <thead>
    <tr>
      <th>Sl No</th>
    <th>Order No: <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Order Date:</th>
    <th>Reward Type:</th>
    <th>Recommended By</th>
    <th>Description</th>
    <th>Remarks</th>
    <th>Upload</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    
    </tr>
    </thead>
     <tbody id="table_reward">
    
    <tr>
    @php 
      $ctr_revo=0;
      @endphp
       @foreach($EmployeeRewardInfo as $key=>$value) 
             @php
      $ctr_revo++;
    @endphp 
    <td>
      <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="reward_slno[]" value="{{$value->slno}}" >
    </td>
    <td>
      <input type="hidden" class="form-control" name="reward_sqli_id[]" value="{{$value->id}}">
    <input type="text" class="form-control width" name="reorder_no[]" value="{{$value->reorder_no}}"></td>
    <td><input type="date" class="form-control width"  name="reorder_date[]"  value="{{$value->reorder_date}}"></td>
    <td><select class="form-control width" name="reward_type[]">
         <option>--select--</option>
        <option <?php if($value->reward_type == 'Cost-saving'){ echo "selected"; } else { echo ""; } ?>  value="Cost-saving">Cost Saving</option>
        <option <?php if($value->reward_type == 'Process_Improvemnt'){ echo "selected"; } else { echo ""; } ?> value="Process_Improvemnt">Process Improvemnt</option>
     
    </select></td>
    <td><input type="text" class="form-control width" name="re_recommended_by[]" value="{{$value->re_recommended_by}}"></td>
    <td><textarea rows="3" cols="40" class="form-control"  name="re_description[]" style="width:200px;">{{$value->re_description}}</textarea></td>
    
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="re_remarks[]">{{$value->re_remarks}}</textarea></td>
    
    @if($value->upload!="")
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="remark_upload[]" style="width: 215px;"></td>
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/reward/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/reward/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
      
    </td>
      <td>
    
        <?php if($value->upload!==""){
          if(file_exists(public_path()."/reward/".$value->upload)) {?>
          <div class="row">
            <div class="col-md-4">
              <a href="{{ url('public/reward/'.$value->upload) }}" download="{{ $value->upload }}">
                <i class="fa fa-download" style="font-size:22px;"></i>
              </a>
            </div>
            <div class="col-md-4">
              <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("reward") }}&file={{ $value->upload }}&t={{ base64_encode("emp_reward") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
                <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
              </a>
            </div>
            <div class="col-md-4">
              @php
              $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
              $explodeImage = explode('.', $value->upload);
              $extension = end($explodeImage);
            @endphp
            @if(in_array($extension, $imageExtensions))
            <img src="{{ url('public/reward/'.$value->upload) }}" style="width:20px;height:20px;" >
              {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
            @elseif(strpos($extension, 'pdf') !== false)
              <i class="fa fa-file-pdf" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'xlsx') !== false)
              <i class="fa fa-file-excel" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'doc') !== false)
              <i class="fa fa-file-word" style="font-size:22px;"></i>
            @endif
            </div>
          </div>
         <?php } ?>
         <?php } ?>
    
      </td>
    @else
         <td><input type="file" accept="image/png, image/gif, image/jpeg"  placeholder="67%" name="remark_upload[]" style="width: 215px;"></td>
         <td></td>  
         <td></td>        
    @endif
    
    <td><button type="button" onclick="deleteReward({{$value->id}});" 
    style="background-color: #7d98da">X</button></td>
    </tr>
    @endforeach
    @if($ctr_revo==0)
    
    <tr>
      <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="reward_slno[]" >
      </td>
    <td>
      <input type="hidden" class="form-control" name="reward_sqli_id[]" >
    <input type="text" class="form-control width" name="reorder_no[]"></td>
    <td><input type="date" class="form-control width"  name="reorder_date[]"></td>
    <td><select class="form-control width" name="reward_type[]">
         <option>--select--</option>
        <option value="Cost-saving">Cost Saving</option>
        <option value="Process_Improvemnt">Process Improvemnt</option>
     
    </select></td>
    <td><input type="text" class="form-control width" name="re_recommended_by[]"></td>
    <td><textarea rows="3" cols="40" class="form-control"  name="re_description[]" style="width:200px;"></textarea></td>
    
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="re_remarks[]"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" name="remark_upload[]"></td>
    <td></td>
    <td></td>  
    <td><button type="button" style="background-color: #7d98da">X</button></td>
    </tr>
    @endif
    
    
       </tbody>
     </table> 
    </div>    
    </div>
    </div> 
    
    <div class="tab-pane fade <?php if($button==='INITIATION'){echo 'show active';}?>" id="tab14" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    
    <div class="offset-lg-11 col-lg-1 new" id="add_new7">ADD NEW</div>
    
    <div class="tableFixHead">
    <table class="table table-bordered table-hover" id="tableintiation">
    <thead>
    <tr>
    
      <th>Sl No</th>
    <th>Initiative Date <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Type</th>
    <th>Description</th>
    <th>Remarks</th>
    <th>Upload</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    
    
    </tr>
    </thead>
    <tbody>
    
    
    <tr>
    @php 
    $ctr_inti=0;
    @endphp
       @foreach($EmployeeIntitionInfo as $key=>$value) 
    @php
    $ctr_inti++;
    @endphp 
    <td>
      <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="intiation_slno[]" value="{{$value->slno}}" >
    </td>
    <td>
      <input type="hidden" class="form-control" name="intiation_sql_id[]"  value="{{$value->id}}">
    <input type="date" class="form-control width" name="initiative_date[]" value="{{$value->initiative_date}}"></td>
    
    <td><select class="form-control width" name="inti_type[]" value="{{$value->type}}">
    <option>--select--</option>
    <option <?php if($value->type == 'Cost Saving'){ echo "selected"; } else { echo ""; } ?> value="Cost Saving">Cost Saving</option>
    <option <?php if($value->type == 'Process Improvemnt'){ echo "selected"; } else { echo ""; } ?> value="Process Improvemnt">Process Improvemnt</option>
      </select>
    </td>
    
    <td><textarea rows="3" cols="40" class="form-control"  name="inti_description[]" style="width:200px;">{{$value->description}}</textarea></td>
    
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="inti_remark[]">{{$value->remark}}</textarea></td>
    
    @if($value->upload!="")
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="Initiative_upload[]" style="width: 215px;"></td>
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/Initiative/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/Initiative/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
    </td>
      <td>
    
        <?php if($value->upload!==""){
          if(file_exists(public_path()."/Initiative/".$value->upload)) {?>
          <div class="row">
            <div class="col-md-4">
              <a href="{{ url('public/Initiative/'.$value->upload) }}" download="{{ $value->upload }}">
                <i class="fa fa-download" style="font-size:22px;"></i>
              </a>
            </div>
            <div class="col-md-4">
              <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("Initiative") }}&file={{ $value->upload }}&t={{ base64_encode("emp_initiation_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
                <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
              </a>
            </div>
            <div class="col-md-4">
              @php
              $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
              $explodeImage = explode('.', $value->upload);
              $extension = end($explodeImage);
            @endphp
            @if(in_array($extension, $imageExtensions))
            <img src="{{ url('public/Initiative/'.$value->upload) }}" style="width:20px;height:20px;" >
              {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
            @elseif(strpos($extension, 'pdf') !== false)
              <i class="fa fa-file-pdf" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'xlsx') !== false)
              <i class="fa fa-file-excel" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'doc') !== false)
              <i class="fa fa-file-word" style="font-size:22px;"></i>
            @endif
            </div>
          </div>
         <?php } ?>
         <?php } ?>
    
    
      </td>
    @else
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="Initiative_upload[]" style="width: 215px;"></td>
         <td></td>        
         <td></td>        
    @endif
    <td><button type="button" onclick="deleteintiation({{$value->id}});" 
    style="background-color: #7d98da">X</button></td>
    </tr>
    @endforeach
    @if($ctr_inti==0)
    <tr>
      <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="intiation_slno[]"  >
      </td>
    <td>
      <input type="hidden" class="form-control" name="intiation_sql_id[]">
    
    <input type="date" class="form-control width"   name="initiative_date[]"></td>
    <td><select class="form-control width" name="inti_type[]">
        <option>--select--</option>
        <option>Cost Saving</option>
        <option>Process Improvemnt</option>
     
    </select></td>
    
    <td><textarea rows="3" cols="40" class="form-control"  name="inti_description[]" style="width:200px;"></textarea></td>
    
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="inti_remark[]"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" name="Initiative_upload[]" style="width: 215px;"></td>
    <td></td>
    <td></td>        
    <td><button type="button" class="deletebtn" title="Remove row" 
    style="background-color: #7d98da">X</button></td>
    </tr>
    @endif
    
    
    </tbody>
     </table>  
    </div>
     
    </div>
    </div>
    
    <div class="tab-pane fade <?php if($button==='ACHIEVEMENT'){echo 'show active';}?>" id="tab15" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    <div class="offset-lg-11 col-lg-1 new" id="add_new8">ADD NEW</div>
    
    <div class="tableFixHead">
    <table class="table table-bordered table-hover" id="tableachievemnt">
    <thead>
    <tr>
    
      <th>Sl No</th>
    <th>Achievement Date <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Achievement Type</th>
    <th>Achivement Period</th>
    <th>Remarks</th>
    <th>Upload</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Remove</th>
    
    </tr>
    </thead>
    <tbody>
    
    <tr>
    @php 
    $ctr_achi=0;
    @endphp
       @foreach($EmployeeAchievementInfo as $key=>$value) 
    @php
    $ctr_achi++;
    @endphp 
    <td>
      <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="achievement_slno[]"  value="{{$value->slno}}" >
    </td>
    <td>
      <input type="hidden" class="form-control" name="Achievement_sql_id[]" value="{{$value->id}}">
    <input type="date" class="form-control width"  name="achievement_date[]" value="{{$value->achievement_date}}"></td>
    <td><select class="form-control width" name="achievement_type[]" value="{{$value->achievement_type}}">
        <option>--select--</option>
        <option <?php if($value->achievement_type == 'Cost Saving'){ echo "selected"; } else { echo ""; } ?> value="Cost Saving">Cost Saving</option>
    <option <?php if($value->achievement_type == 'Process Improvemnt'){ echo "selected"; } else { echo ""; } ?> value="Process Improvemnt">Process Improvemnt</option>
     
     
    </select></td>
    
    <td><input type="text" class="form-control width"  name="achievement_period[]" value="{{$value->achievement_period}}"></td>
    
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="achievement_remark[]">{{$value->remark}}</textarea></td>
    
    @if($value->upload!="")
    <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="achievement_upload[]" style="width: 215px;"></td>
    <td>
      <?php if($value->upload!==""){
        if(file_exists(public_path()."/achievement/".$value->upload)) {?>
      <button type="button" onclick="openmodal('public/achievement/{{$value->upload}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
      <?php }} ?>
    </td>
      <td>
    
    
        <?php if($value->upload!==""){
      if(file_exists(public_path()."/achievement/".$value->upload)) {?>
      <div class="row">
        <div class="col-md-4">
          <a href="{{ url('public/achievement/'.$value->upload) }}" download="{{ $value->upload }}">
            <i class="fa fa-download" style="font-size:22px;"></i>
          </a>
        </div>
        <div class="col-md-4">
          <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("achievement") }}&file={{ $value->upload }}&t={{ base64_encode("emp_achievement_dtl") }}&c={{ base64_encode("upload") }}&i={{ base64_encode($value->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
            <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
          </a>
        </div>
        <div class="col-md-4">
          @php
          $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
          $explodeImage = explode('.', $value->upload);
          $extension = end($explodeImage);
        @endphp
        @if(in_array($extension, $imageExtensions))
        <img src="{{ url('public/achievement/'.$value->upload) }}" style="width:20px;height:20px;" >
          {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
        @elseif(strpos($extension, 'pdf') !== false)
          <i class="fa fa-file-pdf" style="font-size:22px;"></i>
        @elseif(strpos($extension, 'xlsx') !== false)
          <i class="fa fa-file-excel" style="font-size:22px;"></i>
        @elseif(strpos($extension, 'doc') !== false)
          <i class="fa fa-file-word" style="font-size:22px;"></i>
        @endif
        </div>
      </div>
     <?php } ?>
     <?php } ?>
    
    
      </td>
    @else
         <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="achievement_upload[]" style="width: 215px;"></td>
         <td></td>  
         <td></td>        
    @endif
    <td><button type="button" onclick="deleteachievement({{$value->id}});" 
    style="background-color: #7d98da">X</button></td>
    </tr>
    @endforeach
    @if($ctr_achi==0)
    <tr>
      <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="achievement_slno[]"  >
      </td>
    <td>
      <input type="hidden" class="form-control" name="Achievement_sql_id[]">
    
    <input type="date" class="form-control width"   name="achievement_date[]"></td>
    <td><select class="form-control width" name="achievement_type[]">
        <option>--select--</option>
        <option>Cost Saving</option>
        <option>Process Improvemnt</option>
     
    </select></td>
    
    <td><input type="text" class="form-control width"  name="achievement_period[]"></td>
    
    <td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="achievement_remark[]"></textarea></td>
    <td><input type="file" accept="image/png, image/gif, image/jpeg" name="achievement_upload[]" style="width: 215px;"></td>
    <td></td>
    <td></td>  
    <td><button type="button" class="deletebtn" title="Remove row" 
    style="background-color: #7d98da">X</button></td>
    </tr>
    @endif
    </tbody>
     </table>    
    </div> 
    </div>
    </div>  
    
    
    {{-- remark start--}}
    <div class="tab-pane fade <?php if($button==='REMARK'){echo 'show active';}?>" id="tab16" role="tabpanel" aria-labelledby="border-contact-tab">
      <div class="col-lg-12" style="overflow-y: auto;
      height: 400px;position: relative;">
      <div class="offset-lg-11 col-lg-1 new" onclick="addremark()" style="cursor: pointer;" id="add_new9">ADD NEW</div>
    
      <div class="tableFixHead" style="overflow-y: initial;">
      <table class="table table-bordered table-hover" id="tableachievemnt">
      <thead>
      <tr>
        <th>Sl No</th>
      <th>Remarks <span class="employeemaster" style="font-size: 20px">*</span></th>
      <th>Attachment</th>
      <th>Preview</th>
      <th>DOWNLOAD</th>
      <th>REMOVE</th>
      
      </tr>
      </thead>
      <tbody id="remark_body">
      
    @if (count($EmployeeRemarks) > 0)
    @php
    $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
    @endphp
    
    @foreach ($EmployeeRemarks as $key => $val)
    <tr id="remark_tr_{{ $val->id }}">
      <td align="center">
        <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="remark_slno[]" id="remark_slno_{{ $val->id }}" value="{{ $val->slno }}" style="margin: auto;"  >
      </td>
      <td align="center">
          <textarea rows="3" cols="40" class="form-control width" maxlength="150" id="remark_text_{{ $val->id }}" name="remark_text[]" style="margin: auto;">{{ $val->remark_text }}</textarea>
          <input type="hidden" id="remark_sql_id_{{ $val->id }}" name="remark_sql_id[]" value="{{ $val->id }}"> 
      </td>
      <td align="center"><input type="file" style="margin: auto;" accept="image/png, image/gif, image/jpeg" id="remark_attachment_{{ $val->id }}" name="remark_attachment[]"></td>
      <td align="center">
        <?php if(!$val->remark_attachment==""){
          if(file_exists(public_path()."/remark/".$val->remark_attachment)) {?>
        <button type="button" onclick="openmodal('public/remark/{{$val->remark_attachment}}')" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
        <?php }} ?>
      </td>
      <td>
    
        <?php if(!$val->remark_attachment==""){
          if(file_exists(public_path()."/remark/".$val->remark_attachment)) {?>
          <div class="row">
            <div class="col-md-4">
              <a href="{{ url('public/remark/'.$val->remark_attachment) }}" download="{{ $val->remark_attachment }}">
                <i class="fa fa-download" style="font-size:22px;"></i>
              </a>
            </div>
            <div class="col-md-4">
              <a onclick="{ return confirm('Are you sure ?')}" href="{{ url('/delete_doc') }}/?f={{ base64_encode("remark") }}&file={{ $val->remark_attachment }}&t={{ base64_encode("emp_remark_dtl") }}&c={{ base64_encode("remark_attachment") }}&i={{ base64_encode($val->id) }}&e=<?= base64_encode($_GET['search_emp']) ?>" >
                <i class="fa fa-trash text-danger" style="font-size: 22px;" aria-hidden="true"></i>
              </a>
            </div>
            <div class="col-md-4">
              @php
              $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','jfif','PNG'];
              $explodeImage = explode('.', $val->remark_attachment);
              $extension = end($explodeImage);
            @endphp
            @if(in_array($extension, $imageExtensions))
            <img src="{{ url('public/remark/'.$val->remark_attachment) }}" style="width:20px;height:20px;" >
              {{-- <i class="fa fa-image" style="font-size:22px;"></i> --}}
            @elseif(strpos($extension, 'pdf') !== false)
              <i class="fa fa-file-pdf" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'xlsx') !== false)
              <i class="fa fa-file-excel" style="font-size:22px;"></i>
            @elseif(strpos($extension, 'doc') !== false)
              <i class="fa fa-file-word" style="font-size:22px;"></i>
            @endif
            </div>
          </div>
         <?php } ?>
         <?php } ?>
    
      </td> 
      <td>
         <a style="padding:0px !important; width: 24px; background-color: #7d98da; box-shadow:none;border: 2px solid black; border-radius: 0px; margin: auto;" href="{{ url('/delete_empremark') }}/{{ $val->id }}/{{ $val->emp_no }}" class="btn deletebtn" onclick="{return confirm('Do you want to delete this remark?');}" title="Remove row">X</a>
      </td>
      </tr>
      @endforeach
    
    
     @else 
     
      @for ($v=1231313; $v<1231314 ;$v++)
      <tr id="remark_tr_{{ $v }}">
        <td align="center">
          <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="remark_slno[]" id="remark_slno_{{ $v }}"   style="margin: auto;">
        </td>
      <td align="center">
          <textarea rows="3" cols="40" class="form-control width" maxlength="150" id="remark_text_{{ $v }}" style="margin: auto;" name="remark_text[]"></textarea>
          <input type="hidden" id="remark_sql_id_{{ $v }}" name="remark_sql_id[]" value=""> 
      </td>
      <td align="center"><input type="file" style="margin: auto;" accept="image/png, image/gif, image/jpeg" id="remark_attachment_{{ $v }}" name="remark_attachment[]"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center">
         <button style="background-color: #7d98da; box-shadow:none;border: 2px solid black; border-radius: 0px; margin:auto;" type="button" class="deletebtn" onclick="removeis('{{ $v }}','remark_tr_{{ $v }}')" title="Remove row">X</button>
      </td>
      </tr>
      @endfor
    
      @endif
    </tbody> 
       </table> 
      </div>     
      </div>
      </div>
    {{-- remark end--}}
    
    <script>
      function removeis(i,tr){
          $("#"+tr).remove();
      }
    
    var num = Math.floor((Math.random()*100000000000000000)+1);
    function addremark(){
    $("#remark_body").append(`<tr id="remark_tr_${num}">
      <td align="center">
          <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="remark_slno[]" id="remark_slno_${num}"   style="margin: auto;">
        </td>
      <td align="center">
          <textarea rows="3" cols="40" class="form-control width" maxlength="150" id="remark_text_${num}" name="remark_text[]" style="margin: auto;"></textarea>
          <input type="hidden" id="remark_sql_id_${num}" name="remark_sql_id[]" value="">
      </td>
      <td align="center"><input type="file" accept="image/png, image/gif, image/jpeg" id="remark_attachment_${num}" name="remark_attachment[]" style="margin: auto;"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center">
         <button type="button" style="background-color: #7d98da; box-shadow:none;border: 2px solid black; border-radius: 0px;margin: auto;" class="deletebtn" onclick="removeis('${num}','remark_tr_${num}')" title="Remove row">X</button>
      </td>
      </tr>`);
      num++;
    }  
    
    
    </script>
    
    
    
    
    
    
    
    
    </div>
    
                        </div>
                      </div>















 
                



















</div>

 



            
        </div>
    </div>
</div>
</div>

</div>




            <div id="modalOptionalSizes" class="col-lg-12 layout-spacing">
                            <div class="statbox box box-shadow">
                                <div class="widget-content">
                                    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myExtraLargeModalLabel">Employee List</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                </button>
                                            </div>
                          <div class="layout-px-spacing">

                <div class="row layout-top-spacing" id="cancel-row">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive  mt-4">
                                <div class="offset-xl-8 col-xl-4 col-lg-4 col-sm-4" style="text-align: right;">
                                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                              </div>

                                <br><br>
                                <table id="html5-extension" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                          <th>Employee No</th>
                                            <th>Employee Name</th>
                                            <th>Employee Code</th>
                                            <th>Edit</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                  @foreach($Employee_fetch1 as $ky=>$val)
                                           <tr>
                                                <td>{{$val->emp_no}}</td>
                                                 
                                                <td>{{$val->emp_name}}</td> 
                                                <td>{{$val->employee_code}}</td>
                                                <td>    <a href="{{url('/')}}/employee_edit_master/?search_emp={{ $val->emp_no }}"  title="Edit" class="editbtn" class="btn btn-success editbtn" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></td>
                                              
                                                 
                                            
                                            </tr>
                                             @endforeach
                                    </tbody>
                                         
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
<!--                                             <div class="modal-footer">
                                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                <button type="button" class="btn btn-primary">Save</button>
                                            </div> -->
                                        </div>
                                      </div>
                                    </div>
        
       
                                </div>
                            </div>
                        </div>




            <div id="modalOptionalSizes" class="col-lg-6 layout-spacing">
                            <div class="statbox box box-shadow">
                                <div class="widget-content">
                                    <div class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                               <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                </button> -->
                                    
                                                    <div class="modal-body">
                       <form action=""  method="post">
                   
                   <div class="form-group">
                            
                              <input type="hidden" class="form-control" name="pro_id" id="pro_id" aria-describedby="textHelp">
                              
                            </div>
                            <div class="form-group">
                              <label for="exampleInputtext1">Board/University Name</label>
                              <input type="text" class="form-control" id="pro_name" name="pro_name" aria-describedby="textHelp">
                              
                            </div>
                           
                             <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Add</button>
                      </div>
                          
                          
                       
                          </form>
                      
                      </div>
                                       
                                        </div>
                                      </div>
                                    </div>
        
       
                                </div>
                            </div>
                        </div></div></div>
                        </form>
        <!--  END CONTENT AREA  -->
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" style="min-height: 500px; overflow: scroll; display: flex;
      align-items: center;
      justify-content: center;" >
    
        <img id="set_img_url" class="img-fluid" >
     
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="docModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" style="height: 500px; overflow: scroll; " >

        <iframe id="set_doc_url" frameborder="0" scrolling="no" width="100%" height="450" >
        </iframe>
        {{-- <object id="set_doc_url" scrolling="no" width="100%" height="450" data=""  width="800"  height="500">  --}}
        </object>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
var main_url = `{{ url('/')}}`;
function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
}

// setlasttab();
// function setlasttab(){
//   let btn = localStorage.getItem("samaj_data")?JSON.parse(localStorage.getItem("samaj_data")):null;
//   if(btn !== null){
//     let id = btn.lastbtn;
//    let inputf = document.getElementById(id);
//   }
// }
// function getCookie(name) {
//   var nameEQ = name + "=";
//   var ca = document.cookie.split(';');
//   for (var i = 0; i < ca.length; i++) {
//     var c = ca[i];
//     while (c.charAt(0) == ' ') c = c.substring(1, c.length);
//     if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
//   }
//   return null;
// }

 function storetype(type){
  window.localStorage.clear();
  var expires = "";
  var date = new Date();
  let data = {"lastbtn":type,"date": date};

  window.localStorage.setItem("samaj_data", JSON.stringify(data));
  date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
  expires = "; expires=" + date.toUTCString();
  document.cookie = "samaj_data" + "=" + (type || "") + expires + "; path=/";
 }








 
function openmodal(url){
  let checkType = url.split(".")
  // let num = checkType.slice(-1);
  let num = checkType.length-1;
  let forimg = document.getElementById("set_img_url");
  let fordoc = document.getElementById("set_doc_url");
  if(!url==""){
      if(checkType[num]=="pdf"){
        fordoc.removeAttribute("src");
        fordoc.setAttribute("src",`${main_url}/${url}`);
        $("#docModal").modal('show');
      } else {
        forimg.removeAttribute("src");
        forimg.setAttribute("src",`${main_url}/${url}`);
        $("#exampleModal").modal('show');
      }
  }
}









  // $('#dtpFrDate').datepicker({ dateFormat: 'dd-mm-yy' });
  // $('#dtpFrDate1').datepicker({ dateFormat: 'dd-mm-yy' });
  // $('#dtpFrDate2').datepicker({ dateFormat: 'dd-mm-yy' });
  // $('#dtpFrDate3').datepicker({ dateFormat: 'dd-mm-yy' });
  // $('#dtpFrDate4').datepicker({ dateFormat: 'dd-mm-yy' });



</script>
 <script>
var v = 0;  
    function transfer(id){
    var transfer_id = $('#transferid'+id).val();
    if(id>=v){
        $('#selectdepartment').val(transfer_id);
        v=id;
    }
    }
    var w = 0;  
    function transferWork(id){
    var work_id = $('#transferWorkid'+id).val();
    console.log(work_id);
    if(id>=w){
        $('#selectWorkplace').val(work_id);
        w=id;
    }
} 
var p = 0;  
    function portionDropdown(id){
    var portion_id = $('#portionDropdownid'+id).val();
    console.log(portion_id);
    if(id>=p){
        $('#selectdesignation').val(portion_id);
        p=id;
    }
} 
  function promotion(id)
{
 // alert(id);
      var pkid = $('#promotionid'+id).val();
      // alert(pkid);
      $('#promotionid'+id).val(pkid);
     $.ajax({
         type:'POST',
          url: "{{url('/getPromotion')}}",
          dataType: "json",
         data:{
       '_token':$('input[name=_token]').val(),        
       'selectedid': pkid
        },
        success: function(data){
         // console.log(data);
         $('#catch_paygrade_value'+id).val(data[0].pay_scale);
         $('#promtion_current_allowance'+id).val(data[0].special_allowance);
         $('#promtion_currentother_allowance'+id).val(data[0].other_special_allowance);
          }

      });
 // alert(id);
}
function topromotion(id)
{
   var pkid = $('#promotiontoid'+id).val();
    $.ajax({
         type:'POST',
          url: "{{url('/gettoPromotion')}}",
          dataType: "json",
         data:{
       '_token':$('input[name=_token]').val(),        
       'selectedid': pkid
        },
        success: function(data){
         // console.log(data);
         $('#catch_topaygrade_value'+id).val(data[0].pay_scale);
         $('#promtion_tocurrent_allowance'+id).val(data[0].special_allowance);
         $('#promtion_tocurrentother_allowance'+id).val(data[0].other_special_allowance);
          }

      });
}
  function probation(id)
{
      var pkid = $('#probationid'+id).val();
       //alert(pkid);
      $('#probationid'+id).val(pkid);
     $.ajax({
         type:'POST',
          url: "{{url('/getProbation')}}",
          dataType: "json",
         data:{
       '_token':$('input[name=_token]').val(),        
       'selectedid': pkid
        },
        success: function(data){
         // console.log(data);
         $('#promotion_catch_topaygrade_value'+id).val(data[0].pay_scale);
         $('#probation_current_allowance'+id).val(data[0].special_allowance);
         $('#probation_tocurrentother_allowance'+id).val(data[0].other_special_allowance);
          }

      });
 // alert(id);
} 
 function deletedependent(did)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var dependent_id = did;
      console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_dependent')}}",
            type: "POST",
            data: {'_token': token,'did':dependent_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
    function deletequalification(qid)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var qualification_id = qid;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_qualification')}}",
            type: "POST",
            data: {'_token': token,'qid':qualification_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
    function deleteorganization(qid)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var qualification_id = qid;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_organization')}}",
            type: "POST",
            data: {'_token': token,'qid':qualification_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
    function deletetransfer(qid)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var qualification_id = qid;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_transfer')}}",
            type: "POST",
            data: {'_token': token,'qid':qualification_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
    //promotion
    function deletepromotion(pid)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var promotion_id = pid;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_promotion')}}",
            type: "POST",
            data: {'_token': token,'pid':promotion_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
    //probation
    function deleteprobation(pid)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var promotion_id = pid;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_probation')}}",
            type: "POST",
            data: {'_token': token,'pid':promotion_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
    function deletecontract(cid)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var contract_id = cid;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_contract')}}",
            type: "POST",
            data: {'_token': token,'cid':contract_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
    function deleteantecedent(cid)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var contract_id = cid;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_antecedent')}}",
            type: "POST",
            data: {'_token': token,'cid':contract_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
    function deleterevocation(cid)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var contract_id = cid;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_revocation')}}",
            type: "POST",
            data: {'_token': token,'cid':contract_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
    function deleteintiation(inti_id)
    {
      //salert(inti_id);
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var intiation_id = inti_id;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_intiation')}}",
            type: "POST",
            data: {'_token': token,'inti_id':intiation_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
        function deleteachievement(achievement_id)
    {
      //alert(achievement_id);
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var achievement_id = achievement_id;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/deleteachievement')}}",
            type: "POST",
            data: {'_token': token,'achievement_id':achievement_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
    function deleteAppreciation(cid)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var contract_id = cid;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_appreciation')}}",
            type: "POST",
            data: {'_token': token,'cid':contract_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }

function deleteReward(cid)
    {
      var conf = confirm("Do you want to delete this permanetly?");
      if(conf)
      {
      var token = '{{ csrf_token() }}';
      var contract_id = cid;
      //console.log(dependent_id)
        $.ajax({
            url: "{{url('/delete_reward')}}",
            type: "POST",
            data: {'_token': token,'cid':contract_id},
            dataType: "json",
            success: function (data)
            { //alert(data);
                if(data=='1')
                {
                     window.location.reload();
                }else 
                {
                return false;
            }
            },
        });
      }
    }
 </script> 
   
<script>
    $(function(){
        $("#board_name_ajax_id").select2();
        $(".select2_dynamic").select2();
    });
function showfield(name){
//  alert(name);
    if(name != 'A') {
      $(".r_class").show();
       $("#reason,#r_dob,#r_txtReason").prop("disabled",false);  
    }else{
       $(".r_class").hide();  
       $("#reason,#r_dob,#r_txtReason").prop("disabled",true);
    }
 
}
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

  $(document).on('change', '#packageid', function(e) { 
       e.preventDefault(); 
       var pkid = $(this).val();
       //alert(pkid);
     $.ajax({
         type:'POST',
          url: "{{url('/getPackage')}}",
          dataType: "json",
         data:{
       '_token':$('input[name=_token]').val(),        
       'selectedid': pkid
        },
        success: function(data){
          if(data!=""){
         $('#catch_value').val(data[0].pay_scale);
         $('#current_allowance').val(data[0].special_allowance);
         $('#initial_allowance').val(data[0].special_allowance);
         $('#initial_other').val(data[0].other_special_allowance);
         $('#cuurent_other').val(data[0].other_special_allowance);
           }
          else{
           $('#catch_value').val("");
           $('#current_allowance').val("");
           $('#initial_allowance').val("");
           $('#initial_other').val("");
           $('#cuurent_other').val("");
           }

      }
   });
 });
      $(function () {
        $("#ddlModels").change(function () {
            if ($(this).val() == 'M') {
                $("#spouseName").prop("disabled", false).focus();
                $("#spouseDOB").prop("disabled", false);
            } else {
                $("#spouseName").prop("disabled", true).val("");
                $("#spouseDOB").prop("disabled", true).val("");
            }
        });
    });
</script>


<script type="text/javascript">
    function form_validation(){
      var emp_no = $('#emp_no').val();
      var active_type = $('#active_type').val();
      var emp_name = $('#emp_name').val();
      var emp_code = $('#emp_code').val();
      var department = $('#department').val();
      var emp_type = $('#emp_type').val();
      var designation = $('#designation').val();
      var category = $('#category').val();
      var workplace = $('#workplace').val();
      var DOB = $('#DOB').val();
      var DOJ = $('#dtpFrDate1').val();
      var DOP = $('#dtpFrDate2').val();
      var DOC = $('#dtpFrDate3').val();
      var retirement_date = $('#dtpFrDate4').val();
      var vpf_val = $('#vperc_textbox').val();
      var esi_val = $('#esiacc').val();
      var uan_val = $('#uano').val();
      var email = $('#email').val();
      if(emp_no==""){
        $('#emp_no').focus();
        $("#emp_no_label").css('display','block');
        return false; 
      } else {
        $("#emp_no_label").css('display','none');
      }
      if(active_type==""){
        $('#active_type').focus();
        return false; 
      }
      if(emp_name==""){
        $('#emp_name').focus();
        $("#emp_name_label").css('display','block');
        return false; 
      }else {
        $("#emp_name_label").css('display','none');
      }
      if(emp_code==""){
        $('#emp_code').focus();
        $("#emp_code_label").css('display','block');
        return false; 
      }else {
        $("#emp_code_label").css('display','none');
      }
      if(department==""){
        $('#department').focus();
        $("#department_label").css('display','block');
        return false; 
      }else {
        $("#department_label").css('display','none');
      }
      if(emp_type==""){
        $('#emp_type').focus();
        $("#emp_type_label").css('display','block');
        return false; 
      }else {
        $("#emp_type_label").css('display','none');
      }
      if(designation==""){
        $('#designation').focus();
        $("#designation_label").css('display','block');
        return false; 
      }else {
        $("#designation_label").css('display','none');
      }
      if(category==""){
        $('#category').focus();
        $("#category_label").css('display','block');
        return false; 
      }else {
        $("#category_label").css('display','none');
      }
      if(workplace==""){
        $('#workplace').focus();
        $("#workplace_label").css('display','block');
        return false; 
      }else {
        $("#workplace_label").css('display','none');
      }

      if(DOB==""){
        $('#DOB').focus();
        $("#dtpFrDate_label").css('display','block');
        return false; 
      }else {
        $("#dtpFrDate_label").css('display','none');
      }

      if(emp_type=="CO"){
        //   if(DOJ==""){
        //   $('#dtpFrDate1').focus();
        //   $("#dtpFrDate1_label").css('display','block');
        //   return false; 
        // }else {
        //   $("#dtpFrDate1_label").css('display','none');
        // }
        // if(DOC==""){
        //   $('#dtpFrDate3').focus();
        //   $("#dtpFrDate3_label").css('display','block');
        //   return false; 
        // }else {
        //   $("#dtpFrDate3_label").css('display','none');
        // }
      }else if(emp_type=="PR"){
          if(DOP==""){
          $('#dtpFrDate2').focus();
          $("#dtpFrDate2_label").css('display','block');
          return false; 
        }else {
          $("#dtpFrDate2_label").css('display','none');
        }
      }else if(emp_type=="PE"){
        if(DOC==""){
          $("#doc_div").html("*");
          $('#dtpFrDate3').focus();
          $("#dtpFrDate3_label").css('display','block');
          return false; 
        }else {
          $("#dtpFrDate3_label").css('display','none');
        }
        // if(DOP==""){
        //   $('#dtpFrDate2').focus();
        //   $("#dtpFrDate2_label").css('display','block');
        //   return false; 
        // }else {
        //   $("#dtpFrDate2_label").css('display','none');
        // }
        if(retirement_date==""){
          $("#retire_div").html("*");
        $('#dtpFrDate4').focus();
        $("#dtpFrDate4_label").css('display','block');
        return false; 
      }else {
        $("#dtpFrDate4_label").css('display','none');
      }
      }
     
     if(DOJ==""){
          $('#dtpFrDate1').focus();
          $("#dtpFrDate1_label").css('display','block');
          return false; 
        }else {
          $("#dtpFrDate1_label").css('display','none');
        }
      
      


        if(isNaN(vpf_val))
        {
            alert ("Please enter VPF as number");
           return false; 
        }
      if(!esi_val==""){
        if(isNaN(esi_val))
        {
            alert ("Please enter ESI as number");
            return false; 
        } else if(esi_val.length < 10){
            alert ("ESI no should be 10 digit");
            $('#esiacc').focus();
            return false; 
        } else if(esi_val.length > 10){
            alert ("ESI no should be 10 digit");
            $('#esiacc').focus();
            return false; 
        }
      }
      if(!uan_val==""){
        if(isNaN(uan_val))
        {
            alert ("Please enter UAN as number");
            return false; 
        } else if(uan_val.length < 12){
            alert ("UAN should be 12 digit");
            $('#uano').focus();
            return false; 
        } else if(uan_val.length > 12){
            alert ("UAN should be 12 digit");
            $('#uano').focus();
            return false; 
        }
      }
      let aadhar = $("#input-payment-egn3").val();
      if(!aadhar==""){ 
            // alert ("Please enter aadhaar no");
            // $('#input-payment-egn3').focus();
            // return false;
          if(isNaN(aadhar)) {
              alert ("Please enter aadhaar no as number");
              $('#input-payment-egn3').focus();
              return false; 
          } else if(aadhar.length < 12){
              alert ("Aadhaar no should be 12 digit");
              $('#uinput-payment-egn3ano').focus();
              return false; 
          } else if(aadhar.length > 12){
              alert ("Aadhaar no should be 12 digit");
              $('#input-payment-egn3').focus();
              return false; 
          }
      }
      if(email=="")
        {
            alert("Please enter email id");
            return false; 
        }

    }
</script>


  <script>
    $(document).ready(function () {
       let ms = $("#ddlModels").val();
      if (ms == 'M') {
                $("#spouseName").prop("disabled", false).focus();
                $("#spouseDOB").prop("disabled", false);
            } else {
                $("#spouseName").prop("disabled", true).val("");
                $("#spouseDOB").prop("disabled", true).val("");
            }
      // Denotes total number of rows
      var rowIdx = 0;
  
      // jQuery button click event to add a row
      $('#addBtn').on('click', function () {
  
        // Adding a row inside the tbody.
        $('#tbody').append(`<tr id="R${++rowIdx}">
                 <p>Row ${rowIdx}</p>
                 <td>
    <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="antecedent_slno[]"  >
  </td>                  
<td>
<input type="hidden" class="form-control width" name="antecedent_sql_id[]">
<input type="text" class="form-control width" name="ante_order_no[]"></td>
<td><input type="date" class="form-control"   name="ante_order_date[]"></td>
<td>   <select class="form-control  width" name="ante_type[]">
        <option>Explanation</option>
        <option>Termination</option>
        <option>Warning</option>
        <option>Salary Deduction</option>
        <option>Demotion</option>
        <option>Charge Sheet</option>
        <option>Suspension</option>
        <option>Others</option>
    </select></td>
<td><input type="date" class="form-control"   name="ante_w_e_e[]"></td>
<td><input type="date" class="form-control"   name="ante_w_e_t[]"></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="ante_remarks[]"></textarea></td>
 <td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="antecedent_upload[]" style="width: 215px;"></td>
     <td></td>  
     <td></td>     
<td><button type="button" class="deletebtn" title="Remove row" 
style="background-color: #7d98da">X</button></td>

</tr>`
              );
      });
  
      // jQuery button click event to remove a row.
      $('#tbody').on('click', '.remove', function () {
  
        // Getting all the rows next to the row
        // containing the clicked button
        var child = $(this).closest('tr').nextAll();
  
        // Iterating across all the rows 
        // obtained to change the index
        child.each(function () {
  
          // Getting <tr> id.
          var id = $(this).attr('id');
  
          // Getting the <p> inside the .row-index class.
          var idx = $(this).children('.row-index').children('p');
  
          // Gets the row number from <tr> id.
          var dig = parseInt(id.substring(1));
  
          // Modifying row index.
          idx.html(`Row ${dig - 1}`);
  
          // Modifying row id.
          $(this).attr('id', `R${dig - 1}`);
        });
  
  
      });
    });

  let l=<?=$counter?>;
    
$("#addBtn1").click(function () { 
  l++;
  $("#e-body").append(`<tr>
    <td><input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="depend_snno[]" id="depend_snno${l}"  ></td>     
<td class="td2"> <input type="hidden" class="form-control" name="depedent_sql_id[]">
  <input type="text" class="form-control width" name="name[]" placeholder=""  ></td>
<td><select class="form-control nm" name="dependent_type[] "style="width: 124px" id="one${l}" onchange="nominee_select(this.value,${l})" >
    <option value="Dependent">Dependent</option>
    <option value="Nominee" >Nominee</option></select></td>
    <td><input type="date" class="form-control" name="dob1[]" id="dob_${l}" onchange="check_age('dob_${l}','age_${l}','${l}')" placeholder="enter DOB"></td>
<td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control  td1" id="age_${l}"  readonly name="age[]" ></td>
<td class="td2"><input type="text" class="form-control width" name="relation[]" placeholder=" " style="    width: 207px;"></td>
<td  class="td2"><input type="number" class="form-control width" name="num[]" placeholder="enter adhara"  style="    width: 207px;"></td>
<td><textarea rows="3" cols="40" class="form-control"  name="dependent_addr[]" style="width:200px;"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="dependent_file[]" style="width: 215px;"></td>
<td></td>
<td></td>
<td>
   <button type="button" class="deletebtn" title="Remove row" style="background-color: #7d98da">X</button>
</td>

</tr>`);

});
 var dept_select = "";
$(function(){
  let c = {{$counter}};
  for(let h = 0;h<=c;h++){
    if($("#one"+h).val()=="Nominee"){
       dept_select = "Nominee";
       break;
     }else{
       dept_select = "";
     }
  }
})
//alert(l);. 
// dept_select="";  


function check_age(d,a,i){
    let dob = $("#"+d).val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '{{url('/agecheck')}}',
        type: "POST",
        data: { 
            '_token': CSRF_TOKEN,
            'dob': dob,
        },
        success: function(data, textStatus, jQxhr) {
            console.clear();
                // console.log(data); return;
                let ex_data = data.split("_");
                $("#"+a).val("").val(ex_data[0]);
            }
        })
}
function nominee_select(dependent_type,dept_selector){
//   if($(".nm").val() ==  "Nominee"){
//   dept_select = "Nominee";
//     alert(1);
// }else{
 

// }
  //alert(dept_select);
    if(dept_select=="" && dependent_type=="Nominee")
    {
       $("#one"+dept_selector+" option[value='Nominee']").attr('selected',true);
       dept_select = "Nominee";
    }
    else if(dept_select!="" && dependent_type=="Nominee")
    {
      alert("Nominee has already selected");
      // $("#one"+dept_selector+" option[value='Dependent']").attr('selected',true);
      $("#one"+dept_selector).val("Dependent");
    }
    else if(dept_select!="" && $("#one"+dept_selector+" :selected").text()=="Nominee")
    {
        $("#one"+dept_selector+" option[value='Dependent']").attr('selected',true);
        dept_select = "";
    }else if( dependent_type=="Dependent"){
       dept_select = "";
    }

  }

   
     $(document).ready(function () {
  
      // Denotes total number of rows
      var rowIdx = 0;
  
      // jQuery button click event to add a row
      $('#addBtnQual').on('click', function () {
  
        // Adding a row inside the tbody.
        $('#e-body_qual').append(`<tr id="R${++rowIdx}">
                 <p>Row ${rowIdx}</p>
<td>
  <input type="number" value="" class="form-control td2" onkeypress="return isNumberKey(event)" name="academic_snno[]" id="academic_snno${rowIdx}" >
</td>
 <td>
  <input type="hidden" name="qlf_hiddenSqlid[]"> 
  <input type="hidden" class="form-control width" placeholder="" value="A" name="typcce[]">
  <select class="form-control width" name="academic[]">
  <option>Select</option>
     @foreach($Qual_lvl as $ky=>$val)
    <option value="{{$val->QUALIFICATION_LEVEL_CODE}}">{{$val->QUALIFICATION_LEVEL}}</option>
        @endforeach

    </select></td>
        <td><input type="text" class="form-control width" placeholder="" name="qualification[]"></td>
<td><input type="text" class="form-control width" placeholder="" name="stream[]"></td>

<td> 
      <div class="container box"  style="margin-left:-10px">

 <input type="text" class="form-control" name="board_name_ajax1[]" value="" style="width: 409px;">
    <div id="boardList">

  </div>
     </td>
<td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="" name="year[]"></td>
<td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="" name="per_mark[]" style="    width: 68px;"></td>
<td> <select class="form-control width" name="division_qualification[]">
              <option value="">select</option>
              <option value="P">Pass</option>
                <option value="F">First</option>
                <option value="S">Second</option>
                <option value="T">Third</option>
             
            </select></td>
<td><textarea rows="3" cols="40" class="form-control"  name="remark_qualification[]" style="width:200px;"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="" name="qualification_file[]" style="width: 215px;"></td>
  <td></td>
  <td></td>
  <td><button type="button" class="deletebtn" title="Remove row" style="background-color: #7d98da">X</button></td>
</tr>`
              );
      });
  
      // jQuery button click event to remove a row.
      $('#e-body_qual').on('click', '.remove', function () {
 });
    });


          $(document).ready(function () {
  
      // Denotes total number of rows
      var rowIdx = 0;
  
      // jQuery button click event to add a row
      $('#addBtnQual1').on('click', function () {
  
        // Adding a row inside the tbody.
        $('#e-body_qual1').append(`<tr id="R${++rowIdx}">
                 <p>Row ${rowIdx}</p>

 <tr>
  <td>
  <input type="number" value="" class="form-control td2" onkeypress="return isNumberKey(event)" name="academic_snno[]" id="academic_snno${rowIdx}" >
</td> 
  <td>
    <input type="hidden" name="qlf_hiddenSqlid[]"> 
  <input type="hidden" class="form-control width"  value="T" name="typcce[]">
  <select class="form-control width" name="academic[]">
  <option>Select</option>
     @foreach($Qual_lvl as $ky=>$val)
    <option value="{{$val->QUALIFICATION_LEVEL_CODE}}">{{$val->QUALIFICATION_LEVEL}}</option>
        @endforeach

    </select></td>
        <td><input type="text" class="form-control width" placeholder="" name="qualification[]"></td>
<td><input type="text" class="form-control width" placeholder="" name="stream[]"></td>

<td> 
      <div class="container box"  style="margin-left:-10px">

 <input type="text" class="form-control" name="board_name_ajax1[]" value="" style="width: 409px;">
    <div id="boardList">

  </div>
     </td>
<td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57"class="form-control" placeholder="" name="year[]"></td>
<td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="" name="per_mark[]" style="    width: 68px;"></td>
<td> <select class="form-control width" name="division_qualification[]">
  <option value="">Select Division</option>
                <option value="P">Pass</option>
                <option value="F">First</option>
                <option value="S">Second</option>
                <option value="T">Third</option>
             
            </select></td>
<td><textarea rows="3" cols="40" class="form-control"  name="remark_qualification[]" style="width:200px;"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="" name="qualification_file[]" style="width: 215px;"></td>


  
  <td></td>
  <td></td>
  <td><button type="button" class="deletebtn" title="Remove row" style="background-color: #7d98da">X</button></td>
</tr>`
              );
      });
  
      // jQuery button click event to remove a row.
      $('#e-body_qual').on('click', '.remove', function () {
 });
    });




      $(document).ready(function () {
  
      // Denotes total number of rows
      var rowIdx = 0;
  
      // jQuery button click event to add a row
      $('#addBtn2').on('click', function () {
  
        // Adding a row inside the tbody.
        $('#experience_body').append(`<tr id="R${++rowIdx}">
                 <p>Row ${rowIdx}</p>
                 <td>
  <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="experience_snno[]"  >
</td>                 
<td><input type="hidden" class="form-control" name="experience_sql_id[]"><input type="text" class="form-control" placeholder=""  name="orgn[]" style="width: 255px;"></td>
<td><input type="text" class="form-control width2" placeholder="" name="sect[]"></td>
<td><input type="text" class="form-control width2" placeholder="" name="pos[]"></td>
<td><input type="date" class="form-control" placeholder="01/03/2015" name="from[]"></td>
<td><input type="date" class="form-control" placeholder="01/03/2017" name="to[]"></td>
<td><textarea rows="3" cols="40" class="form-control"  name="area[]"></textarea></td>
<td><textarea rows="3" cols="40" class="form-control"  name="remark_area[]" style="width:250px;"></textarea></td>
<td><input type="file" style="width: 215px;" accept="image/png, image/gif, image/jpeg" name="e_file[]"></td>
<td></td>
<td></td>
 <td><button type="button" class="deletebtn" title="Remove row" style="background-color: #7d98da">X</button></td>
</tr>`
              );
      });
  
      // jQuery button click event to remove a row.
      $('#experience_body').on('click', '.remove', function () {
  
        // Getting all the rows next to the row
        // containing the clicked button
        var child = $(this).closest('tr').nextAll();
  
        // Iterating across all the rows 
        // obtained to change the index
        child.each(function () {
  
          // Getting <tr> id.
          var id = $(this).attr('id');
  
          // Getting the <p> inside the .row-index class.
          var idx = $(this).children('.row-index').children('p');
  
          // Gets the row number from <tr> id.
          var dig = parseInt(id.substring(1));
  
          // Modifying row index.
          idx.html(`Row ${dig - 1}`);
  
          // Modifying row id.
          $(this).attr('id', `R${dig - 1}`);
        });
  
  
      });
    });
     $(document).ready(function () {
  
  // Denotes total number of rows
  var rowIdx = 0;

  // jQuery button click event to add a row
  $('#add_new_appreciation').on('click', function () {

    // Adding a row inside the tbody.
    $('#table_appreciation').append(`<tr id="R${++rowIdx}">
             <p>Row ${rowIdx}</p>
<td>
  <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="app_slno[]" >
</td>
             <td>
              <input type="hidden" class="form-control" name="appr_sqli_id[]">
             <input type="text" class="form-control width" name="app_order_no[]"></td>
<td><input type="date" class="form-control width"  name="app_order_date[]"></td>
<td><select class="form-control width" name="appreciation_type[]">
    <option>--select--</option>
    <option value="Cost-saving">Cost Saving</option>
    <option value="Process_Improvemnt">Process Improvemnt</option>
 
</select></td>
<td><input type="text" class="form-control width" name="recommended_by[]"></td>
<td><textarea rows="3" cols="40" class="form-control"  name="app_description[]" style="width:200px;"></textarea></td>

<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="app_remarks[]"></textarea></td>
<td><input type="file" style="width: 215px;" accept="image/png, image/gif, image/jpeg" name="appriciation_upload[]"></td>
 <td></td>  
 <td></td>        
<td><button type="button" class="deletebtn" title="Remove row" 
style="background-color: #7d98da">X</button></td>

</tr>`
          );
  });

  // jQuery button click event to remove a row.
  $('#table_appreciation').on('click', '.remove', function () {

    // Getting all the rows next to the row
    // containing the clicked button
    var child = $(this).closest('tr').nextAll();

    // Iterating across all the rows 
    // obtained to change the index
    child.each(function () {

      // Getting <tr> id.
      var id = $(this).attr('id');

      // Getting the <p> inside the .row-index class.
      var idx = $(this).children('.row-index').children('p');

      // Gets the row number from <tr> id.
      var dig = parseInt(id.substring(1));

      // Modifying row index.
      idx.html(`Row ${dig - 1}`);

      // Modifying row id.
      $(this).attr('id', `R${dig - 1}`);
    });


  });
});

var j=20;
      $("#add_newtransferno").click(function () {  
        j++;
    $("#table_transfer").append(`<tr>
      <td>
    <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="transfer_snno[]"  >
  </td>
       <td>
         <input type="hidden" class="form-control" name="transfer_sql_id[]">
   <input type="text" class="form-control width" width="130px" name="trans_order[]"></td>
   <td><input type="date"  class="form-control" placeholder="05/03/2009" width="130px" name="transfer_ord_date[]"></td>
<td> <select class="form-control width" name="order_type[]" >
  <option value="Transfer">Transfer</option>
        <option value="Deputation">Deputation</option>
    </select></td>

<td><input type="date"  class="form-control" placeholder="13/03/2008" name="from_date[]"></td>
<td><input type="date" class="form-control" placeholder="13/03/2008" name="to_date[]" ></td>
<td> <select class="form-control width"  name="f_dept[]">
<option>Select</option>
     @foreach($Department_fetch as $ky=>$val)
    <option value="{{$val->dept_no}}">{{$val->dept_name}}</option>
        @endforeach
  </select>
</td>
<td><select class="form-control width" name="t_dept[]" onchange="transfer(${j})"  id="transferid${j}">
<option>Select</option>
     @foreach($Department_fetch as $ky=>$val)

    <option value="{{$val->dept_no}}">{{$val->dept_name}}</option>
        @endforeach
  </select></td>
<td><select class="form-control width" name="from_work[]">
<option>Select</option>
@foreach($Workplace_fetch as $ky=>$val)

     <option value="{{$val->id}}">{{$val->workplace_name}}</option>
 @endforeach
</select></td>
<td><select class="form-control width" name="to_work[]"  onchange="transferWork(${j})"  id="transferWorkid${j}">
<option>Select</option>
@foreach($Workplace_fetch as $ky=>$val)
     <option value="{{$val->id}}">{{$val->workplace_name}}</option>
 @endforeach
</select></td>

<td> <select class="form-control width"   name="ord_rea[]">
        <option>Select</option>
        <option>Reward</option>
        <option>Routine</option>
        <option>Displinary</option>
        <option>Other</option>
    </select></td>
<td><textarea rows="3" cols="40" class="form-control width" name="reamrks[]"></textarea></td>
<td><input type="file" style="width: 215px;" accept="image/png, image/gif, image/jpeg" name="trans_file[]" ></td>
<td></td>
<td></td>
<td><button type="button" class="deletebtn" title="Remove row" 
style="background-color: #7d98da">X</button></td>
              
                </tr>`);
           
});

     $(document).ready(function () {
  
  // Denotes total number of rows
  var rowIdx = 0;

  // jQuery button click event to add a row
  $('#add_new_reward').on('click', function () {

    // Adding a row inside the tbody.
    $('#table_reward').append(`<tr id="R${++rowIdx}">
             <p>Row ${rowIdx}</p>
             <td>
    <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="reward_slno[]" >
  </td>
<td>
  <input type="hidden" class="form-control" name="reward_sqli_id[]">
<input type="text" class="form-control width" name="reorder_no[]"></td>
<td><input type="date" class="form-control width"  name="reorder_date[]"></td>
<td><select class="form-control width" name="reward_type[]">
     <option>--select--</option>
    <option value="Cost-saving">Cost Saving</option>
    <option value="Process_Improvemnt">Process Improvemnt</option>
</select></td>
<td><input type="text" class="form-control width" name="re_recommended_by[]"></td>
<td><textarea rows="3" cols="40" class="form-control"  name="re_description[]" style="width:200px;"></textarea></td>

<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="re_remarks[]"></textarea></td>
<td><input type="file" style="width: 215px;" accept="image/png, image/gif, image/jpeg" name="remark_upload[]"></td>
<td></td>
<td></td>
<td><button type="button" class="deletebtn" title="Remove row" 
style="background-color: #7d98da">X</button></td>
</tr>`
          );
  });

  // jQuery button click event to remove a row.
  $('#table_reward').on('click', '.remove', function () {

    // Getting all the rows next to the row
    // containing the clicked button
    var child = $(this).closest('tr').nextAll();

    // Iterating across all the rows 
    // obtained to change the index
    child.each(function () {

      // Getting <tr> id.
      var id = $(this).attr('id');

      // Getting the <p> inside the .row-index class.
      var idx = $(this).children('.row-index').children('p');

      // Gets the row number from <tr> id.
      var dig = parseInt(id.substring(1));

      // Modifying row index.
      idx.html(`Row ${dig - 1}`);

      // Modifying row id.
      $(this).attr('id', `R${dig - 1}`);
    });


  });
}); 
var k=20;
$("#add_newpromotion").click(function () {
k++; 
//alert(k);
  $("#promo_tbl").append(`<tr>
    <td>
    <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="promo_slno[]" >
  </td>
<td>
  <input type="hidden" class="form-control" name="promotion_sql_id[]">
<input type="text" class="form-control width" name="promo_order_no[]"></td>
<td><input type="date" class="form-control" name="promo_date[]"></td>
<td><input type="date" class="form-control" placeholder="13/03/2008" name="effect_date[]"></td>
<td>
<select class="form-control " onchange="promotion(${k})"  id="promotionid${k}" name="from_grade[]" style="width: 202px;">
   <option value="">--Select--</option>
       @foreach($pay_grade_view as $ky=>$val)
         <option value="{{$val->pay_grade_code}}">{{$val->pay_grade_code}}
        </option>
 @endforeach
</select>
</td>
<td><select class="form-control width"   name="from_design[]">
<option value="">--Select--</option>
                                    @foreach($Designation as $ky=>$val)
                                              <option value="{{$val->desg_code}}">{{$val->desg_name}}</option>
                                           @endforeach
</select></td>

<td><input type="text" class="form-control width" name="from_basic[]" id='catch_paygrade_value${k}' style="width: 202px; color: black"></td>
<td><input type="number"   class="form-control width" name="from_special[]" id="promtion_current_allowance${k}"  style="    width: 202px; color: black" ></td>
<td><input type="number"  class="form-control width" name="from_other_special[]"  id="promtion_currentother_allowance${k}" style="    width: 202px; color: black" ></td>
<td> <select class="form-control "  onchange="topromotion(${k})" id="promotiontoid${k}" name="to_grade[]" style="width: 202px;">
   <option value="">--Select--</option>
       @foreach($pay_grade_view as $ky=>$val)
         <option value="{{$val->pay_grade_code}}">{{$val->pay_grade_code}}
        </option>
 @endforeach
</select>
</td>
<td>
<select class="form-control width"   name="to_portion[]" onchange="portionDropdown(${k})"  id="portionDropdownid${k}">
<option value="">--Select--</option>
                                    @foreach($Designation as $ky=>$val)
                                              <option value="{{$val->desg_code}}">{{$val->desg_name}}</option>
                                           @endforeach
</select></td>
<td><input type="text" class="form-control width" name="to_basic[]" id='catch_topaygrade_value${k}' style="    width: 202px; color: black" ></td>
<td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width" name="total_allow[]" id="promtion_tocurrent_allowance${k}"  style="    width: 202px; color: black" ></td>
<td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width" name="to_other_allowance[]" id="promtion_tocurrentother_allowance${k}" style="    width: 202px; color: black" ></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remark[]"></textarea></td>
<td><input type="file" style="width: 215px;" accept="image/png, image/gif, image/jpeg" name="upload_promo[]"></td>
<td></td>
<td></td>
<td><button type="button" style="background-color: #7d98da">X</button></td>
</tr>`);
});

var i=20;
$("#add_newprobation").click(function () { 
  // onchange="probation(${i})" 
  i++;
  $("#probationtable").append(`<tr>
    <td>
        <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="prob_slno[]"  >
      </td>    
<td>
  <input type="hidden" name="prob_sqli_id[]">
<input type="text" class="form-control width" name="prob_order[]"></td>
<td><input type="date" class="form-control"  name="prob_order_date[]"></td>
<td><input type="date" class="form-control"   name="prob_start[]"></td>
<td><input type="date" class="form-control"    name="prob end[]"></td>
<td>
<select class="form-control " id="probationid${i}" name="pay_grade1[]" style="width: 202px;">
   <option value="">--Select--</option>
       @foreach($pay_grade_view as $ky=>$val)
         <option value="{{$val->pay_grade_code}}">{{$val->pay_grade_code}}
        </option>
 @endforeach
</select></td>
<td><input type="number" class="form-control width2" name="initial[]" id="promotion_catch_topaygrade_value${i}" style="width: 219px;"></td>
<td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="special_allowance[]"id="probation_current_allowance${i}"  ></td>
<td><input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control width2" name="other_allownace[]"id="probation_tocurrentother_allowance${i}" ></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remark_prob[]"></textarea></td>
<td><input type="file" style="width: 215px;" accept="image/png, image/gif, image/jpeg" name="prob_upload[]"></td>
<td></td>
<td></td>
<td><button type="button" class="deletebtn" style="background-color: #7d98da">X</button></td>
</tr>`);

}); 
    // revocation
    $(document).ready(function () {

// Denotes total number of rows
var rowIdx = 0;

// jQuery button click event to add a row
$('#add_new_revocation').on('click', function () {

// Adding a row inside the tbody.
$('#maintable_dependent_revocation').append(`<tr id="R${++rowIdx}">
<p>Row ${rowIdx}</p>

<td>
  <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="revo_slno[]" >
</td>
<td>
  <input type="hidden" class="form-control" name="revocation_sql_id[]">

<input type="text" class="form-control width" name="revo_order_no[]"></td>
<td><input type="date" class="form-control width"   name="revo_order_date[]"></td>
<td><select class="form-control width" name="ant_ord_no[]">
  <option value="">--select--</option>
      @foreach($antecendent_fetch as $ky=>$val)
        <option value="{{$val->id}}">{{$val->order_no}}</option>
      @endforeach
</select></td>
<td><select class="form-control width" name="ant_ord_dat[]">
  <option value="">--select--</option>
      @foreach($antecendent_fetch as $ky=>$val)
@if(!$val->order_date=="")
        <option value="{{$val->order_date}}">{{$val->order_date}}</option>
@endif
      @endforeach
</select></td>
<td><select class="form-control width" name="ant_ord_type[]">
  <option value="">--select--</option>
   <option>Explanation</option>
        <option>Termination</option>
        <option>Warning</option>
        <option>Salary Deduction</option>
        <option>Demotion</option>
        <option>Charge Sheet</option>
        <option>Suspension</option>
        <option>Others</option>
    </select>
</select></td>
<td><select class="form-control width" name="ant_WEF[]">
  <option value="">--select--</option>
      @foreach($antecendent_fetch as $ky=>$val)
      @if(!$val->WEE_date=="")
        <option value="{{$val->WEE_date}}">{{$val->WEE_date}}</option>
        @endif  
      @endforeach
</select></td>
<td><select class="form-control width" name="ant_WET[]">
  <option value="">--select--</option>
      @foreach($antecendent_fetch as $ky=>$val)
      @if(!$val->WET_date=="")
        <option value="{{$val->WET_date}}">{{$val->WET_date}}</option>
        @endif
      @endforeach
</select></td>
<td><input type="date" class="form-control" name="revo_effected_date[]" ></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="revo_remark[]"></textarea></td>
   <td><input type="file" style="width: 215px;" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="revocation_upload[]"></td>
   <td></td>
   <td></td>
<td><button type="button" class="deletebtn" title="Remove row" 
style="background-color: #7d98da">X</button></td>

</tr>`
);
});

// jQuery button click event to remove a row.
$('#maintable_dependent_revocation').on('click', '.remove', function () {

// Getting all the rows next to the row
// containing the clicked button
var child = $(this).closest('tr').nextAll();

// Iterating across all the rows
// obtained to change the index
child.each(function () {

// Getting <tr> id.
var id = $(this).attr('id');

// Getting the <p> inside the .row-index class.
var idx = $(this).children('.row-index').children('p');

// Gets the row number from <tr> id.
var dig = parseInt(id.substring(1));

// Modifying row index.
idx.html(`Row ${dig - 1}`);

// Modifying row id.
$(this).attr('id', `R${dig - 1}`);
});


});
});  
//contract
$(document).ready(function () {

// Denotes total number of rows
var rowIdx = 0;
// onkeypress="return event.charCode >= 48 && event.charCode <= 57"
// jQuery button click event to add a row
$('#add_new_contract').on('click', function () {

// Adding a row inside the tbody.
$('#tbody_contract').append(`<tr id="R${++rowIdx}">
<p>Row ${rowIdx}</p>
<td>
  <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="cont_slno[]"  >
</td> 
<td>
<input type="hidden"  name="contract_sqli_id[]"  class="form-control" >
<input type="text" class="form-control width" name="cont_order[]"></td>
<td><input type="date" class="form-control" name="cont_order_date[]"></td>
<td><input type="date" class="form-control"   name="cont_start_date[]"></td>
<td><input type="date" class="form-control"   name="cont_end_date[]"></td>
<td><input type="number"  class="form-control width2" name="con_pay[]"></td>
<td><input type="number"   class="form-control width2" name="special[]"></td>
<td><input type="number"  class="form-control width2" name="other[]"></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remarks[]"></textarea></td>

<td><input type="file" style="width: 215px;" accept="image/png, image/gif, image/jpeg" name="cont_file[]"></td>
<td></td>
<td></td>
<td><button type="button" class="deletebtn" title="Remove row" 
style="background-color: #7d98da">X</button></td>


</tr>`
);
});

// jQuery button click event to remove a row.
$('#tbody_contract').on('click', '.remove', function () {

// Getting all the rows next to the row
// containing the clicked button
var child = $(this).closest('tr').nextAll();

// Iterating across all the rows
// obtained to change the index
child.each(function () {

// Getting <tr> id.
var id = $(this).attr('id');

// Getting the <p> inside the .row-index class.
var idx = $(this).children('.row-index').children('p');

// Gets the row number from <tr> id.
var dig = parseInt(id.substring(1));

// Modifying row index.
idx.html(`Row ${dig - 1}`);

// Modifying row id.
$(this).attr('id', `R${dig - 1}`);
});


});
});
$(document).ready(function () {
  
      // Denotes total number of rows
      var rowIdx = 0;
  
      // jQuery button click event to add a row
      $('#add_new7').on('click', function () {
  
        // Adding a row inside the tbody.
        $('#tableintiation').append(`<tr id="R${++rowIdx}">
                 <p>Row ${rowIdx}</p>

                 <td>
    <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="intiation_slno[]"  >
  </td>                 
<td><input type="hidden" class="form-control" name="intiation_sql_id[]">

<input type="date" class="form-control width"   name="initiative_date[]"></td>
<td><select class="form-control width" name="inti_type[]">
    <option>--select--</option>
    <option>Cost Saving</option>
    <option>Process Improvemnt</option>
 
</select></td>

<td><textarea rows="3" cols="40" class="form-control"  name="inti_description[]" style="width:200px;"></textarea></td>

<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="inti_remark[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="Initiative_upload[]" style="width: 215px;"></td>
<td></td>
<td></td>        
<td><button type="button" class="deletebtn" title="Remove row" 
style="background-color: #7d98da">X</button></td>
</tr>`
              );
      });
  
      // jQuery button click event to remove a row.
      $('#tableintiation').on('click', '.remove', function () {
  
        // Getting all the rows next to the row
        // containing the clicked button
        var child = $(this).closest('tr').nextAll();
  
        // Iterating across all the rows 
        // obtained to change the index
        child.each(function () {
  
          // Getting <tr> id.
          var id = $(this).attr('id');
  
          // Getting the <p> inside the .row-index class.
          var idx = $(this).children('.row-index').children('p');
  
          // Gets the row number from <tr> id.
          var dig = parseInt(id.substring(1));
  
          // Modifying row index.
          idx.html(`Row ${dig - 1}`);
  
          // Modifying row id.
          $(this).attr('id', `R${dig - 1}`);
        });
  
  
      });
    }); 
    //probation 



    $(document).ready(function () {
  
      // Denotes total number of rows
      var rowIdx = 0;
  
      // jQuery button click event to add a row
      $('#add_new8').on('click', function () {
  
        // Adding a row inside the tbody.
        $('#tableachievemnt').append(`<tr id="R${++rowIdx}">
                 <p>Row ${rowIdx}</p>
                 <td>
        <input type="number" class="form-control td2" onkeypress="return isNumberKey(event)" name="achievement_slno[]"  >
      </td>                 
<td><input type="hidden" class="form-control" name="Achievement_sql_id[]">

<input type="date" class="form-control width"   name="achievement_date[]"></td>
<td><select class="form-control width" name="achievement_type[]">
    <option>--select--</option>
    <option>Cost Saving</option>
    <option>Process Improvemnt</option>
 
</select></td>

<td><input type="text" class="form-control width"  name="achievement_period[]"></td>

<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="achievement_remark[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="achievement_upload[]" style="width: 215px;"></td>
<td></td>
<td></td>
<td><button type="button" class="deletebtn" title="Remove row" 
style="background-color: #7d98da">X</button></td>
</tr>`
              );
      });
  
      // jQuery button click event to remove a row.
      $('#tableachievemnt').on('click', '.remove', function () {
  
        // Getting all the rows next to the row
        // containing the clicked button
        var child = $(this).closest('tr').nextAll();
  
        // Iterating across all the rows 
        // obtained to change the index
        child.each(function () {
  
          // Getting <tr> id.
          var id = $(this).attr('id');
  
          // Getting the <p> inside the .row-index class.
          var idx = $(this).children('.row-index').children('p');
  
          // Gets the row number from <tr> id.
          var dig = parseInt(id.substring(1));
  
          // Modifying row index.
          idx.html(`Row ${dig - 1}`);
  
          // Modifying row id.
          $(this).attr('id', `R${dig - 1}`);
        });
  
  
      });
    }); 
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

 $(document).on('click', 'button.deletebtn', function () {
     $(this).closest('tr').remove();
     return false;
 });
</script>

 


<script type = "text/javascript">
$('#input-payment-egn').keyup(function(e){
  if($(this).val().length === 10){
    e.preventDefault();
    $('#wrong-egn').slideUp();
  } else {
    $('#wrong-egn').slideDown();
  }     
});
$('#input-payment-egn1').keyup(function(e){
  if($(this).val().length === 10){
    e.preventDefault();
    $('#wrong-egn1').slideUp();
  } else {
    $('#wrong-egn1').slideDown();
  }     
});
$('#input-payment-egn3').keyup(function(e){
  if($(this).val().length === 12){
    e.preventDefault();
    $('#wrong-egn3').slideUp();
  } else {
    $('#wrong-egn3').slideDown();
  }   
});
$('#input-payment-egn2').keyup(function(e){
  if($(this).val().length === 12){
    e.preventDefault();
    $('#wrong-egn2').slideUp();
  } else {
    $('#wrong-egn2').slideDown();
  }   
});


</script>



<script>
                 

$(document).ready(function(){
$("#myInput").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#myTable tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});

    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{url('/')}}/public/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{url('/')}}/public/bootstrap/js/popper.min.js"></script>
    <script src="{{url('/')}}/public/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/public/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{url('/')}}/public/assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{url('/')}}/public/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="plugins/table/datatable/datatables.js"></script>
    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        });
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="{{url('/')}}/public/plugins/dropify/dropify.min.js"></script>
    <script src="{{url('/')}}/public/plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="{{url('/')}}/public/assets/js/users/account-settings.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous">
 </script>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
</body>
</html>

                 

@endsection