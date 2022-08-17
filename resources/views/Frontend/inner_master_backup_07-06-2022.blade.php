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
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                <!--             <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="font-size:18px">
                                 <span class="caret"></span>
                                </a>

                                <ul class="navbar-item flex-row nav-dropdowns">
                    <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-size: 16px;">
                                    {{ Auth::user()->role }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       >
                                        {{ __('Logout') }}

                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                </li> -->
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
                        <a href="index-2.html">
                            <img src="assets/img/logo2.svg" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="index-2.html" class="nav-link"> CORK </a>
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
                <ul class="list-unstyled menu-categories" id="topAccordion">
  
                    <li class="menu single-menu">
                        <a href="#app" data-toggle="modal" data-target=".bd-example-modal-xl">
                       
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
<!--                     
                    <li class="menu single-menu">
                        <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">

                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                <span>Save</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>

                    </li>
 -->

                    <li class="menu single-menu">
                         @if(isset($_GET['search_emp']))
                        <a href="{{url('/')}}/Employee_Prev_Recordview/?search_emp={{$_GET['search_emp']}}" >
                        @else
                         <a href="{{url('/')}}/Employee_Prev_Recordview/?search_emp={{ @$pre_employee->emp_no }}" >
                        @endif   
                            <div class="">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left-circle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 8 8 12 12 16"></polyline><line x1="16" y1="12" x2="8" y2="12"></line></svg>
                                <span>Prev. Record</span>
                            </div>
                          
                        </a>

                    </li>

                    <li class="menu single-menu">
                        @if(isset($_GET['search_emp']))
                        <a href="{{url('/')}}/Employee_Next_Recordview/?search_emp={{$_GET['search_emp']}}" >
                        @else
                         <a href="{{url('/')}}/Employee_Next_Recordview/?search_emp={{@$next_employee->emp_no }}" >
                        @endif    
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                <span>Next. Record</span>
                            </div>
                            
                        </a>

                    </li>

                    <li class="menu single-menu">

                        <a href="{{url('/')}}/Employee_last_Recordview" >

                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-down-right"><polyline points="15 10 20 15 15 20"></polyline><path d="M4 4v7a4 4 0 0 0 4 4h12"></path></svg>
                                <span>Last Record</span>
                            </div>
                           
                        </a>
                    </li>

                    <li class="menu single-menu">
                        <a href="{{url('/')}}/Employee_first_Recordview">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-down-left"><polyline points="9 10 4 15 9 20"></polyline><path d="M20 4v7a4 4 0 0 1-4 4H4"></path></svg>
                                <span>First Record</span>
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
        <!--  END TOPBAR  -->
          <div id="content" class="main-content">
          @yield('content')
      </div>