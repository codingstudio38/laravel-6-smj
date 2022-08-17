@extends('Frontend.footer')

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
                                    <form id="general-info" class="section general-info" action="{{url('/')}}/add-employee-type" method="post">
                                   {!! csrf_field() !!}  
                                        <div class="info">
                                            <h6 class="">EMPLOYEE TYPE MASTER</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                
                                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-10">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Employee Type</label>
                                                                            <input type="text" class="form-control mb-4"   value="" name="emp_name" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2" style="margin-top: 28px">
                                                                        <div class="form-group">
                                                                          <button type="submit" class="btn btn button1">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                

                                                                </div>


                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    </div>     
                                    <div id="content" class="main-content">

                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>EmpType Name</th>
                                            <th>Action</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Employee_view as $ky=>$val)
                                           <tr>
                                                <td>{{$val->id}}</td>
                                                <td>{{$val->employee_type_name}}</td> 
                                                 <td><a href="edit/{{ $val->id }}"  data-toggle="modal" data-target="#myModal" title="Edit" class="editbtn" class="btn btn-success editbtn" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a> <a href="delete_Emp_type_data/{{ $val->id }}" data-toggle="tooltip" data-placement="top" title="Delete"  onclick="return confirm('Do you want to delete this employee type record?');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                            
                                            </tr>
                                             @endforeach
                                    </tbody>
                                </table>
                                {{ $Employee_view->appends(Request::all())->links() }}
                            </div>
                        </div>
                    </div>

                </div>

                </div>
              <div class="modal fade" id="modal-animation-14">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content animated fadeInUp">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Employeetype Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <form action="{{url('/')}}/Update_employee-type"  method="post">
                        {{csrf_field()}}
                   <div class="form-group">
                            
                              <input type="hidden" class="form-control" name="emp_id" id="emp_id" aria-describedby="textHelp">
                              
                            </div>
                            <div class="form-group">
                              <label for="exampleInputtext1">EmployeeType Name</label>
                              <input type="text" class="form-control" id="emp_name" name="emp_name" aria-describedby="textHelp">
                              
                            </div>
           
                             <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save changes</button>
                      </div>
                          
                          
                       
                          </form>
                      
                      </div>
                     
                    </div>
                  </div>
     </div>
</div>
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  
                                                      
      <script>
       $(document).ready(function(){
        $('.editbtn').on('click' ,function(){
          $('#modal-animation-14').modal('show');
          $tr = $(this).closest('tr');
           var data = $tr.children("td").map(function(){
            return $(this).text();
           }).get();
           console.log(data);
           $('#emp_id').val(data[0]);
           $('#emp_name').val(data[1]);
         
          });


    });

    </script>     
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
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endsection