@extends('Frontend.footer')

@extends('Frontend.inner_master')
  
@section('content')
 <div id="content" class="main-content">
            <div class="layout-px-spacing">                
                <div class="account-settings-container layout-top-spacing">
                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
 @if (Auth::user()->role!=="User" && Auth::user()->role!=="Finance Staff")                               
    <form id="general-info" class="section general-info" style="height: 570px;"  action="{{url('/')}}/userData" method="post">
    {!! csrf_field() !!}  

        <div class="info">
            <h6 class="">USER MAINTENANCE</h6>
                <div class="col-lg-6 mx-auto user-maintenance">
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
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{url('/')}}/public/assets/js/libs/jquery-3.1.1.min.js"></script>
   <script type="text/javascript">
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

   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 @if(Session::has('data-added'))

<script type="text/javascript">
    swal("great job","{!! Session::get('data-added') !!}","success",{
        button:"OK", 
    })

</script>
@endif
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

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="{{url('/')}}/public/plugins/dropify/dropify.min.js"></script>
    <script src="{{url('/')}}/public/plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="{{url('/')}}/public/assets/js/users/account-settings.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
</body>
</html>
<script>
    let msg = '{{Session::get('alert')}}';
    let exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }

  </script>

@endsection