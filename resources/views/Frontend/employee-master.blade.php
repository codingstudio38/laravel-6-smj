


@extends('Frontend.footer')

@extends('Frontend.inner_master') 

@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/plugins/table/datatable/dt-global_style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />

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
#wrong-egn1{
  display: none;
  font-size: 12px;
  color: red;
}
#wrong-egn2{
  display: none;
  font-size: 12px;
  color: red;
}
#wrong-egn3{
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
        padding: 4px;
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

        <!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
<div class="layout-px-spacing">                

<div class="account-settings-container layout-top-spacing">

<div class="account-content">
<div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
<form onsubmit="return form_validation()" id="general-info" class="section general-info"
 action="{{url('/')}}/add-employee-master" id="rgform" method="post" enctype="multipart/form-data">
<div class="form-group" style="text-align: right;color: white;" >
                          <button type="submit" id="submit-btn" class="btn btn button1"
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

    
{!! csrf_field() !!}  

    <div class="info">

    <h6 class="">EMPLOYEE MASTER</h6>

    <div class="row">
    <div class="col-lg-11 mx-auto">
        <div class="row">
             <div class="col-xl-2 col-lg-12 col-md-4">
                <div class="upload mt-4" >
                    <input type="file" accept="image/png, image/gif, image/jpeg" id="input-file-max-fs" class="dropify" data-default-file="{{url('/')}}/public/assets/img/download.jpg" data-max-file-size="2M"  name="image" />
                    <!-- <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> </p> -->
                </div>
            </div>

            <div class="col-xl-10 col-lg-10 col-md-10 mt-md-0 mt-4">
            
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="fullName">Employee List</label><br>
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target=".bd-example-modal-xl">List</button>
                            </div>
                        </div>
                       
                        <div class="col-sm-6 ">
                            <label class="dob-input">Active Type<span class="employeemaster">*</span></label>
                      
                                <div class="form-group mr-1" >
                                    <select class="form-control" id="exampleFormControlSelect1" name="type" onchange="showfield(this.options[this.selectedIndex].value)" required>
                                      <option value="A">Active</option>
                                      <option value="I">Inactive</option>
                         
                                    </select>
                                  <div class="form-group mt-2">
                                     <div class="row">
                                       <div class="col-6 r_class " style="display: none">
                                          <select class="form-control" name="inactive_reason" id="reason" >
                                             <option value="">select</option>
                                            <option value="Superannuation">Superannuation</option>
                                            <option value= "Resignation">Resignation</option>
                                            <option value= "Termination">Termination</option>
                                            <option value= "Death">Death</option>
                                            <option value= "Illness">Illness</option>
                                            <option value= "Others">Others</option>
                                          </select>
                                       </div>
                                       <div class="col-6 r_class"  style="display: none">
                                          <input type="text" class="form-control"  name="inactive_date"  value="{{date('d-m-Y')}}" id="r_dob">
                                       </div>
                                       <div class="col-12 r_class" style="display: none">
                                         <textarea  class="form-control" id="r_txtReason" name="reason_desc" rows="2" cols="54" placeholder="describe your reason"></textarea>
                                       </div>
                                     </div>
                                  </div>
                                  </div>
                           </div>


                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="fullName">Employee Name<span class="employeemaster">*</span></label>
                                <input type="text" class="form-control" name="emp_name"  value="" required="" id="emp_name"/>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="fullName">Employee Code<span class="employeemaster">*</span></label>
                                <input type="text" class="form-control" name="emp_code"   value="" required id="emp_code">

                            </div>
                        </div>


                         <div class="col-sm-4">
                            <div class="form-group">
                                <label for="fullName">Department<span class="employeemaster">*</span></label>
                             <select class="form-control" name="department" id="selectdepartment"required>
                                      <option value="">select</option>
                                           @foreach($Department_fetch as $ky=>$val)
                                              <option value="{{$val->dept_no}}">{{$val->dept_name}}</option>
                                           @endforeach
                                      </select>
                            </div>
                        </div>


                         <div class="col-sm-4">
                            <div class="form-group">
                                <label for="fullName">Employeement Type<span class="employeemaster">*</span></label>
                                <select class="form-control" id="emp_type" name="emp_type"required>

                                       <option value="">select</option>
                                @foreach($Employee_type_fetch as $ky=>$val)
                                              <option value="{{substr($val->employee_type_name, 0, 2)}}">{{$val->employee_type_name}}</option>
                                           @endforeach>
                                        
                         
                                    </select>

                            </div>
                        </div>




                          <div class="col-sm-4">
                            <div class="form-group">
                                <label for="fullName">Designation<span class="employeemaster">*</span></label>
                                <select class="form-control" id="selectdesignation" name="designation"required>
                                       <option value="">select</option>
                                    @foreach($Designation as $ky=>$val)
                                              <option value="{{$val->desg_code}}">{{$val->desg_name}}</option>
                                           @endforeach
                                    </select>

                            </div>
                        </div>



                         <div class="col-sm-4">
                            <div class="form-group">
                                <label for="fullName">Category<span class="employeemaster">*</span></label>
                                <select class="form-control" id="category" name="category" required>
                                  <option value="">select</option>
                                @foreach($Category_fetch as $ky=>$val)
                                              <option value="{{$val->category_code}}">{{$val->category_name}}</option>
                                           @endforeach
                                    </select>

                            </div>
                        </div>
                            <div class="col-sm-4">
                            <div class="form-group">
                                <label for="fullName">Workplace<span class="employeemaster">*</span></label>
                                <select class="form-control" id="selectWorkplace" name="workplace"required>
                                    <option value="">select</option>
                                       @foreach($Workplace_fetch as $ky=>$val)
                                              <option value="{{$val->id}}">{{$val->workplace_name}}</option>
                                           @endforeach
                         
                                    </select>


                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="fullName">Date Of Birth<span class="employeemaster">*</span></label>
                                <input   type='date' class="form-control" id="DOB"  name="DOB" required >
                               

                            </div>
                        </div>
     <div class="col-sm-3">
                            <div class="form-group">
                                <label for="fullName">Date Of Joining<span class="employeemaster">*</span></label>
                                <input type="date" class="form-control" id="DOJ" name="DOJ" value="{{date('d-m-Y')}}" required>

                            </div>
                        </div>
   
                           <div class="col-sm-3">
                            <div class="form-group">
                                <label for="fullName">Date Of Probation<span class="employeemaster" id="dop_div"></span></label>
                                <input type="date" class="form-control" id="DOP" name="DOP" value="{{date('d-m-Y')}}"required  >

                            </div>
                        </div>
                           <div class="col-sm-3">
                            <div class="form-group">
                                <label for="fullName">Date of Confirmation<span class="employeemaster" id="doc_div"></span></label>
                                <input type="date" class="form-control" id="DOC" name="DOC"  value="{{date('d-m-Y')}}"   >
                          </div>
                                </div>
                    <div class="col-sm-3">
                            <div class="form-group">
                                <label for="fullName">Retirement Date<span class="employeemaster" id="retire_div"></span></label>
                                <input type="date" class="form-control" id="retirement_date" name="retirement_date"  value="{{date('d-m-Y')}}"  >
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
var DOP = document.getElementById('DOP');
var DOC = document.getElementById('DOC');
var retirement = document.getElementById('retirement_date');

var dop_div = document.getElementById('dop_div');
var doc_div = document.getElementById('doc_div');
var retire_div = document.getElementById('retire_div');

