@extends('Frontend.footer')

@extends('Frontend.inner_master')

@section('content')
        <!--  BEGIN CONTENT AREA  -->
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
                                            <h5 class="">EMPLOYEE PERFORMANCE APPRAISAL / ASSESSMENT FORM</h5>
                                            <div class="row emp-sec">
                                                <div class="col-md-11 mx-auto">
                                                    <div class="form-group row">
                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Employee Name:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="inputEmail" placeholder="Name">
                                                        </div>

                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Employee Code:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" placeholder="Emp Code">
                                                        </div>

                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Designation:</label>&nbsp;&nbsp;&nbsp;
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control" id="inputEmail" placeholder="Designation">
                                                        </div>
                                                    </div>
                                               

                                                    <div class="form-group row">
                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Department:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="inputEmail" placeholder="Department">
                                                        </div>

                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Reporting Authority:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" placeholder="Reporting Authority">
                                                        </div>

                                                        <label for="inputEmail" class="col-sm-1 col-form-label text-right">Date Of Joining:</label>&nbsp;&nbsp;&nbsp;
                                                        <div class="col-sm-2">
                                                            <input type="date" class="form-control" id="inputEmail" placeholder="Qualification">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Principal Evaluator:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="inputEmail" placeholder="Principal Evaluator">
                                                        </div>

                                                        <label for="inputEmail" class="col-sm-1 col-form-label">Employee Type:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" placeholder="Reporting Authority">
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
                                                            <h6 class="a-head">SELF ASSESSMENT / APPRAISAL FORM</h6>
                                                            <P>(Must be filled by the employee with at least 3 points for each feature.Write NA which is not necessary)</P>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <h6 class="a-head">Personnel Trait</h6>
                                                            
                                                        </div>

                                                        <div class="col-md-12">
                                                            <table class="table">
                                                            <thead>
                                                            <tr class="text-center">
                                                            <th scope="col">Features</th>
                                                            <th scope="col">Self ASSESSMENT<p>(Report must be in descriptive Mode)</p></th>
                                                            <th scope="col">Appraiser's Remarks</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                            <tr>
                                                            <td><strong>Team Sprit / Cooperativeness</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Career Oriented</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Self Motivation</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Strength</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Weakness</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Oppertunity</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Threat</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>
                                                            </tbody>
                                                            </table>
                                                            <h6 class="a-head">Organizational Trait</h6>
                                                            <table class="table">
                                                            <thead>
                                                            <tr class="text-center">
                                                            <th scope="col">Features</th>
                                                            <th scope="col">Self ASSESSMENT<p>(Report must be in descriptive Mode)</p></th>
                                                            <th scope="col">Appraiser's Remarks</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                            <tr>
                                                            <td><strong>Job Knowledge</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Quality, Ability & Sincerity At Work</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Career Achievement</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Innovatives/ Initiatives</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Problem Solving / Risk Taking</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Leadership / Managerial Skill</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Suggestions For Self Development</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>
                                                            </tbody>
                                                            </table>

                                                            <h6 class="a-head">Professional Trait</h6>
                                                            <table class="table">
                                                            <thead>
                                                            <tr class="text-center">
                                                            <th scope="col">Features</th>
                                                            <th scope="col">Self ASSESSMENT<p>(Report must be in descriptive Mode)</p></th>
                                                            <th scope="col">Appraiser's Remarks</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                            <tr>
                                                            <td><strong>Assignment Knowledge</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Behaviour / Attitude</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Relationship With Co-Workers/ Seniors/ Sub-Ordinates</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Target vs Achievement</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Special Achievement(If Any)</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Knowledge About Competitors</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Errors & Mistakes</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Recommended Steps For Organizational Growth</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>
                                                            </tbody>
                                                            </table>

                                                            <h6 class="a-head">Report Summary:</h6>
                                                            <table class="table">
                                                            <thead>
                                                            <tr class="text-center">
                                                            <th scope="col">Areas</th>
                                                            <th scope="col">Department Head</th>
                                                            <th scope="col">Principal Evaluator</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                            <tr>
                                                            <td><strong>Areas Need Improvement</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Need Of Training & Development</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Need Of Job Rotation</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Suggested Method For Improvement</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>

                                                            <tr>
                                                            <td><strong>Remarks</strong></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            <td><textarea class="form-control"></textarea></td>
                                                            </tr>
                                                            </tbody>
                                                            </table>


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