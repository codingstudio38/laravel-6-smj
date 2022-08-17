@extends('Frontend.footer')

@extends('Frontend.inner_master')

@section('content')
<div id="content" class="main-content">
            <div class="layout-px-spacing">                
                    
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                                      <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="contact" class="section contact">
                                        <div class="form-group" style="text-align: right;color: white;" >
                          <button type="submit" class="btn btn button1"
                           style="background-color: #1b55e2;">
                         Save</button>
                        </div> 
                                        <div class="info">
                                            <h5 class="">CONFIDENTIAL CHARACTER ROLL(CCR)/PERFORMANCE APPRAISAL(PA) REPORT FOR THE YEAR 2017</h5>
                                            <div class="row emp-sec">
                                                <div class="col-md-11 mx-auto">
                                                    <div class="form-group row">
                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Name:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="inputEmail" placeholder="Name">
                                                        </div>

                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Date Of Birth:</label>
                                                        <div class="col-sm-3">
                                                            <input type="date" class="form-control">
                                                        </div>

                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Qualification:</label>&nbsp;&nbsp;&nbsp;
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control" id="inputEmail" placeholder="Qualification">
                                                        </div>
                                                    </div>
                                               

                                                    <div class="form-group row">
                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Designation:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="inputEmail" placeholder="Designation">
                                                        </div>

                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Grade/Dept:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" placeholder="Grade/ Dept">
                                                        </div>

                                                        <label for="inputEmail" class="col-sm-1 col-form-label text-right">Date Of Joining:</label>&nbsp;&nbsp;&nbsp;
                                                        <div class="col-sm-2">
                                                            <input type="date" class="form-control" id="inputEmail" placeholder="Qualification">
                                                        </div>
                                                    </div>

                                                
                                                    <div class="row">
                                                        <!-- <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="country">Name:</label>
                                                                <input type="text" class="form-control mb-4" id="address" placeholder="Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="address">Date Of Birth:</label>
                                                                <input type="date" class="form-control mb-4" id="address" placeholder="Address" value="New York" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="location">Qualification:</label>
                                                                <input type="text" class="form-control mb-4" id="location" placeholder="Qualification">
                                                            </div>
                                                        </div> -->
                                                      <!--   <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="phone">Designation:</label>
                                                                <input type="text" class="form-control mb-4" id="phone" placeholder="Designation">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="email">Grade/Dept:</label>
                                                                <input type="text" class="form-control mb-4" id="email" placeholder="Grade/Dept">
                                                            </div>
                                                        </div>                                    
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="website1">Date Of Joining</label>
                                                                <input type="date" class="form-control mb-4" id="website1">
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row emp-sec">
                                                
                                                <div class="col-md-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h6 class="a-head">ATTENDANCE/DAYS</h6>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table">
                                                            <thead>
                                                            <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">January-March</th>
                                                            <th scope="col">April-June</th>
                                                            <th scope="col">July-September</th>
                                                            <th scope="col">October-december</th>
                                                            <th scope="col">Total</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                            <tr>
                                                            <th scope="row">Leave Availed</th>
                                                            <td><input type="text" class="form-control" name="" value="10"></td>
                                                            <td><input type="text" class="form-control" name="" value="7"></td>
                                                            <td><input type="text" class="form-control" name="" value="15"></td>
                                                            <td><input type="text" class="form-control" name="" value="12"></td>
                                                            <td><input type="text" class="form-control" name="" value="44"></td>
                                                            </tr>
                                                            </tbody>
                                                            </table>

                                                        </div>
                                   
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row emp-sec">
                                                
                                                <div class="col-md-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h6 class="a-head">RATING CHART</h6>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table">
                                                            <thead>
                                                            <tr>
                                                            <th scope="col">Assessment</th>
                                                            <th scope="col">Very Good</th>
                                                            <th scope="col">Good</th>
                                                            <th scope="col">Satisfactory</th>
                                                            <th scope="col">Average</th>
                                                            <th scope="col">Poor</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                            <tr>
                                                            <th scope="row">Rating</th>
                                                            <td>5</td>
                                                            <td>4</td>
                                                            <td>3</td>
                                                            <td>2</td>
                                                            <td>1</td>
                                                            </tr>

                                                            <tr>
                                                            <th scope="row">Attendance</th>
                                                            <td>285 & above</td>
                                                            <td>265 to 284</td>
                                                            <td>240 to 264</td>
                                                            <td>230 to 239</td>
                                                            <td>229 & below</td>
                                                            </tr>
                                                            </tbody>
                                                            </table>

                                                        </div>
                                   
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row emp-sec">
                                                
                                                <div class="col-md-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h6 class="a-head"><span>Rating Should be as per the above mentioned</span> RATING CHART</h6>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table">
                                                            <thead>
                                                            <tr>
                                                            <th scope="col">SN</th>
                                                            <th scope="col">Factor</th>
                                                            <th scope="col">Weight</th>
                                                            <th scope="col">Rating</th>
                                                            <th scope="col">Factor Score(Weight x Rating)</th>
                                                            <th scope="col">Remarks(If any)</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                            <tr>
                                                            <td><strong>01.</strong></td>
                                                            <td>Attendance</td>
                                                            <td>2</td>
                                                            <td><input type="text" class="form-control" name="" value="A"></td>
                                                            <td><input type="text" class="form-control" name="" value="A+"></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>02.</strong></td>
                                                            <td>Discipline & Punctuality at work</td>
                                                            <td>2</td>
                                                            <td><input type="text" class="form-control" name="" value="A"></td>
                                                            <td><input type="text" class="form-control" name="" value="A+"></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>03.</strong></td>
                                                            <td>Knowledge vs Performance on job</td>
                                                            <td>3</td>
                                                            <td><input type="text" class="form-control" name="" value="A"></td>
                                                            <td><input type="text" class="form-control" name="" value="A+"></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>04.</strong></td>
                                                            <td>Initiative/Innovative/ Resourcefulness</td>
                                                            <td>2</td>
                                                            <td><input type="text" class="form-control" name="" value="A"></td>
                                                            <td><input type="text" class="form-control" name="" value="A+"></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>05.</strong></td>
                                                            <td>Promptness/ Accuracy in performance</td>
                                                            <td>2</td>
                                                            <td><input type="text" class="form-control" name="" value="A"></td>
                                                            <td><input type="text" class="form-control" name="" value="A+"></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>06.</strong></td>
                                                            <td>Leadership/ potential for Higher Responsibility</td>
                                                            <td>2</td>
                                                            <td><input type="text" class="form-control" name="" value="A"></td>
                                                            <td><input type="text" class="form-control" name="" value="A+"></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>07.</strong></td>
                                                            <td>Self Awareness / Self Confidence & Communication Skills</td>
                                                            <td>2</td>
                                                            <td><input type="text" class="form-control" name="" value="A"></td>
                                                            <td><input type="text" class="form-control" name="" value="A+"></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>08.</strong></td>
                                                            <td>Behaviour / Attitude to co-employees & Customers/ Associates</td>
                                                            <td>2</td>
                                                            <td><input type="text" class="form-control" name="" value="A"></td>
                                                            <td><input type="text" class="form-control" name="" value="A+"></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>09.</strong></td>
                                                            <td>Adaptability / Acceptability for Change</td>
                                                            <td>2</td>
                                                            <td><input type="text" class="form-control" name="" value="A"></td>
                                                            <td><input type="text" class="form-control" name="" value="A+"></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>10.</strong></td>
                                                            <td>Cost & Quality Consciousness</td>
                                                            <td>1</td>
                                                            <td><input type="text" class="form-control" name="" value="A"></td>
                                                            <td><input type="text" class="form-control" name="" value="A+"></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>
                                                            <tr>
                                                            <td><strong>#</strong></td>
                                                            <td><strong>TOTAL FACTOR SCORE(TFS)</strong></td>
                                                            <td><input type="text" class="form-control" name="" value=""></td>
                                                            <td><input type="text" class="form-control" name="" value=""></td>
                                                            <td><input type="text" class="form-control" name="" value=""></td>
                                                            <td><textarea class="form-control" style="height: 40px;"></textarea></td>
                                                            </tr>
                                                            </tbody>
                                                            </table>

                                                        </div>
                                   
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row emp-sec">
                                                
                                                <div class="col-md-11 mx-auto">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="website1">Details of Rewards / Punishment or other remarks if any:</label>
                                                                <textarea class="form-control" style="height: 40px;"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="website1">Name & Designation of Assessing Officer:</label>
                                                                <input type="text" class="form-control" name="">
                                                            </div>
                                                        </div>
                                                         <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="website1">Date:</label>
                                                                <input type="date" class="form-control" name="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="website1">Remarks:</label>
                                                                <textarea class="form-control" style="height: 40px;"></textarea>
                                                            </div>
                                                        </div>

                                                         <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="website1">Name & Designation of Reviewing Officer:</label>
                                                                <input type="text" class="form-control" name="">
                                                            </div>
                                                        </div>
                                                         <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="website1">Date:</label>
                                                                <input type="date" class="form-control" name="">
                                                            </div>
                                                        </div>


                                   
                                                    </div>
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
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
  <style type="text/css">

/*tbody {
    display:block;
    height:500px;
    overflow:auto;
}
thead, tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;
}
thead {
    width: calc( 100% - 1em )
}*/
/*table {
    width:400px;
    border:1px solid #191e3a!important;
}*/

  </style>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{url('/')}}/public/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{url('/')}}/public/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{url('/')}}/public/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('/')}}/public/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{url('/')}}/public/assets/js/app.js')}}"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{url('/')}}/public/assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="{{url('/')}}/public/plugins/dropify/dropify.min.js')}}"></script>
    <script src="{{url('/')}}/public/plugins/blockui/jquery.blockUI.min.js')}}"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="{{url('/')}}/public/assets/js/users/account-settings.js')}}"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
</body>
</html>
@endsection