emp_type.onchange = function(){
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

// DOP.onchange = function(){
//     if(emp_type.value=="CO"){
//         DOP.removeAttribute("required");
//         dop_div.innerHTML="";
//     } else {
//         DOP.setAttribute("required", "required");
//         dop_div.innerHTML="*";
//     }
// } 
     
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
                                            <a class="nav-link active" id="border-home-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="border-home" aria-selected="true"> OFFICIAL DETAILS</a>
                                        </li>
                                      
                                        <li class="nav-item">
                                            <a class="nav-link" id="border-profile-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="border-profile" aria-selected="false"> PERSONNEL DETAILS</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="border-contact" aria-selected="false"> DEPENDENT</a>
                                        </li>
<!--                                                               <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="border-contact" aria-selected="false"> NOMINEE</a>
                                        </li> -->
                                                              <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="border-contact" aria-selected="false"> QUALIFICATION</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab5" role="tab" aria-controls="border-contact" aria-selected="false">EXPERIENCE</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab6" role="tab" aria-controls="border-contact" aria-selected="false"> TRANSFER</a>
                                        </li>

                                         <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab7" role="tab" aria-controls="border-contact" aria-selected="false"> PROMOTION</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab8" role="tab" aria-controls="border-contact" aria-selected="false"> PROBATION</a>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab9" role="tab" aria-controls="border-contact" aria-selected="false"> CONTRACT</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab10" role="tab" aria-controls="border-contact" aria-selected="false"> ANTECEDENT</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab11" role="tab" aria-controls="border-contact" aria-selected="false"> REVOCATION</a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab12" role="tab" aria-controls="border-contact" aria-selected="false">APPRECIATION</a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab13" role="tab" aria-controls="border-contact" aria-selected="false"> REWARD </a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab14" role="tab" aria-controls="border-contact" aria-selected="false"> INITIATION</a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab15" role="tab" aria-controls="border-contact" aria-selected="false"> ACHIEVEMENT</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#tab16" role="tab" aria-controls="border-contact" aria-selected="false"> REMARK</a>
                                        </li>
                                    </ul>
                <div class="tab-content p-sec" id="border-tabsContent">
 <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="border-home-tab">

    <div class="col-lg-12">
      <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-4">Pay Scale Details</h4>
         </div>
      

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="fullName"> Grade</label>

                                        <select class="form-control"     id="packageid"  name="pay_grade_code_hdn">
                                           <option value=0>--Select--</option>
                                           @foreach($pay_grade_view as $ky=>$val)
                                              <option value="{{$val->pay_grade_code}}">{{$val->pay_grade_code}}
                                              </option>
                                           @endforeach

                                      </select>
                               <!--       <input type="hidden" name="pay_grade_code_hdn" id="pay_grade_code_hdn"> -->
                                    
                                </div>
                            </div>

                        <div class="col-sm-2">
                                <div class="form-group">

                                    <label for="fullName">Pay Grade</label>
                                    <input type="text" class="form-control"   value="" name ="pay_grade" id='catch_value' style="font-size: 13px;color: black;" readonly="readonly">

                                </div>
                            </div>
                             <div class="col-sm-2">
                                <div class="form-group">

                                    <label for="fullName">PF A/C No</label>
                                    <input type="text" class="form-control" id="pfacct" value="" name="pf">

                                </div>
                            </div>

                        <div class="col-sm-2">
                                <div class="form-group">

                                    <label for="fullName">VPF %</label>
                                    <input type="text" class="form-control" id="vperc_textbox" value="" name ="vpf" placeholder="Ex: 10.00">

                                </div>
                            </div>


                        <div class="col-sm-2">
                                <div class="form-group">

                                    <label for="fullName">ESI A/C No</label>
                                    <input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" maxlength="10" minlength="10"  class="form-control" id="esiacc" value="" name="esi">

                                </div>
                            </div>

                        <div class="col-sm-2">
                                <div class="form-group">

                                    <label for="fullName">PAN No</label>
                                    <input type="text" class="form-control"   value="" name="PAN">

                                </div>
                            </div>


                       

                            

                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                  
                                        <label for="fullName">Initial Basic</label>
                                        <input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control"   value="" name="intial_basic" id="intial_basic" >
                                  
                                    </div>
                                    </div>
                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullName">Initial PP1</label>
                                            <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"  name="initial_pp1" id="initial_pp1">
                                          </div>

                                    </div>
                                </div>
                            </div>
                       
                            <div class="col-sm-4">
                                <div class="row">
                                  <div class="col-md-4">
                                    
                                    <div class="form-group">
                                        <label for="fullName">Initial PP2</label>
                                        <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="initial_pp2" id="initial_pp2">
                                    </div>
                                  </div>
                                 
                                  <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="fullName">Initial Special Allowance</label>
                                        <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="initial_allowance" class="form-control"   name ="intial" style="font-size: 13px;color: black;" >
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <div class="form-group">
                              
                                    <label for="fullName">Initial Other Allowance</label>
                                    <input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control"   value="" name="initial_other" id="initial_other" style="font-size: 13px;color: black;">
                              
                                </div>
                              </div>
                             
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="fullName">Current Basic</label>
                        <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"   value="" name="current_basic" id="current_basic">
                    </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullName">Current PP1</label>
                            <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"   name="pp1" id="pp1">
                        </div>   
                    </div>
                </div>
                </div>
                              
                <div class="col-sm-4">
                    <div class="row">
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="fullName">Current PP2</label>
                        <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="pp2" id="pp2">
                    </div>
                      </div>
                  
                      <div class="col-md-8">
                        <div class="form-group">
                            <label for="fullName">Current  Special Allowance</label>
                            <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"   value="" 
                            id="current_allowance" name ="current" style="font-size: 13px;color: black;">
                        </div>
                        
                      </div>
                    </div>
                  </div>     
                  <div class="col-sm-4">
                    <div class="form-group">
                        <label for="fullName">Current Other Allowance</label>
                        <input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control"   value="" name="current_other" id="cuurent_other" style="font-size: 13px;color: black;">
                    </div>
                  </div>       
                            

                              
                  
                          
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullName">UAN</label>
                                            <input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control"  id="uano" value=""  name="uan" >
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullName">Aadhaar No</label>
                                             <input type="text" maxlength="12" minlength="12" name="adhar"  value="" id="input-payment-egn3" class="form-control" />
                                            <div id="wrong-egn3">Please provide 12 digit  Aadhaar Number.</div>
                                         </div>
                                    </div>
                                  </div>
                              </div>

                              <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="fullName">Contract Salary</label>
                                    <input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control"  id="CONT_SAL" name="CONT_SAL" >
                                </div>
                              </div>

                              <div class="col-sm-2">
                                <div class="form-group">
                               <label for="fullName">PF Deduction</label><br>
                                     <label class="radio-inline">
                                          <input type="radio" name="optradio" value="Y"> Yes
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="optradio" checked value="N"> No
                                        </label>
   

                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">

                                    <label for="fullName">ESI Deduction</label><br>
                                    <label class="radio-inline">
                                          <input type="radio" name="optradio1" value="Y"> Yes
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="optradio1" checked value="N"> No
                                        </label>

                                </div>
                            </div>



                            <div class="user-info">
                               
                                    
                           </div>
             
                          </div>

                        </div>

       <div class="col-lg-12"> 
      <div class="row b-sec">
   <div class="col-lg-6 "> 
    <div class="card component-card_4">
            <div class="card-body">
              
                <div class="user-info">
                    <h5 class="card-user_name" style="font-size: 25px;">Bank Details</h5>
                      <div class="col-sm-12">
                                <div class="form-group">

                                    <label for="fullName">Payment Mode </label>
                                    <input type="text" class="form-control"   value="" name="payment_bank_mode" id="current_basic">

                                </div>
                            </div>
               
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="fullName">Bank: </label>
                                       <lable for="fullName" id="bank"></lable>
                                    <!--  <input type="text" class="form-control"   value="" name="bank_name" id="current_basic"> -->
  <select class="form-control"     id=""  name="bank_name">
                                           <option value=0>--Select--</option>
                                           @foreach($Bank_view as $ky=>$val)
                                              <option value="{{$val->bank_code}}">{{$val->bank_name}}
                                              </option>
                                           @endforeach

                                      </select>
                                </div>
                              </div>
                               <div class="col-sm-12">
                                <div class="form-group">

                                    <label for="fullName">Bank A/C No: </label>
                                    <lable for="fullName" id="bank"></lable>
                                    <input type="text" class="form-control"   value="" \
                                    name="account_num" id="current_basic">

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
                    <h5 class="card-user_name" style="font-size: 25px;">Increment Details</h5>
                                      <div class="col-sm-12">
                                      <div class="form-group">
                                    <label for="fullName">Increment Due Date :</label>
                                   <lable for="fullName" id="bank"> </lable>
                                    <input type="date" class="form-control"   value="" name="incr_date"  >
                                 </div>

                                </div>
                                   <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="fullName">Increment Amount: </label>
                                       <lable for="fullName" id="bank"></lable>
                                       <input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control"   value="" name="incr_amount" id="current_basic">
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
    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="border-profile-tab">
    <div class="col-lg-12 emp-sec">
    <div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label for="fullName">Gender</label><br>
            <input type="radio"  name="sex" value="M" checked>
            <label for="vehicle1">Male</label>&nbsp;&nbsp;
            <input type="radio" name="sex" value="F">
            <label for="vehicle1">Female</label>

        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="fullName">Marital Status</label>
             <select class="form-control" name="marital" id="ddlModels">
              <option value="">select</option>
            <option value="M" onclick="married()">Married</option>
            <option value="U" onclick="Unmarried()">UnMarried</option>
            </select>
        </div>
    </div>


                                              
    <div class="col-sm-3">
        <div class="form-group">
            <label for="fullName">Blood Group</label>
            <select class="form-control" name="blood">
              <option value="">select</option>
                <option value="O+">O+</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B-">B-</option>
                <option value="B+">B+</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O-">O-</option>
            </select>
        </div>
    </div>
   <div class="col-sm-4">
      <div class="form-group">
        <label for="fullName">Identification Mark</label>
        <input type="text" class="form-control" name="id"   value="">

      </div>
   </div>
                                 
   <div class="col-sm-2">
      <div class="form-group">
        <label for="fullName">Spouse Name</label>
        <input type="text" class="form-control" name="spouse"  id="spouseName"  value="">

       </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="fullName">Spouse's Date Of Birth</label>
            <input type="date" class="form-control" name="spouse_dob" 
           >
        </div>
    </div>

    <div class="col-sm-2">
       <div class="form-group">
        <label for="fullName">Father Name</label>
        <input type="text" class="form-control" name="father"   value="">
        </div>
   </div>


 <div class="col-sm-2">
        <div class="form-group">

            <label for="fullName">Father's Date Of Birth</label>
            <input type="date" class="form-control" name="father_dob"   
            value="{{date('d-m-Y')}}" >

        </div>
 </div>

 <div class="col-sm-2">
        <div class="form-group">

            <label for="fullName">Mother Name</label>
            <input type="text" class="form-control" name="mother"   value="">

        </div>
    </div>


    <div class="col-sm-2">
            <div class="form-group">

                <label for="fullName">Mother's Date Of Birth</label>
                <input type="date" class="form-control" name="mother_dob"  >

            </div>
    </div>

 <div class="col-sm-3">
    <div class="form-group">

        <label for="fullName">Present Address</label>
        <input type="text" class="form-control"  placeholder="line1"  name="line_11" value="">
        <input type="text" class="form-control" placeholder="line2" name="line_22"  value="">
        <input type="text" class="form-control" placeholder="line3" name="line_33"  value="">

    </div>
</div>

 <div class="col-sm-3">
    <div class="form-group">

        <label for="fullName">Permanent Address</label>
        <input type="text" class="form-control"  placeholder="per_line1" name="per_line1" value="">
        <input type="text" class="form-control" placeholder="per_line2" name="per_line2"  value="">
        <input type="text" class="form-control" placeholder="per_line3" name="per_line3"  value="">

    </div>
</div>



 <div class="col-sm-3">
    <div class="form-group">
        <label for="fullName">Contact No</label><br>

<input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" maxlength="" name="contactnumber"  placeholder="contact no" id="input-payment-egn" class="form-control"/>
<div id="wrong-egn">Please provide 10digit number.</div>
</div>
</div>
 <div class="col-sm-3">
    <div class="form-group">
        <label for="fullName">Email</label><br>
        <input type="email"  id="email"  class="form-control" value="" name="email">
    </div>
</div>
</div>
</div>
</div>
<div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_new">ADD NEW</div>
<div class="tableFixHead">

<table class="table table-bordered table-hover e-table" id="maintable">
<thead class="e-head">
<tr>
<th>Sl No</th>
<th>Dependent Name:<span class="employeemaster" style="font-size: 20px">*</span></th>
<th>Type</th>
<th>Date Of Birth:</th>
<th>Age:</th>
<th>Relationship:</th>
<th>Aadhaar No:</th>
<th>Address</th>
<th>Upload Adhara</th>
<th>Cancel</th>
</tr>
</thead>
<tbody id="e-body">

@for ($i=0;$i<5;$i++)
<tr>
<td><input type="number"  onkeypress="return isNumberKey(event)" class="form-control td1" name="depend_snno[]" id="depend_snno{{ $i }}"  ></td>
<td class="td2"><input type="text" class="form-control width" name="name[]" placeholder=""  ></td>
<td><select class="form-control" name="dependent_type[] "style="width: 124px" id="one{{$i}}" onchange="nominee_select(this.value,{{$i}})" >
    <option value="Dependent">Dependent</option>
    <option value="Nominee" >Nominee</option></select></td>
<td><input type="date" class="form-control width" name="dob1[]" id="dob_{{ $i }}" onchange="check_age('dob_{{ $i }}','age_{{ $i }}','{{ $i }}')" placeholder="enter DOB" ></td>
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control  td1" id="age_{{ $i }}" readonly  name="age[]" ></td>
<td class="td2"><input type="text" class="form-control width" name="relation[]" placeholder="enter your relation"></td>
<td  class="td2"><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control width" name="num[]" placeholder="enter adhara"  ></td>
<td><textarea rows="3" cols="40" class="form-control"  name="dependent_addr[]" style="width:200px;"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="dependent_file[]" multiple></td>

<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>

</tr>
@endfor

</tbody>
</table>
</div>


</div>
</div> 

<!-- <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="border-profile-tab">
<div class="col-lg-12 emp-sec">

</div>
</div> --> 


<div class="tab-pane fade show" id="tab4" role="tabpanel" aria-labelledby="border-home-tab">
    <div class="col-lg-12 emp-sec">
      <div class="row">
        <div class="col-sm-6" style="margin-right: 520px;">
<h4 class="mb-4">Academic</h4>
</div>
  <div class="col-lg-1 new" id="add_newqualification" >ADD NEW</div>
        </div>
         
        <div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="tableFixHead">
<table class="table table-bordered table-hover" id="new_qualification">
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
<th>Cancel</th>
</tr>
</thead>

<tbody>

@for ($i=0;$i<5;$i++)
<tr>

<td>
    <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="academic_snno[]" id="academic_snno{{ $i }}"  >
</td> 
<td>
    <input type="hidden" class="form-control width" placeholder="" value="A" name="type_qual[]">  
    <select class="form-control width" name="academic[]">
  <option value="">select</option>
     @foreach($qualification_level_mst as $ky=>$val)
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
                <option value="P">Pass</option>
                <option value="F">First</option>
                <option value="S">Second</option>
                <option value="T">Third</option>
             
            </select></td>
<td><textarea rows="3" cols="40" class="form-control"  name="remark_qualification[]" style="width:200px;"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="" name="qualification_file[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor


</tbody>
</table>
</div>
     

</div>
</div>
   <div class="col-lg-12 emp-sec">
      <div class="row">
        <div class="col-sm-6" style="margin-right: 520px;">
<h4 class="mb-4" value="T">Technical/Professional</h4>
</div>
  <div class="col-lg-1 new" id="add_newtechnicalqualification" >ADD NEW</div>
        </div>
         
        <div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="tableFixHead">
<table class="table table-bordered table-hover" id="new_technicalqualification">
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
<th>Cancel</th>
</tr>
</thead>

<tbody>

@for ($i=0;$i<5;$i++)
<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="academic_snno[]" id="academic_snno{{ $i }}"  >
    </td> 
<td>
    <input type="hidden" class="form-control width" placeholder="" value="T" name="type_qual[]">
    <select class="form-control width" name="academic[]">
  <option value="">select</option>
     @foreach($qualification_level_mst as $ky=>$val)
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
<td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="" name="qualification_file[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor


</tbody>
</table>
</div>
     

</div>
</div>
</div>


<div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_newexperience">ADD NEW</div>

<div class="tableFixHead">
<table class="table table-bordered table-hover" id="tablexperience">
<thead>
<tr>
<th>Sl No</th>
<th>Organisation Name <span class="employeemaster" style="font-size: 20px">*</span></th>
<th>Sector:</th>
<th>Position:</th>
<th>From Date:</th>
<th>To Date:</th>
<th>Reason For Leave</th>
<th>Remark</th>
<th>Upload Document:</th>
<th>Cancel</th>
</tr>
</thead>
<tbody>

@for ($i=0;$i<5;$i++)
<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="experience_snno[]"   >
    </td>
<td><input type="text" class="form-control" placeholder=""  name="orgn[]" style="width: 255px;"></td>
<td><input type="text" class="form-control width2" placeholder="" name="sect[]"></td>
<td><input type="text" class="form-control width2" placeholder="" name="pos[]"></td>
<td><input type="date" class="form-control width2" placeholder="enter date" name="from[]"></td>
<td><input type="date" class="form-control width2" placeholder="enter date"  name="to[]"></td>
<td><textarea rows="3" cols="40" class="form-control"  name="area[]" style="width:200px;"></textarea></td>
<td><textarea rows="3" cols="40" class="form-control"  name="remark_area[]" style="width:250px;"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="e_file[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor


</tbody>
</table>
</div>
     
</div>
</div>  

<div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_newtransferno">ADD NEW</div>

<div class="tableFixHead">
<table class="table table-bordered table-hover" id="table_transfer">
<thead>
<tr>
    <th>Sl No</th>
<th>Transfer Order No <span class="employeemaster" style="font-size: 20px">*</span></th>
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
<th>Cancel</th>


</tr>
</thead>
<tbody  id="table_transfer">

@for ($i=0;$i<5;$i++)
<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="transfer_snno[]" >
      </td>
<td><input type="text" class="form-control width" width="130px" name="trans_order[]"></td>
<td><input type="date"  class="form-control"   width="130px" name="transfer_ord_date[]"></td>
<td> <select class="form-control width" name="order_type[]" >
        <option value="Transfer">Transfer</option>
        <option value="Deputation">Deputation</option>
    </select></td>

<td><input type="date"  class="form-control"  name="from_date[]"></td>
<td><input type="date" class="form-control" name="to_date[]" ></td>
<td> <select class="form-control width"  name="f_dept[]">
<option value="">select</option>
     @foreach($Department_fetch as $ky=>$val)
    <option value="{{$val->dept_no}}">{{$val->dept_name}}</option>
        @endforeach
  </select>
</td>
<td><select class="form-control width" name="t_dept[]" onchange="transfer({{$i}})"  id="transferid{{$i}}">
<option value="">select</option>
     @foreach($Department_fetch as $ky=>$val)

    <option value="{{$val->dept_no}}">{{$val->dept_name}}</option>
        @endforeach
  </select></td>
<td><select class="form-control width" name="from_work[]">
<option value="">select</option>
@foreach($Workplace_fetch as $ky=>$val)

     <option value="{{$val->id}}">{{$val->workplace_name}}</option>
 @endforeach
</select></td>
<td><select class="form-control width" name="to_work[]"  onchange="transferWork({{$i}})"  id="transferWorkid{{$i}}">
<option value="">select</option>
@foreach($Workplace_fetch as $ky=>$val)
     <option value="{{$val->id}}">{{$val->workplace_name}}</option>
 @endforeach
</select></td>

<td> <select class="form-control width"   name="ord_rea[]">
        <option value="">select</option>
        <option>Reward</option>
        <option>Routine</option>
        <option>Displinary</option>
        <option>Other</option>
    </select></td>
<td><textarea rows="3" cols="40" class="form-control width" name="reamrks[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="trans_file[]" ></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>

</tr> 

@endfor


</tbody>
</table>
</div>
     
</div>
</div>
<div class="tab-pane fade" id="tab7" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_newpromotion">ADD NEW</div>
<div class="tableFixHead">
<table class="table table-bordered table-hover"  id="table_promotion">
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
<th>To Designation/Position</th>
<th>To Basicpay</th>
<th>To special allowance</th>
<th>To Other Allowance</th>
<th>Remark</th>
<th>Upload Document</th>
<th>Cancel</th>

</tr>
</thead>
<tbody id="promo_tbl">
@for ($i=0;$i<5;$i++)
<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="promo_slno[]"  >
      </td>
<td><input type="text" class="form-control width" name="promo_order_no[]"></td>
<td><input type="date" class="form-control" name="promo_date[]"></td>
<td><input type="date" class="form-control" placeholder="13/03/2008" name="effect_date[]"></td>
<td>
<select class="form-control " onchange="promotion({{$i}})"  id="promotionid{{$i}}" name="from_grade[]" style="width: 202px;">
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

<td><input type="text" class="form-control width" name="from_basic[]" id='catch_paygrade_value{{$i}}' style="    width: 202px;" ></td>
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control width3" name="from_special[]" id="promtion_current_allowance{{$i}}" ></td>
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control width3" name="from_other_special[]"  id="promtion_currentother_allowance{{$i}}" ></td>
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
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control width3" name="total_allow[]" id="promtion_tocurrent_allowance{{$i}}" ></td>
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control width3" name="to_other_allowance[]" id="promtion_tocurrentother_allowance{{$i}}" ></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remark[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="upload_promo[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor
</tbody>
</table>  
</div>
</div>
</div>  
<div class="tab-pane fade" id="tab8" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_newprobation">ADD NEW</div>
<div class="tableFixHead">
<table class="table table-bordered table-hover" >
<thead>
<tr>
    <th>Sl No</th>
<th>Probation Order No <span class="employeemaster" style="font-size: 20px">*</span></th>
<th>Probation Order Date:</th>
<th>Probation Start Date:</th>
<th>Probation End Date:</th>
<th>Pay Grade:</th>
<th>Initial Basic:</th>
<th>Special Allowance:</th>
<th>Other Allowance:</th>
<th>Remarks:</th>
<th>Upload Document:</th>
<th>Cancel</th>
</tr>
</thead>
<tbody id="probationtable">
@for ($i=0;$i<5;$i++)
<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="prob_slno[]"  >
      </td>
<td><input type="text" class="form-control width" name="prob_order[]"></td>
<td><input type="date" class="form-control"   name="prob_order_date[]"></td>
<td><input type="date" class="form-control"   name="prob_start[]"></td>
<td><input type="date" class="form-control"    name="prob_end[]"></td>
<td>
    {{-- onchange="probation({{$i}})"   --}}
<select class="form-control " id="probationid{{$i}}" name="pay_grade1[]" style="width: 202px;">
   <option value="">--Select--</option>
   @foreach($pay_grade_view as $ky=>$val)
         <option value="{{$val->pay_grade_code}}">{{$val->pay_grade_code}}
        </option>
 @endforeach
</select></td>
<td><input type="number" class="form-control width2" name="initial[]" id="promotion_catch_topaygrade_value{{$i}}"  style="width: 219px;"></td>
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control width2" name="special_allowance[]"id="probation_current_allowance{{$i}}"  ></td>
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control width2" name="other_allownace[]"id="probation_tocurrentother_allowance{{$i}}"   ></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remark_prob[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="prob_upload[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor


</tbody>
</table>    
</div> 
</div>
</div>  

<div class="tab-pane fade" id="tab9" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="addBtn1">ADD NEW</div>
<div class="tableFixHead">
<table class="table table-bordered table-hover" id="tablecontract">
<thead>
<tr>
    <th>Sl No</th>
<th>Contract Order No <span class="employeemaster" style="font-size: 20px">*</span></th>
<th>Contract Order Date:</th>
<th>Contract Start Date:</th>
<th>Contract End Date:</th>
<th>Consolidated Pay</th>
<th>Special Allowance</th>
<th>Other Allowance</th>
<th>Remarks:</th>
<th>Upload Document:</th>
<th>Cancel</th>
</tr>
</thead>
<tbody id="e-body1">

@for ($i=0;$i<5;$i++)
<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="cont_slno[]"  >
      </td>
<td><input type="text" class="form-control width" name="cont_order[]"></td>
<td><input type="date" class="form-control"   name="cont_order_date[]"></td>
<td><input type="date" class="form-control"   name="cont_start_date[]"></td>
<td><input type="date" class="form-control"   name="cont_end_date[]"></td>
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control width2" name="con_pay[]"></td>
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control width2" name="special[]"></td>
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control width2" name="other[]"></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remarks[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="cont_file[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor
</tbody>
</table> 
</div>    
</div>
</div>  
<div class="tab-pane fade" id="tab10" role="tabpanel" aria-labelledby="border-contact-tab" >
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_new1">ADD NEW</div>
<div class="tableFixHead">
<table class="table table-bordered table-hover" id="maintable1" width="50%" cellpadding="0" cellspacing="0" class="pdzn_tbl1" border="#729111 1px solid" >
<thead>
<tr>
    <th>Sl No</th>
<th>Order No <span class="employeemaster" style="font-size: 20px">*</span></th>
<th>Order Date</th>
<th>Type</th>
<th>W.E.F Date</th>
<th>W.E.T Date</th>
<th>Remarks</th>
<th>Uploads</th>
<th>Cancel</th>
</tr>
</thead>

<tbody>

@for ($i=0;$i<5;$i++)
<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="antecedent_slno[]"  >
      </td>    
<td><input type="text" class="form-control width" name="ante_order_no[]"></td>
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
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="antecedent_upload[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor


</tbody>
</table>   
</div>  
</div>
</div>  


<div class="tab-pane fade" id="tab11" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_new4">ADD NEW</div>
<div class="tableFixHead">
<table class="table table-bordered table-hover" id="tablerevocation">
<thead>
<tr>
    <th>Sl No</th>
<th>Revocation Order No <span class="employeemaster" style="font-size: 20px">*</span></th>
<th>Revocation Order Date:</th>
<th>Antecedent Order no:</th>
<th>Antecedent Order Date:</th>
<th>Antecedent Type:</th>
<th>Antecedent W.E.F date:</th>
<th>Antecedent W.E.T Date:</th>
<th>Revocation Effected date:</th>
<th>Remarks:</th>
<th>Uploads</th>
<th>Cancel</th>

</tr>
</thead>
<tbody>

@for ($i=0;$i<5;$i++)
<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="revo_slno[]"  >
      </td>
<td><input type="text" class="form-control width" name="revo_order_no[]"></td>
<td><input type="date" class="form-control width"   name="revo_order_date[]"></td>
<td><select class="form-control width" name="ant_ord_no[]">
  <option>--select--</option>
      @foreach($antecendent_fetch as $ky=>$val)
        <option value="{{$val->id}}">{{$val->order_no}}</option>
      @endforeach
</select></td>
<td><select class="form-control width" name="ant_ord_dat[]">
  <option>--select--</option> 
      @foreach($antecendent_fetch as $ky=>$val)
      @if(!$val->order_date=="")
        <option value="{{$val->order_date}}">{{$val->order_date}}</option>
       @endif
      @endforeach
</select></td>
<td><select class="form-control width" name="ant_ord_type[]">
  <option>--select--</option>
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
  <option>--select--</option>
      @foreach($antecendent_fetch as $ky=>$val)
      @if(!$val->WEE_date=="")
      <option value="{{$val->WEE_date}}">{{$val->WEE_date}}</option>
      @endif  
      @endforeach
</select></td>
<td><select class="form-control width" name="ant_WET[]">
  <option>--select--</option>
      @foreach($antecendent_fetch as $ky=>$val)
      @if(!$val->WET_date=="")
        <option value="{{$val->WET_date}}">{{$val->WET_date}}</option>
        @endif
      @endforeach
</select></td>
<td><input type="date" class="form-control" name="revo_effected_date[]" ></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="revo_remark[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="revocation_upload[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor




   </tbody>
 </table>    
</div> 
</div>
</div>                    

<div class="tab-pane fade" id="tab12" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_new5">ADD NEW</div>
<div class="tableFixHead">
<table class="table table-bordered table-hover"  id="tableappriciation">
<thead>
<tr>
    <th>Sl No</th>
<th>Order No  <span class="employeemaster" style="font-size: 20px">*</span></th>
<th>Order Date:</th>
<th>Appriciation Type:</th>
<th>Recommended By</th>
<th>Description</th>
<th>Remarks</th>
<th>Uploads</th>
<th>Cancel</th>
</tr>
</thead>
<tbody>

@for ($i=0;$i<5;$i++)
<tr>
    <td>
        <input type="number" class="form-control td1" name="app_slno[]"  onkeypress="return isNumberKey(event)">
      </td>
<td><input type="text" class="form-control width" name="app_order_no[]"></td>
<td><input type="date" class="form-control width"  name="app_order_date[]"></td>
<td><select class="form-control width" name="appreciation_type[]">
    <option>--select--</option>
    <option value="Cost-saving">Cost Saving</option>
    <option value="Process_Improvemnt">Process Improvemnt</option>
 
</select></td>
<td><input type="text" class="form-control width" name="recommended_by[]"></td>
<td><textarea rows="3" cols="40" class="form-control"  name="app_description[]" style="width:200px;"></textarea></td>

<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="app_remarks[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="appriciation_upload[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor




   </tbody>
 </table>   
</div> 
</div>
</div> 

<div class="tab-pane fade" id="tab13" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_new6">ADD NEW</div>
<div class="tableFixHead">
<table class="table table-bordered table-hover" id="tablereward">
<thead>
<tr>
    <th>Sl No</th>
<th>Order No <span class="employeemaster" style="font-size: 20px">*</span></th>
<th>Order Date:</th>
<th>Reward Type:</th>
<th>Recommended By</th>
<th>Description</th>
<th>Remarks</th>
<th>Uploads</th>
<th>Cancel</th>
</tr>
</thead>
<tbody>

@for ($i=0;$i<5;$i++)
<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="reward_slno[]"  >
      </td>
<td><input type="text" class="form-control width" name="reorder_no[]"></td>
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
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor




   </tbody>
 </table>    
</div> 
</div>
</div> 

<div class="tab-pane fade" id="tab14" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_new7">ADD NEW</div>
<div class="tableFixHead" style="overflow-y: initial;">
<table class="table table-bordered table-hover" id="tableintiation">
<thead>
<tr>

    <th>Sl No</th>
<th>Initiative Date <span class="employeemaster" style="font-size: 20px">*</span></th>
<th>Type</th>
<th>Description</th>
<th>Remarks</th>
<th>Uploads</th>
<th>Cancel</th>

</tr>
</thead>
<tbody>

@for ($i=0;$i<5;$i++)
<tr>

    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="intiation_slno[]"  >
      </td>
<td><input type="date" class="form-control width"   name="initiative_date[]"></td>
<td><select class="form-control width" name="inti_type[]">
    <option>--select--</option>
    <option>Cost Saving</option>
    <option>Process Improvemnt</option>
 
</select></td>

<td><textarea rows="3" cols="40" class="form-control"  name="inti_description[]" style="width:200px;"></textarea></td>

<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="inti_remark[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="Initiative_upload[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor
</tbody>
 </table>   
</div>  
</div>
</div>

<div class="tab-pane fade" id="tab15" role="tabpanel" aria-labelledby="border-contact-tab">
<div class="col-lg-12" style="overflow-y: auto;
height: 400px;position: relative;">
<div class="offset-lg-11 col-lg-1 new" id="add_new8">ADD NEW</div>
<div class="tableFixHead" style="overflow-y: initial;">
<table class="table table-bordered table-hover" id="tableachievemnt">
<thead>
<tr>

    <th>Sl No</th>
<th>Achievement Date <span class="employeemaster" style="font-size: 20px">*</span></th>
<th>Achievement Type</th>
<th>Achivement Period</th>
<th>Remarks</th>
<th>Uploads</th>
<th>Cancel</th>

</tr>
</thead>
<tbody>

@for ($i=0;$i<5;$i++)
<tr>

    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="achievement_slno[]"  >
      </td>
<td><input type="date" class="form-control width"   name="achievement_date[]"></td>
<td><select class="form-control width" name="achievement_type[]">
    <option>--select--</option>
    <option>Cost Saving</option>
    <option>Process Improvemnt</option>
 
</select></td>

<td><input type="text" class="form-control width"  name="achievement_period[]"></td>

<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="achievement_remark[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="achievement_upload[]"></td>
<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>
@endfor
</tbody>
 </table>    
</div> 
</div>
</div>

{{-- remark start--}}
<div class="tab-pane fade" id="tab16" role="tabpanel" aria-labelledby="border-contact-tab">
    <div class="col-lg-12" style="overflow-y: auto;
    height: 400px;position: relative;">
    <div class="offset-lg-11 col-lg-1 new" onclick="addremark()" style="cursor: pointer;" id="add_new9">ADD NEW</div>
    <div class="tableFixHead" style="overflow-y: initial;">
    <table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Sl No</th>
    <th>Remarks <span class="employeemaster" style="font-size: 20px">*</span></th>
    <th>Attachment</th>
    <th>Cancel</th>
    
    </tr>
    </thead>
    <tbody id="remark_body">
    
    @for ($v=0;$v<5;$v++)
    <tr id="remark_tr_{{ $v }}">
        <td align="center">
            <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="remark_slno[]" id="remark_slno_{{ $v }}"  style="margin: auto;" >
          </td>   
    <td align="text-center">
        <textarea rows="3" cols="40" class="form-control width" maxlength="150" id="remark_text_{{ $v }}" style="margin: auto;" name="remark_text[]"></textarea>
    </td>
    <td><input style="margin: auto;" type="file" accept="image/png, image/gif, image/jpeg" id="remark_attachment_{{ $v }}" name="remark_attachment[]"></td>
    <td align="center">
       <button style="margin: auto;" type="button" class="deletebtn" onclick="removeis('{{ $v }}','remark_tr_{{ $v }}')" title="Remove row">X</button>
    </td>
    </tr>

    @endfor
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

var num = Math.floor((Math.random()*1000000)+1);
function addremark(){
  $("#remark_body").append(`<tr id="remark_tr_${num}">
    <td align="center">
      <input type="number" style="margin: auto;" class="form-control td1" onkeypress="return isNumberKey(event)" name="remark_slno[]" id="remark_slno_${num}"  >
    </td>
    <td align="center">
        <textarea rows="3" cols="40" class="form-control width" maxlength="150" id="remark_text_${num}" style="margin: auto;" name="remark_text[]"></textarea>
    </td>
    <td><input style="margin: auto;" type="file" accept="image/png, image/gif, image/jpeg" id="remark_attachment_${num}" name="remark_attachment[]"></td>
    <td align="center">
       <button style="margin: auto;" type="button" class="deletebtn" onclick="removeis('${num}','remark_tr_${num}')" title="Remove row">X</button>
    </td>
    </tr>`);
    num++;
}  


</script>






 


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
                            <div class="table-responsive mt-4">
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
                                    <tbody  id="myTable">
                                    @foreach($Employee_fetch as $ky=>$val)
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
                                            <!-- <div class="modal-footer">
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
 <script type="text/javascript">
  function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
}
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

// $("#general-info").on('submit', function(e){
// e.preventDefault();
//     $.ajax({
//         type: 'POST',
//         url: '{{url("/add-employee-master")}}',
//         data: new FormData(this),
//         dataType: 'json',
//         contentType: false,
//         cache: false,
//         processData:false,
//         beforeSend: function(){
//             $('#submit-btn').attr("disabled","disabled");
//             $('#general-info').css("opacity",".5");
//         },
//         success: function(response){ 
//             console.log();
//             console.log(response);
//         }
//     });
// });

// document.getElementById("submit-btn").addEventListener('click', function(event){
//     event.preventDefault();
//     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
//     let myform = document.getElementById("general-info");
//     let fd = new FormData(myform);
//     console.log(CSRF_TOKEN); 
//     console.log(fd); 
//     $.ajax({
//         url: '{{url("/add-employee-master")}}',
//         type: "POST",
//         data: { 
//             '_token': CSRF_TOKEN,
//             'data': fd,
//         },
//         success: function(data, textStatus, jQxhr) {
//             console.clear();
//                 console.log(data); 
//             }
//         })
// });



  $('#dtpFrDate').datepicker({ dateFormat: 'dd-mm-yy' });
    $('#dtpFrDate1').datepicker({ dateFormat: 'dd-mm-yy' });
      $('#dtpFrDate2').datepicker({ dateFormat: 'dd-mm-yy' });
    $('#dtpFrDate3').datepicker({ dateFormat: 'dd-mm-yy' });
      $('#dtpFrDate4').datepicker({ dateFormat: 'dd-mm-yy' });
        $('#r_dob').datepicker({ dateFormat: 'dd-mm-yy' });
             $('#current_basic1').datepicker({ dateFormat: 'dd-mm-yy' });
                 $('#spouseDOB').datepicker({ dateFormat: 'dd-mm-yy' });
        $('#father_dob').datepicker({ dateFormat: 'dd-mm-yy' });
             $('#mother_dob').datepicker({ dateFormat: 'dd-mm-yy' });
               $('#depent_date').datepicker({ dateFormat: 'dd-mm-yy' });
                $('#f_date').datepicker({ dateFormat: 'dd-mm-yy' });
                $('#t_date').datepicker({ dateFormat: 'dd-mm-yy' });
             $('#mother_dob').datepicker({ dateFormat: 'dd-mm-yy' });
               $('#depent_date').datepicker({ dateFormat: 'dd-mm-yy' });
                $('#f_date').datepicker({ dateFormat: 'dd-mm-yy' });
   

</script>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>    
<script>


  var p = 0;  
    function portionDropdown(id){
    var portion_id = $('#portionDropdownid'+id).val();
    console.log(portion_id);
    if(id>=p){
        $('#selectdesignation').val(portion_id);
        p=id;
    }
}
 
var dept_select = ""; 
  function nominee_select(dependent_type,dept_selector)
  {
    if(dept_select=="" && dependent_type=="Nominee")
    {
       $("#one"+dept_selector+" option[value='Nominee']").attr('selected',true);
       dept_select = "Nominee";
    }
    else if(dept_select!="" && dependent_type=="Nominee")
    {
      alert("Nominee has already selected");
      $("#one"+dept_selector+" option[value='Dependent']").attr('selected',true);
      $("#one"+dept_selector).prop('selectedIndex',0);
    }
    else if(dept_select!="" && $("#one"+dept_selector+" :selected").text()=="Nominee")
    {
        $("#one"+dept_selector+" option[value='Dependent']").attr('selected',true);
        dept_select = "";
    }
    

    //alert(dependent_type);
    // if( $("#one"+id).val() == "nominee"){
    //     $("#one"+id).val('Nominee');
    //     $(".nominee").html("Dependent");
    //}


  }
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

function promotion(id)
{
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



   $(function () {
        $("#ddlModels").change(function () {
            if ($(this).val() == 'M') {
                $("#spouseName").prop("disabled", false);
                $("#spouseDOB").prop("disabled", false);
            } else {
                $("#spouseName").prop("disabled", true);
                $("#spouseDOB").prop("disabled", true);
            }
        });
    });

function showfield(name){
//   alert(name);
    if(name != 'A') {
      $(".r_class").show();
       $("#reason,#r_dob,#r_txtReason").prop("disabled",false);  
    }else{
       $(".r_class").hide();  
       $("#reason,#r_dob,#r_txtReason").prop("disabled",true);
    }
 
}

</script>
<script type="text/javascript">
  let i=5;
$("#add_newprobation").click(function () { 
  i++;
  $("#probationtable").append(`<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="prob_slno[]"  >
      </td>
<td><input type="text" class="form-control width" name="prob_order[]"></td>
<td><input type="date" class="form-control"   name="prob_order_date[]"></td>
<td><input type="date" class="form-control"   name="prob_start[]"></td>
<td><input type="date" class="form-control"    name="prob end[]"></td>
<td>
<select class="form-control "  id="probationid${i}" name="pay_grade1[]" style="width: 202px;">
   <option value="">--Select--</option>
       @foreach($pay_grade_view as $ky=>$val)
        <option value="{{$val->id}}">{{$val->pay_grade_desc}}
        </option>
       @endforeach
</select></td>
<td><input type="number" class="form-control width2" name="initial[]" id="promotion_catch_topaygrade_value${i}" style="width: 219px;"></td>
<td><input type="number"  class="form-control width2" name="special_allowance[]"id="probation_current_allowance${i}"  ></td>
<td><input type="number" class="form-control width2" name="other_allownace[]"id="probation_tocurrentother_allowance${i}"  ></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remark_prob[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="prob_upload[]"></td>
<td><button type="button" class="deletebtn" title="Remove row">X</button></td></td>
</tr>`);

});
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script type="text/javascript">
  let l=3356356;
$("#add_new").click(function () { 
  l++;
  $("#e-body").append(`<tr>
    <td><input type="number" onkeypress="return isNumberKey(event)" class="form-control td1" name="depend_snno[]" id="depend_snno${l}"  ></td>    
<td class="td2"><input type="text" class="form-control width" name="name[]" placeholder=""  ></td>
<td><select class="form-control" name="dependent_type[] "style="width: 124px" id="one${l}" onchange="nominee_select(this.value,${l})" >
    <option value="Dependent">Dependent</option>
    <option value="Nominee" >Nominee</option></select></td>
<td><input type="date" class="form-control" name="dob1[]" id="dob_${l}" onchange="check_age('dob_${l}','age_${l}','${l}')" placeholder="enter DOB"></td>
<td><input type="number" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" class="form-control  td1" id="age_${l}"  readonly name="age[]" ></td>
<td class="td2"><input type="text" class="form-control width" name="relation[]" placeholder="enter your relation"></td>
<td  class="td2"><input type="number"  class="form-control width " name="num[]" placeholder="enter adhara" style="width: 206px;"  ></td>
<td><textarea rows="3" cols="40" class="form-control"  name="dependent_addr[]" style="width:200px;"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" class="" placeholder="67%" name="dependent_file[]" multiple></td>

<td>
   <button type="button" class="deletebtn" title="Remove row">X</button>
</td>
</tr>`);
});
$("#add_newexperience").click(function () { 
$("#tablexperience").each(function () {
    var tds = '<tr>';
    jQuery.each($('tr:last td', this), function () {
        tds += '<td>' + $(this).html() + '</td>';
    });
    tds += '</tr>';
    if ($('tbody', this).length > 0) {
        $('tbody', this).append(tds);
    } else {
        $(this).append(tds);
    }
});
});
 var j=4;
      $("#add_newtransferno").click(function () {  
        j++;
    $("#table_transfer").append(`<tr>
        <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="transfer_snno[]" >
      </td>

    <td><input type="text" class="form-control width" width="130px" name="trans_order[]"></td>
    <td><input type="date"  class="form-control"   width="130px" name="transfer_ord_date[]"></td>
    <td> <select class="form-control width" name="order_type[]" >
        <option value="Transfer">Transfer</option>
        <option value="Deputation">Deputation</option>
    </select></td>

<td><input type="date"  class="form-control"   name="from_date[]"></td>
<td><input type="date" class="form-control" name="to_date[]" ></td>
<td> <select class="form-control width"  name="f_dept[]">
<option value="">select</option>
     @foreach($Department_fetch as $ky=>$val)
    <option value="{{$val->dept_no}}">{{$val->dept_name}}</option>
        @endforeach
  </select>
</td>
<td><select class="form-control width" name="t_dept[]" onchange="transfer(${j})"  id="transferid${j}">
<option value="">select</option>
     @foreach($Department_fetch as $ky=>$val)

    <option value="{{$val->dept_no}}">{{$val->dept_name}}</option>
        @endforeach
  </select></td>
<td><select class="form-control width" name="from_work[]">
<option value="">select</option>
@foreach($Workplace_fetch as $ky=>$val)

     <option value="{{$val->id}}">{{$val->workplace_name}}</option>
 @endforeach
</select></td>
<td><select class="form-control width" name="to_work[]"  onchange="transferWork(${j})"  id="transferWorkid${j}">
<option value="">select</option>
@foreach($Workplace_fetch as $ky=>$val)
     <option value="{{$val->id}}">{{$val->workplace_name}}</option>
 @endforeach
</select></td>

<td> <select class="form-control width"   name="ord_rea[]">
        <option value="">select</option>
        <option>Reward</option>
        <option>Routine</option>
        <option>Displinary</option>
        <option>Other</option>
    </select></td>
<td><textarea rows="3" cols="40" class="form-control width" name="reamrks[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="trans_file[]" ></td>
<td><button type="button" class="deletebtn" title="Remove row">X</button>   </td>  
                </tr>`);
                j++;
             
});
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
 
var k=4;
$("#add_newpromotion").click(function () {
k++; 
//alert(k);
  $("#promo_tbl").append(`<tr>
    <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="promo_slno[]"  >
      </td>
<td><input type="text" class="form-control width" name="promo_order_no[]"></td>
<td><input type="date" class="form-control" name="promo_date[]"></td>
<td><input type="date" class="form-control" placeholder="13/03/2008" name="effect_date[]"></td>
<td>
<select class="form-control " onchange="promotion(${k})"  id="promotionid${k}" name="from_grade[]" style="width: 202px;">
   <option value="">--Select--</option>
       @foreach($pay_grade_view as $ky=>$val)
        <option value="{{$val->id}}">{{$val->pay_grade_desc}}
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
</select>  
    </td>

<td><input type="text" class="form-control width" name="from_basic[]" id='catch_paygrade_value${k}' style="    width: 202px;" ></td>
<td><input type="number"   class="form-control width3" name="from_special[]" id="promtion_current_allowance${k}" ></td>
<td><input type="number"  class="form-control width3" name="from_other_special[]"  id="promtion_currentother_allowance${k}" ></td>
<td> <select class="form-control "  onchange="topromotion(${k})" id="promotiontoid${k}" name="to_grade[]" style="width: 202px;">
   <option value="">--Select--</option>
       @foreach($pay_grade_view as $ky=>$val)
        <option value="{{$val->id}}">{{$val->pay_grade_desc}}
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
</select>   
    </td>
<td><input type="text" class="form-control width" name="to_basic[]" id='catch_topaygrade_value${k}' ></td>
<td><input type="number"   class="form-control width3" name="total_allow[]" id="promtion_tocurrent_allowance${k}" ></td>
<td><input type="number"   class="form-control width3" name="to_other_allowance[]" id="promtion_tocurrentother_allowance${k}" ></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remark[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="upload_promo[]"></td>
<td><button type="button" class="deletebtn" title="Remove row">X</button></td>
</tr>`);
});
// $("#add_newprobation").click(function () { 

// $("#probationtable").each(function () {
   
//     var tds = '<tr>';
//     jQuery.each($('tr:last td', this), function () {
//         tds += '<td>' + $(this).html() + '</td>';
//     });
//     tds += '</tr>';
//     if ($('tbody', this).length > 0) {
//         $('tbody', this).append(tds);
//     } else {
//         $(this).append(tds);
//     }
// });
// });
$("#add_newqualification").click(function () { 
$("#new_qualification").each(function () {
   
    var tds = '<tr>';
    jQuery.each($('tr:last td', this), function () {
        tds += '<td>' + $(this).html() + '</td>';
    });
    tds += '</tr>';
    if ($('tbody', this).length > 0) {
        $('tbody', this).append(tds);
    } else {
        $(this).append(tds);
    }
});
});
$("#add_newtechnicalqualification").click(function () { 
$("#new_technicalqualification").each(function () {
   
    var tds = '<tr>';
    jQuery.each($('tr:last td', this), function () {
        tds += '<td>' + $(this).html() + '</td>';
    });
    tds += '</tr>';
    if ($('tbody', this).length > 0) {
        $('tbody', this).append(tds);
    } else {
        $(this).append(tds);
    }
});
});


$("#add_new1").click(function () { 

    $("#maintable1").each(function () {
       
        var tds = '<tr>';
        jQuery.each($('tr:last td', this), function () {
            tds += '<td>' + $(this).html() + '</td>';
        });
        tds += '</tr>';
        if ($('tbody', this).length > 0) {
            $('tbody', this).append(tds);
        } else {
            $(this).append(tds);
        }
    });
});
$("#add_newcontract").click(function () { 
  $("#tablecontract").each(function () {
       
       var tds = '<tr>';
       jQuery.each($('tr:last td', this), function () {
           tds += '<td>' + $(this).html() + '</td>';
       });
       tds += '</tr>';
       if ($('tbody', this).length > 0) {
           $('tbody', this).append(tds);
       } else {
           $(this).append(tds);
       }
   });
});
$("#add_new4").click(function () { 
$("#tablerevocation").each(function () {
   
    var tds = '<tr>';
    jQuery.each($('tr:last td', this), function () {
        tds += '<td>' + $(this).html() + '</td>';
    });
    tds += '</tr>';
    if ($('tbody', this).length > 0) {
        $('tbody', this).append(tds);
    } else {
        $(this).append(tds);
    }
});
});
$("#add_new5").click(function () { 
$("#tableappriciation").each(function () {
   
    var tds = '<tr>';
    jQuery.each($('tr:last td', this), function () {
        tds += '<td>' + $(this).html() + '</td>';
    });
    tds += '</tr>';
    if ($('tbody', this).length > 0) {
        $('tbody', this).append(tds);
    } else {
        $(this).append(tds);
    }
});
});
$("#add_new6").click(function () { 
$("#tablereward").each(function () {
   
    var tds = '<tr>';
    jQuery.each($('tr:last td', this), function () {
        tds += '<td>' + $(this).html() + '</td>';
    });
    tds += '</tr>';
    if ($('tbody', this).length > 0) {
        $('tbody', this).append(tds);
    } else {
        $(this).append(tds);
    }
});
});
$("#add_new7").click(function () { 
$("#tableintiation").each(function () {
   
    var tds = '<tr>';
    jQuery.each($('tr:last td', this), function () {
        tds += '<td>' + $(this).html() + '</td>';
    });
    tds += '</tr>';
    if ($('tbody', this).length > 0) {
        $('tbody', this).append(tds);
    } else {
        $(this).append(tds);
    }
});
});
$("#add_new8").click(function () { 
$("#tableachievemnt").each(function () {
   
    var tds = '<tr>';
    jQuery.each($('tr:last td', this), function () {
        tds += '<td>' + $(this).html() + '</td>';
    });
    tds += '</tr>';
    if ($('tbody', this).length > 0) {
        $('tbody', this).append(tds);
    } else {
        $(this).append(tds);
    }
});
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
 
  <script type="text/javascript">
document.getElementById("one").onchange = function () {
  document.getElementById("two").setAttribute("disabled", "disabled");
  if (this.value == 'Nominee')
    document.getElementById("two").removeAttribute("disabled");
};
</script>
<script>

 $(document).on('click', 'button.deletebtn', function () {
    let check = $(this).closest('table').attr('id');
    let rowCount = $(`#${check} tbody tr`).length;
     if(rowCount == 1){
     } else{
        $(this).closest('tr').remove();
     }
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
$('#input-payment-egn2').keyup(function(e){
  if($(this).val().length === 12){
    e.preventDefault();
    $('#wrong-egn2').slideUp();
  } else {
    $('#wrong-egn2').slideDown();
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
    // function fetch_payscale(pay_scale) {
    //   //alert(pay_scale);

    //   var thisvalue = $("select#pay_grade option:selected").text();
    //   $('#catch_value').val(pay_scale);
    //   $('#pay_grade_code_hdn').val(thisvalue);
    //    $('#initial_allowance').val(thisvalue);



    //   // $('#catch_value').val(pay_scale);
    //   //$('#payGrade_id_hdn').val();
    // }
    $(document).ready(function () {
  
  // Denotes total number of rows
  var rowIdx = 0;

  // jQuery button click event to add a row
  $('#addBtn1').on('click', function () {
    // Adding a row inside the tbody.


    $('#e-body1').append(`<tr id="R${rowIdx++}">
             <p>Row ${rowIdx}</p>
             <td>
        <input type="number" class="form-control td1" onkeypress="return isNumberKey(event)" name="cont_slno[]"  >
      </td>
<td><input type="text" class="form-control width" name="cont_order[]"></td>
<td><input type="date" class="form-control"   name="cont_order_date[]"></td>
<td><input type="date" class="form-control"   name="cont_start_date[]"></td>
<td><input type="date" class="form-control"   name="cont_end_date[]"></td>
<td><input type="number"   class="form-control width2" name="con_pay[]"></td>
<td><input type="text" class="form-control width2" name="special[]"></td>
<td><input type="text" class="form-control width2" name="other[]"></td>
<td><textarea rows="3" cols="40" class="form-control width" maxlength="150" name="remarks[]"></textarea></td>
<td><input type="file" accept="image/png, image/gif, image/jpeg" name="cont_file[]"></td>
<td><button type="button" class="deletebtn" title="Remove row">X</button></td>

</tr>`);
  });

  // jQuery button click event to remove a row.
  $('#e-body').on('click', '.remove', function () {

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

<script type="text/javascript">
    function form_validation(){
        var emp_name = $('#emp_name').val();
        var emp_code = $('#emp_code').val();
        var selectdepartment = $('#selectdepartment').val();
        var emp_type = $('#emp_type').val();
        var selectdesignation = $('#selectdesignation').val();
        var category = $('#category').val();
        var selectWorkplace = $('#selectWorkplace').val();
        var DOB = $('#DOB').val();
        var email = $('#email').val();
        var DOJ = $('#DOJ').val();
        var vpf_val = $('#vperc_textbox').val();
        var esi_val = $('#esiacc').val();
        var uan_val = $('#uano').val();
        if(emp_name=="")
        {
            alert("Please enter employee name");
            $('#emp_name').focus();
            return false; 
        }
        if(emp_code=="")
        {
            alert("Please enter employee code");
            $('#emp_code').focus();
            return false; 
        }
        if(selectdepartment=="")
        {
            alert("Please select department");
            $('#selectdepartment').focus();
            return false; 
        }
        if(emp_type=="")
        {
            alert("Please select employee type");
            $('#emp_type').focus();
            return false; 
        }
        if(selectdesignation=="")
        {
            alert("Please select desognation");
            $('#selectdesignation').focus();
            return false; 
        }
        if(category=="")
        {
            alert("Please select category");
            $('#category').focus();
            return false; 
        }
        if(selectWorkplace=="")
        {
            alert("Please select workplace");
            $('#selectWorkplace').focus();
            return false; 
        }
        if(DOB=="")
        {
            alert("Please enter date of birth");
            $('#DOB').focus();
            return false; 
        }
        if(DOJ=="")
        {
            alert("Please enter date of join");
            $('#DOJ').focus();
            return false; 
        }
        if(isNaN(vpf_val))
        {
            alert("Please enter VPF as number");
            return false; 
        }
        if(!esi_val==""){
            if(isNaN(esi_val))
            {
                alert("Please enter ESI as number");
                return false; 
            } else if(esi_val.length < 10){
                alert("ESI no should be 10 digit");
                $('#esiacc').focus();
                return false; 
            } else if(esi_val.length > 10){
                alert("ESI no should be 10 digit");
                $('#esiacc').focus();
                return false; 
            }
        }
        if(!uan_val==""){
            if(isNaN(uan_val))
            {
                alert("Please enter UAN as number");
                return false; 
            } else if(uan_val.length < 12){
                alert("UAN should be 12 digit");
                $('#uano').focus();
                return false; 
            } else if(uan_val.length > 12){
                alert("UAN should be 12 digit");
                $('#uano').focus();
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
    <script src="{{url('/')}}/public/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="{{url('/')}}/public/plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="{{url('/')}}/public/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="{{url('/')}}/public/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
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
        } );
    </script>

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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>

</body>
</html>

                 <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }

  </script>

@endsection