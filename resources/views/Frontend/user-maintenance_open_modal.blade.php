<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8" />
    {{-- <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0"/> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Samaj</title>
    <link rel="icon" type="image/x-icon" href="{{url('/')}}/public/assets/img/logo3.png"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet"> 
    <link href="{{url('/')}}/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/public/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/plugins/dropify/dropify.min.css">
    <link href="{{url('/')}}/public/assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/public/assets/css/components/custom-carousel.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/plugins/table/datatable/datatables.css')}}">
 
    <!-- END PAGE LEVEL STYLES -->
 <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="{{url('/')}}/public/assets/js/libs/jquery-3.1.1.min.js"></script>
  <style> 
         ::-moz-selection {
        /* Code for Firefox */
        color: rgb(255, 255, 255);
        background: #1b55e2;
    }
    
     ::selection {
        color: rgb(255, 255, 255);
        background: #1b55e2;
    }
  </style>
   
</head>
<body class="sidebar-noneoverflow">
    
    <!--  BEGIN NAVBAR  -->
    <div class="header-container">
        <header class="header navbar navbar-expand-sm">

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <div class="col-lg-4  nav-logo align-self-center">
                <a class="navbar-brand" href="{{url('/')}}/employee_master"><img alt="logo" src="{{url('/')}}/public/assets/img/logo3.png"></a>
            </div>

            <ul class="navbar-item flex-row mr-auto">
                <li class="nav-item align-self-center search-animated">
                       <h5><span>P</span>ersonnel <span>M</span>anagement <span>S</span>ystem</h5>
                </li>
            </ul>
  <ul class="navbar-item flex-row nav-dropdowns">
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                
                  <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                    <a href="{{url('/')}}/logout" class="nav-link dropdown-toggle user" id="user-profile-dropdown"  aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                      <div class="media-body align-self-center">
                               <h6> Sign Out</h6>
                            </div>
                        </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                    </a>
         

                </li>
            </ul>
                            </li>
                        @endif
                    </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->


     <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <div class="topbar-nav header navbar" role="banner">
            <nav id="topbar">
                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        <a href="#">
                            <img src="assets/img/logo2.svg" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="#" class="nav-link"> CORK </a>
                    </li>
                </ul>
<style>
.cer{
    width: 22px;
    height: 22px;
    color: #e0e6ed;
    border: 1px solid white;
    border-radius: 50%;
    text-align: center;
}
.cer i{
    margin-top: 5px;
}
</style>
                <ul class="list-unstyled menu-categories nav justify-content-center" id="topAccordion">
  
                    <li class="menu single-menu">
                        @if (Auth::user()->role!=="User" && Auth::user()->role!=="Finance Staff")
                        <a href="#app" data-toggle="modal" data-target=".bd-example-modal-xl">
                            @else
                        <a href="javascript:void(0)" >
                        @endif
                            <div class="">
                                <table>
                                    <tr>
                                        <td>
                                    <div class="cer">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </div> 
                                        </td>
                                        <td>
                                            <span style="margin-left: 5px;">Enter Query</span>  
                                        </td>
                                    </tr>
                                </table>
                            </div> 
                        </a>

                    </li>

                    <li class="menu single-menu">
                        <a href="{{url('/')}}/employee_master"  >
                            <div class="">
                                <table>
                                    <tr>
                                        <td>
                                    <div class="cer">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div> 
                                        </td>
                                        <td>
                                            <span style="margin-left: 5px;">New Record</span>  
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                        </a>
         
                    </li>

                    
                    <li class="menu single-menu">
                   
                      @if( Request::segment(1)=="employee_edit_master")
                     @if(Auth::user()->role == "Administrator" || Auth::user()->role == "HR Manager" ) 
                         @if(isset($_GET['search_emp']))
                        <a href="{{url('/')}}/Employee_delete_Recordview/?search_emp={{$_GET['search_emp']}}"
                         onclick="return confirm('Do You Want To Delete Employee Data Permanently?');">
                          @else
                         <a href="#" >
                        @endif 
                            <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                <span>Delete Record</span>
                            </div>
                            
                        </a>
                        @endif 
                         @endif 
                    </li>
                    <li class="menu single-menu">
                        <a href="{{url('/')}}/employee_master" >
                            <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                <span>Clear</span>
                            </div>
                          
                        </a>
                    </li>

                    <li class="menu single-menu">
                        <a href="{{url('/home')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                <span>Exit</span>
                            </div>
                          
                        </a>
                    </li>

                    <li class="menu single-menu">
                        <a href="{{url('/home')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19l-7-7l7-7"/></g></svg>
                                <span>Back</span>
                            </div>
                          
                        </a>
                    </li>

                   

                </ul>
            </nav>
        </div> 
 <div id="content" class="main-content">
            <div class="layout-px-spacing">                
                <div class="account-settings-container layout-top-spacing">
                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
@if(session()->has('error'))
<div class="alert alert-danger show" role="alert"  id="sxd" >
    <strong>Status..</strong> <c style="font-size: initial;">{{ session()->get('error') }}</c>
    <button type="button" class="btn btn-info close" data-dismiss="alert" aria-label="Close" onclick="{$('#sxd').fadeOut('slow');}" style="margin-top:-5px; background: #25091f; padding: 10px; opacity: unset;">
   Close
    </button>
</div>
@endif 
@if(session()->has('success'))
<div class="alert alert-success show" role="alert"  id="sxd" >
    <strong style="color:black;">Status..</strong> <c style="font-size: initial;">{{ session()->get('success') }}</c>
    <button type="button" class="btn btn-info close" data-dismiss="alert" aria-label="Close" onclick="{$('#sxd').fadeOut('slow');}" style="margin-top:-5px; background: #25091f; padding: 10px; opacity: unset;">
   Close
    </button>
</div>
@endif


 @if (Auth::user()->role!=="User" && Auth::user()->role!=="Finance Staff")                               
    <form id="general-info" class="section general-info" style="height: 570px;"  action="{{url('/')}}/userData" method="post">
    {!! csrf_field() !!}  

        <div class="info">
            <h6 class="">USER MAINTENANCE</h6>
                <div class="col-lg-7 mx-auto user-maintenance">
                    <div class="row">
                        <div class="col-lg-12 text-center login-type">
                            <h5>LOGIN TYPE</h5>
@foreach($data as $ky=>$val)
<input type="radio"  name="user_name" 
value="{{$val->user_type}}"  required> 
<label for="vehicle1">{{$val->user_type}}<br></label>&nbsp;
@endforeach

<input type="hidden" id="login_id" name="login_id" value="{{  Auth::user()->id }}">
<input type="hidden" id="login_role" name="login_role" value="{{  Auth::user()->role }}">
<input type="hidden" id="login_email" name="login_email" value="{{ Auth::user()->email }}">

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label>User Id</label>
                            <input type="email" class="form-control  mb-4" name="email"  id="email" required>
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="fullName">Status</label><br>
                            <select class="form-control" id="status" name="status"required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>

                                </select>
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control mb-4" name="" value="" id="password1" required>
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control mb-4" name="confirm" value="" id="password2">
                            <p id="validate-status" required></p>
                            
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="fullName">Expiry Date(DD/MM/YY)</label><br>
                            <input type="date" class="form-control mb-4"  name="expiary_date" value="" id="expiary_date" required>
                            
                        </div>
                        </div>
                            <div class="col-lg-6" style="top: 30px">
                            <button class="btn btn-primary "type="submit"  id="butsave">Save</button>&nbsp;&nbsp;
                            
                        </div>
                    </div>
                </div>
        </div>
    </form>
    @else
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Access Denied!</h4>
        <hr>
        <p class="mb-0"  style="font-size: initial;">You can't access this page..!! <a href="{{ url('/home') }}">Go Back</a></p>
      </div>
    
        @endif 






                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--  END CONTENT AREA  -->


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
</div>



@if (Auth::user()->role!=="User" && Auth::user()->role!=="Finance Staff")
<div id="modalOptionalSizes" class="col-lg-12 layout-spacing">
    <div class="statbox box box-shadow">
        <div class="widget-content">
            <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">EDIT PROFILE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>


    <form id="general-info" class="general-info mt-5 mb-5" 
    action="{{url('/')}}/Update_User_Data"  method="post">
            {!! csrf_field() !!} 
      
          
                <div class="col-lg-8 mx-auto user-maintenance">
                    <div class="row">
                        <input type="hidden"id="id1" name="user_sql_id1">
                        <input type="hidden"id="page" value="user-maintenance" name="page">
                        <div class="col-lg-12 text-center login-type">
<h5>USER GROUP</h5>
@foreach($data1 as $ky=>$val) 
<input type="radio"  name="user_name1" value="{{$val->user_type}}" >
<label for="vehicle1">{{$val->user_type}}<br></label>&nbsp;
@endforeach 
<input type="hidden" id="login_id1" name="login_id1" value="{{  Auth::user()->id }}">
<input type="hidden" id="login_role1" name="login_role1" value="{{  Auth::user()->role }}">
<input type="hidden" id="login_email1" name="login_email1" value="{{ Auth::user()->email }}">
                          

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                            <label>User Id</label>
                                <select class="form-control" id="email_id1" name="email_id1" required>
                                <option value=""> 
                                </option>
                            </select>
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="fullName">Status</label><br>
                        
                                <select class="form-control" id="status1" name="status1"required>
                                <option value="">Select</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>

                                </select>
                        </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                            <label for="fullName">Expiry Date(DD/MM/YY)</label><br>
                            <input type="date" class="form-control mb-4"  name="expiary_date1" value="" id="expiary_date1" required>
                            
                        </div>
                        </div>

                        <div class="col-lg-12 text-center password-type">
                            <h5>CHANGE PASSWORD</h5>
                        </div>
                        <div class="offset-lg-2 col-lg-8">
                            <label>Existing Password<span class="employeemaster" style="font-size: 20px; color:red;">*</span></label>
                            <input type="password" class="form-control mb-4" name="password00" id="password00" required>
                        </div>
                        <div class="offset-lg-2 col-lg-4">
                            <label>New Password</label>
                            <input type="password" class="form-control mb-4" name="password11" id="password11" >
                        </div>
                            <div class="col-lg-4 eye">
                            <label>Re-enter New Password</label>
                            <input type="password" class="form-control" name="reenter_password1"  id="password22" >
                            
                        </div>
                        <div class="offset-lg-2 col-lg-8 text-center">
                            <button class="btn btn-primary "type="submit"  id="butsave1">Save</button>&nbsp;&nbsp;
                            <button class="btn btn-danger mb-2" style="margin-top: 10px;">Cancel</button>
                        </div>

                    </div>
                     
                </div>
       
    </form>


                </div>
              </div>
            </div>


        </div>
    </div>
</div>
@endif



 
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-circle-up"></i></button>
    <div id="content" class="main-content">
    <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © 2021 <a target="_blank" href="#">The Samaj</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Design & Developed by <a href="https://www.polosoftech.com/" target="_blank">PoloSoft Technologies </a></p>
            </div>
        </div>
    </div>
    @if(Session::has('data-added'))

    <script type="text/javascript">
        swal("great job","{!! Session::get('data-added') !!}","success",{
            button:"OK", 
        })
    
    </script>
    @endif   
    <script>
var mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
    function topFunction() {
     $('html, body').animate({scrollTop:0}, 'slow');
}

//   $(function () {
//         $("#butsave").click(function () {
//             var password = $("#password1").val();
//             var confirmPassword = $("#password2").val();
//             if (password != confirmPassword) {
//                 alert("Passwords do not match.");
//                 return false;
//             }
//             return true;
//         });
//     });

        $(document).ready(function() {
            App.init();
        });

    let msg = '{{Session::get('alert')}}';
    let exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }

    $(function () {
        $("#butsave").click(function () {
            var password = $("#password1").val();
            var confirmPassword = $("#password2").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });











////////////////////profile edit ///////////////
$(function () {
        $("#butsave1").click(function () {
            var password = $("#password11").val();
            var confirmPassword = $("#password22").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });

      $('input[type=radio][name=user_name1]').change(function() {
        $("#email_id1").html("")
        $("#status1").prop("selectedIndex",0)
        $('#expiary_date1').val("");
            let role =this.value;
            $.ajax({
                  type:'POST',
                  url: "{{url('/getEmailuser')}}",
                  dataType: "json",
                  data:{
                    'login_id':$('#login_id1').val(),  
                    'login_role':$('#login_role1').val(),  
                    'login_email':$('#login_email1').val(),  
                    '_token':$('input[name=_token]').val(),  
                    'selectedid': role
                },
                success: function(f){
                    $("#email_id1").html(f);
                }
            });

   });

        $(document).on('change', '#email_id1', function(e) { 
       e.preventDefault(); 
       var pkid = $(this).val();
    if(pkid=="select"){
        $("#status").prop("selectedIndex",0)
        $('#expiary_date').val("");
    } else {
        $.ajax({
                type:'POST',
                url: "{{url('/getEmailDetails')}}",
                dataType: "json",
                data:{
            '_token':$('input[name=_token]').val(),        
            'emailId': pkid
                },
                success: function(data){
                if(data!=""){
                $('#id1').val(data[0].id);
                $('#expiary_date1').val(data[0].expiary_date);
                $('#status1').val(data[0].status);
                $('#user_password').val(data[0].password);
            }
        }
        });
    }

           });
 </script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="{{url('/')}}/public/bootstrap/js/popper.min.js"></script>
 <script src="{{url('/')}}/public/bootstrap/js/bootstrap.min.js"></script>
 <script src="{{url('/')}}/public/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
 <script src="{{url('/')}}/public/assets/js/app.js"></script>
 <script src="{{url('/')}}/public/assets/js/custom.js"></script>
 <!-- END GLOBAL MANDATORY SCRIPTS -->

 <!--  BEGIN CUSTOM SCRIPTS FILE  -->

 <script src="{{url('/')}}/public/plugins/dropify/dropify.min.js"></script>
 <script src="{{url('/')}}/public/plugins/blockui/jquery.blockUI.min.js"></script>
 <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
 <script src="{{url('/')}}/public/assets/js/users/account-settings.js"></script>
</body>
</html>