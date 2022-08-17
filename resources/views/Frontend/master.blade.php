<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
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
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/plugins/table/datatable/datatables.css">
 
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
                <a class="navbar-brand" href="{{url('/home')}}"><img alt="logo" src="{{url('/')}}/public/assets/img/logo3.png"></a>
            </div>

            <ul class="navbar-item flex-row mr-auto">
                <li class="nav-item align-self-center search-animated">
                       <h5><span>P</span>ersonnel <span>M</span>anagement <span>S</span>ystem</h5>
                </li>
            </ul>

            <ul class="navbar-item flex-row nav-dropdowns">
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
        </header>
    </div>

    <!--  END NAVBAR  -->

   
        <!--  BEGIN CONTENT AREA  -->
  
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

                <ul class="list-unstyled menu-categories" id="topAccordion">

                    <li class="menu single-menu">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                <span>Master</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#topAccordion">
                            <li>
                                <a href="{{url('/department-master')}}"> Department Master </a>
                            </li>
                            <li>
                                <a href="{{url('/designation-master')}}"> Designation Master </a>
                            </li>
                             <li>
                                <a href="{{url('/pay-grade-master')}}"> Pay Grade Master </a>
                            </li>
                             
                            <!--<li>-->
                                <!--<a href="{{url('/board-university')}}"> Board/University Master</a>-->
                            <!--</li>-->
                            <li>
                                <a href="{{url('/category')}}"> Category Master</a>
                            </li>
                            <li>
                                <a href="{{url('/employee_type')}}"> Employee Type Master</a>
                            </li>
                            <li>
                                <a href="{{url('/workplace')}}"> Workplace Master</a>
                            </li>
                             <li>
                                <a href="{{url('/bank')}}"> Bank Master</a>
                            </li>

                             <li>
                                <a href="{{url('/user-profile')}}"> User Profile</a>
                            </li>
<?php if(Auth::user()->role!== "Finance Staff" && Auth::user()->role!== "User"){?>
                            <li>
                                <a href="{{url('/user-maintenance')}}">User Maintenance</a>
                            </li>
<?php }?>
                        </ul>
                    </li>

                    <?php if( Auth::user()->role == "Administrator"||Auth::user()->role == "HR Manager") {?>
                     <li class="menu single-menu">
                        <a href="{{url('/employee_master')}}"  class="dropdown-toggle">
                            <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                <span>Employee Details</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                    </li>
                    <?php 
                   }else if(Auth::user()->role == "Finance Staff"|| Auth::user()->role == "User"||Auth::user()->role == "Authorisor" ||Auth::user()->role == "Supervisor"){?>
                 <li class="menu single-menu">
                        <a href="{{url('/employee_list')}}"  class="dropdown-toggle">
                            <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                <span>Employee List</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                    </li>
                   <?php 
                        }   
                    ?>
              
                    {{-- <li class="menu single-menu">
                        <a href="#components" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <span>Employee CCR / PA Report</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="components" data-parent="#topAccordion">
                            <li>
                       
                                <a href="{{url('/regular-employee')}}"> Regular Employees </a>
                            </li>
                            <li>
                                <a href="{{url('/contract-employee')}}"> Contract Employees</a>
                            </li>
                        </ul>
                    </li> --}}
                    
                    <li class="menu single-menu">
                        <a href="#components" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <span>Report_1</span>
                            </div>
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="components" data-parent="#topAccordion">
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-list-category-wise')"> Employees List(Category-Wise) </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-list-department-wise');"> Employees List(Department-Wise)  </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-list-pay-grade-wise');"> Employees List(Pay Grade-Wise) </a>
                            </li>                            
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-list-email-category-code-wise');"> Employees List With Email(Category Emp. Code-Wise)</a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-list-pan-category-wise');">Employees List With PAN(Category-Wise)</a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-master-list');">Employees Master List</a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-master-list-with-joining-period');">Employees Master List(With Joining Period)</a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/birthday-fall-report');"> Birth Day Fall Report </a>
                            </li>
                            <li> 
                                <a href="JavaScript:newPopup('{{url('/')}}/contract-completion-report');"> Contract Completion Report </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/probation-completion-report');"> Probation Completion Report </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/retirement-due-reports');"> Retirement Due Report </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/retired-employees-detail-reports');"> Retired Employees Details Report </a>
                            </li>
                            
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-official-information-details-report');"> Employee Official Information Details Report </a>
                            </li>


                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-personal-information-details-report');"> Employee Personal Information Details Report </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-contract-renewal-details-report');"> Employee Contract Renewal Details Report </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-master-data-report');"> Employee Master Data Report </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-qualification-experience-details-report');">Employee Qualification Experience Details </a>
                            </li>
                            
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-yr-of-service-qualification-pay-grade-details');"> Employee Yr. Of Service, Qualification Pay Grade Details </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu single-menu">
                        <a href="#components" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <span>Report_2</span>
                            </div>
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="components" data-parent="#topAccordion">
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employees-basic-pay-pp1-pp2-allowance-list');"> Employees List With BasicPay, PP1, PP2, Allowance </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employees-address-qualification-pan-account-remuneration-year');"> Employees List With PAN, Bank A/c Remuneration</a>
                            </li>
                            <li>

                                <a href="JavaScript:newPopup('{{url('/')}}/employee-life-insurance-scheme');"> Data Required For Life Insurance Scheme</a>
                            </li>                            
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-qualification-experience-remuneration');"> Employee Qualification, Experience. Remuneration</a>
                            </li>
                            <!-- <li>

                                <a href="JavaScript:newPopup('{{url('/')}}/employee-monthly-remuneration');">Employee Monthly Remuneration</a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-monthly-remuneration-details-report');"> Employee Monthly Remuneration Details </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-monthly-remuneration-deduction-report');"> Employee Monthly Remuneration, Deduction Details  </a>
                            </li>

                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-month-year-dedcuction-details');"> Employee Month / Year-wise Remuneration, Deduction </a>
                            </li>



                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-gross-salary-three-financial-year');"> Employee Gross Salary For 3 Fin Year(Year-Wise) </a>
                            </li>
                  
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-gross-salary-for-12-month-wise');"> Employee Gross Salary For 12 Months(Month-Wise) </a>
                            </li>
                            <li>
                                <a href="JavaScript:newPopup('{{url('/')}}/employee-remuneration-summary-branch-wise');"> Employee Remuneration Summary(Branch-Wise) </a>
                            </li>
                            <li class="sub-sub-submenu-list">
                                <a href="#pages-error" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> ESI Deduction Details <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="pages-error" data-parent="#more"> 
                                    <li>
                                        <a href="JavaScript:newPopup('{{url('/')}}/esi-deduction-of-regular-employee');"> Regular Employee </a>
                                    </li>
                                    <li>
                                        <a href="JavaScript:newPopup('{{url('/')}}/esi-deduction-of-contract-employee');"> Contract Employee </a>
                                    </li>
                                    
                                </ul>
                            </li> -->
                            
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <!--  END TOPBAR  -->
      <div id="content" class="main-content">
          @yield('content')
      </div>

 
<script type="text/javascript">
// Popup window code
function newPopup(url) {
  popupWindow = window.open(
    url,'popUpWindow',"width="+screen.availWidth+",height="+screen.availHeight);
    // url,'popUpWindow','height=700,width=1250,left=100,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'
    
}
</script>