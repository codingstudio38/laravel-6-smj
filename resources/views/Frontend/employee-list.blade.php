

@extends('Frontend.inner_master')

@section('content')
<style type="text/css">
    .button1
    {
            color: #fff !important;
    background-color: #191e3a;
    border-color: #191e3a;
    box-shadow: 0 10px 20px -10px #191e3a;
}


</style>
   <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/plugins/table/datatable/dt-global_style.css">
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">                
                    
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                                    </div>     
                                    <div id="content" class="main-content">
                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
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

                            </div>
                        </div>
                    </div>
                
                
                </div>

                </div>
   
                {{-- <div id="modalOptionalSizes" class="col-lg-12 layout-spacing">
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
                    <div class="table-responsive mb-4 mt-4">
                        <div class="offset-xl-8 col-xl-4 col-lg-4 col-sm-4" style="text-align: right;">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                      </div>

                        <br><br>
                        <table id="html5-extension1" class="table" style="width:100%">
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
                </div> --}}











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

    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{url('/')}}/public/plugins/table/datatable/datatables.js"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
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
        $('#html5-extension1').DataTable( {
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
                     
@endsection