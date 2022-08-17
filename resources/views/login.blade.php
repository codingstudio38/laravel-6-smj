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
    <link href="{{url('/')}}/public/assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/assets/css/forms/switches.css">
    <style type="text/css">
            body  {
  background-image: url("{{url('/')}}/public/assets/img/bg-banner.png");
  background-color: #cccccc;
  background-size: cover;
}
    </style>
</head>
<body class="form">
    

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <a class="navbar-brand" href="#"><img alt="logo" src="{{url('/')}}/public/assets/img/logo3.png"></a>
                        <h1 class="">Sign In</h1>
                        <!-- <p class="">Log in to your account to continue.</p> -->
                        
                        <form class="text-left" method="POST" action="{{ route('login') }}">
                          {!! csrf_field() !!}
                            <div class="form">
                               
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USER ID</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus onKeyUp="fetchrole(this.value)">
                                     @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                        <a href="#" class="forgot-pass-link" onclick="return confirm('Contact To System Administration ');">Forgot Password?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" style="height: 42px;">
                                       @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                            </div>
                            <!--  <div id="email-field" class="field-wrapper input">
                                    <label for="email">USER TYPE</label>
                                    <input id="role" type="text" class="form-control" name="role_id" readonly>
                                </div> -->
                             
                        <div class="d-sm-flex justify-content-between" style="width: 100%">
                            <div class="field-wrapper">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a> -->
                            </div>
                        </div>
                     

                    </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{url('/')}}/public/assets/js/libs/jquery-3.1.1.min.js"></script>
<!--     <script>
        function fetchrole(email){
            if(email != ''){
                   var _token = $('input[name="_token"]').val();
                     $.ajax({
                      url:"{{url('/fetchrole')}}",
                      method:"POST",
                     dataType:'json',
                      data:{
                        "_token":"{{csrf_token()}}",
                        email:email,
                        },
                       success:function(data){
                       //alert(data);
                        $('#role').val(data.role);
                        //alert(data.role);
                       
                          }
                     });
                   }
          
         }  

          

  </script> -->
    <script src="{{url('/')}}/public/bootstrap/js/popper.min.js"></script>
    <script src="{{url('/')}}/public/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{url('/')}}/public/assets/js/authentication/form-2.js"></script>

</body>

</html>