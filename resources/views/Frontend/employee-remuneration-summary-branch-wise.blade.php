@extends('Frontend.employee-report-header')
@extends('Frontend.employee-report-footer')
<body>


        <!--  BEGIN CONTENT AREA  -->
        <div  class="main-content">
                <div class="">
                    <div class="row layout-top-spacing">
                        <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                    	<div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
                                    		<h5 class="data-heading1">The Samaj<span>Report run on: November 23, 2020 2:14 PM</span></h5>
                                            <h3 class="data-heading">EMPLOYEE REMUNERATION SUMMARY(Branch-Wise)</h3>
                                        </div>
                                    </div>
    <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                                    <form style="padding-left: 15px;">
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-12">
                                            <div class="form-group">
                                                <label>Branch:</label>
                                                <select class="form-control">
                                                      <option>All Branch</option>
                                                      <option>Cuttack</option>
                                                      <option>Bhubaneswar</option>
                                                      <option>Sambalpur</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <div class="form-group">
                                                <label>Emp Type:</label>
                                                <select class="form-control">
                                                  <option>All</option>
                                                  <option>Permanent</option>
                                                  <option>Probation</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <div class="form-group">
                                                <label>Category:</label>
                                                <select class="form-control">
                                                      <option>All Category</option>
                                                      <option>All Category</option>
                                                      <option>All Category</option>
                                                </select>
                                            </div>
                                        </div>

                                       <div class="col-lg-3 col-sm-12">
                                            <div class="form-group">
                                                <label>From Month-Year:</label>
                                                    <input type="month" class="form-control" id="start" name="start"
                                                      min="2019-01" value="2019-01">

                                            </div>
                                        </div>


                                         <div class="col-lg-3 col-sm-12">
                                            <div class="form-group">
                                                <label>To Month-Year:</label>
                                                    <input type="month" class="form-control" id="start" name="start"
                                                      min="2019-01" value="2020-01">

                                            </div>
                                        </div>
                                      
                           
               
                           
                           
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Search</label><br>
                                                <button type="submit" class="btn btn-primary report-btn" value="">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>



                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                
                                            </div>
                                        </div>
                                    </div>
                 
                                    
                                </div>
                                <div class="widget-content widget-content-area"  style="padding-bottom: 0px;">
                                	<!-- <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                                	<button class="btn btn-secondary" onclick="window.pdf()"><i class="fa fa-file"></i> Save</button> -->
                                    <div class="table-responsive" style="margin-top: 5px;">
 <table class="table mb-4">
                                          <thead>
                                                <tr>
                                                <th class="t-th" rowspan="2">Sl. No</th>
                                                <th class="t-th" rowspan="2" >Employee Name</th>
                                                <th class="t-th" rowspan="2" >Designation</th>
                                                <th class="t-th" rowspan="2">Department(Presently)</th>
                                                <th class="t-th" colspan="4" style="horizontal-align : middle;text-align:center;  ">For Month Of Apr-2019 To Mar-2020</th>
                                            </tr>

                                            <tr>
                                                <th class="t-th" scope="col">Salary</th>
                                                <th class="t-th" scope="col">HRA</th>
                                                <th class="t-th" scope="col">Other Allowances</th>
                                                <th class="t-th" scope="col">Gross Salary</th>
                                            </tr>
                                            </thead>
                                            
                                            <tbody>
                                              
                                                <tr>
                                                    <td class="text-center">01</td>
                                                    <td class="text-primary">BAMAPADA TRIPATHY</td>
                                                    <td>Editor</td>
                                                    <td>Editorial</td>
                                                    <td class="">820154.00</td>
                                                    <td>.00</td>
                                                    <td>.00</td>
                                                    <td>820154.00</td>
                                                 
                                                </tr>

                                                <tr>
                                                    <td class="text-center">01</td>
                                                    <td class="text-primary">SUSANTA KUMAR MOHANTY</td>
                                                    <td>Executive Editor</td>
                                                    <td>Editorial</td>
                                                    <td class="">820154.00</td>
                                                    <td>.00</td>
                                                    <td>.00</td>
                                                    <td>820154.00</td>
                                                 
                                                </tr>
                                               

                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                <div class="widget-header" style="padding: 20px;">
                                    <div class="row">
                                    	<div class="col-xl-6 col-md-12 col-sm-12 col-12 ">
                                    		<a href="#">Page 1 of 17</a>
                                      </div>
                                        <div class="col-xl-6 col-md-12 col-sm-12 col-12 ">
                                        		<div class="pagination">
      											  <a href="#">&laquo;</a>
      											  <a href="#">1</a>
      											  <a href="#" class="active">2</a>
      											  <a href="#">3</a>
      											  <a href="#">4</a>
      											  <a href="#">5</a>
      											  <a href="#">6</a>
      											  <a href="#">&raquo;</a>
      											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

        </div>
        <!--  END CONTENT AREA  -->

    