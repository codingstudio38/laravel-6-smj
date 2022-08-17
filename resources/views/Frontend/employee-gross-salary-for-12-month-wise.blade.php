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
                                            <h3 class="data-heading">EMPLOYEE GROSS SALARY FOR 
                                            12 MONTH(Month-Wise)</h3>
                                        </div>
                                    </div>
                                      <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                                    <form style="padding-left: 15px;">
                                        <div class="row">
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Emp Type:</label>
                                                <select class="form-control">
                                                  <option>All</option>
                                                  <option>Permanent</option>
                                                  <option>Probation</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
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
                                                <label>From Year Month_1:</label>
                                                    <input type="month" class="form-control" id="start" name="start"
                                                      min="2019-01" value="2019-01">

                                            </div>
                                        </div>


                                         <div class="col-lg-3 col-sm-12">
                                            <div class="form-group">
                                                <label>To Year Month_12:</label>
                                                    <input type="month" class="form-control" id="start" name="start"
                                                      min="2019-01" value="2019-12">

                                            </div>
                                        </div>
                                      
                           
               
                           
                           
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Search</label>
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
                               <!--  	<button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                                	<button class="btn btn-secondary" onclick="window.pdf()"><i class="fa fa-file"></i> Save</button> -->
                                    <div class="table-responsive" style="margin-top: 5px;">
                                        <table class="table mb-4">
                                          <thead>
                                                <tr>
                                                <th class="t-th" rowspan="2">Sl. No</th>
                                                <th class="t-th" rowspan="2" >Employee Type</th>
                                                <th class="t-th" rowspan="2">Emp. Code</th>
                                                <th class="t-th" rowspan="2">Name Of The Employee</th>
                                                <th class="t-th" rowspan="2">Designation</th>
                                                <th class="t-th" rowspan="2">Department</th>
                                                <th class="t-th" colspan="1" style="horizontal-align : middle;text-align:center;  ">Jan-2019</th>
                                                <th class="t-th" colspan="1" style="horizontal-align : middle;text-align:center;  ">Feb-2019</th>
                                                <th class="t-th" colspan="1" style="horizontal-align : middle;text-align:center;  ">March-2019</th>
                                                <th class="t-th" colspan="1" style="horizontal-align : middle;text-align:center;  ">Apr-2019</th>
                                                <th class="t-th" colspan="1" style="horizontal-align : middle;text-align:center;  ">May-2019</th>
                                                <th class="t-th" colspan="1" style="horizontal-align : middle;text-align:center;  ">Jun-2019</th>
                                                
                                                 <th class="t-th" rowspan="2">Total</th>
                                            </tr>

                                            <tr>
                                                <th class="t-th" scope="col" style="horizontal-align : middle;text-align:center;  ">Jul-2019</th>
                                                <th class="t-th" scope="col" style="horizontal-align : middle;text-align:center;  ">Aug-2019</th>
                                                <th class="t-th" scope="col" style="horizontal-align : middle;text-align:center;  ">Sep-2019</th>
                                                <th class="t-th" scope="col" style="horizontal-align : middle;text-align:center;  ">Oct-2019</th>
                                                <th class="t-th" scope="col" style="horizontal-align : middle;text-align:center;  ">Nov-2019</th>
                                                <th class="t-th" scope="col" style="horizontal-align : middle;text-align:center;  ">Dec-2019</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                              <tr>
                                                    <td class="text-center"><h5>Working Journalists</h5></td>
                                                    <td class="text-primary"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="text-center">01</td>
                                                    <td class="text-primary">Permanent</td>
                                                    <td>007</td>
                                                    <td>SUSANTA KUMAR MOHANTY</td>
                                                    <td>Executive Editor</td>
                                                    <td>Editorial</td>
                                                    <td class=""><span class="t-body">74590.00</span>
                                                      <span class="t-body">83421.00</span></td>
                                                    <td class=""><span class="t-body">8995.00</span>
                                                      <span class="t-body">1800.00</span></td>
                                                      <td class=""><span class="t-body">73315.00</span>
                                                      <span class="t-body">81178.00</span></td>
                                                    <td class=""><span class="t-body">76561.00</span>
                                                      <span class="t-body">83346.00</span></td>
                                                      <td class=""><span class="t-body">78681.00</span>
                                                      <span class="t-body">85589.00</span></td>
                                                    <td class=""><span class="t-body">76111.00</span>  
                                                      <span class="t-body">81328.00</span></td>
                                                      <td>951660.00</td>

                                                </tr>
                                                
                                                <tr>
                                                    <td class="text-center">02</td>
                                                    <td class="text-primary">Permanent</td>
                                                    <td>009</td>
                                                    <td>ALOK KUMAR PATI</td>
                                                    <td>Sub-Editor</td>
                                                    <td>Editorial</td>
                                                    <td class=""><span class="t-body">25670.00</span>
                                                      <span class="t-body">4000.00</span></td>
                                                    <td class=""><span class="t-body">8995.00</span>
                                                      <span class="t-body">1800.00</span></td>
                                                      <td class=""><span class="t-body">25670.00</span>
                                                      <span class="t-body">4000.00</span></td>
                                                    <td class=""><span class="t-body">8995.00</span>
                                                      <span class="t-body">1800.00</span></td>
                                                      <td class=""><span class="t-body">25670.00</span>
                                                      <span class="t-body">4000.00</span></td>
                                                    <td class=""><span class="t-body">8995.00</span>  
                                                      <span class="t-body">1800.00</span></td>
                                                      <td>671577.00 </td>

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

      <!--  -->