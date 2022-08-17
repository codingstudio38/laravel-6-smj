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
                                            3 FINANCIAL YEAR(Year-Wise)</h3>
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

                                       <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Financial Year_1:</label>
                                                    <select name="month" class="form-control">
                                                          <option value="2030">2017-18</option>
                                                          <option value="2029">2018-19</option>
                                                          <option value="2028">2019-20</option>
                                                          <option value="2027">2020-21</option>
                                                          <option value="2026">2021-22</option>
                                                          <option value="2025">2022-23</option>
                                                          <option value="2024">2023-24</option>
                                                          <option value="2023">2024-25</option>
                                                          <option value="2022">2025-26</option>
                                                          <option value="2021">2026-27</option>
                                                          <option value="2020">2027-28</option>
                                                          <option value="2019">2028-29</option>
                                                          <option value="2018">2029-30</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Financial Year_2:</label>
                                                    <select name="month" class="form-control">
                                                          <option value="2030">2017-18</option>
                                                          <option value="2029">2018-19</option>
                                                          <option value="2028">2019-20</option>
                                                          <option value="2027">2020-21</option>
                                                          <option value="2026">2021-22</option>
                                                          <option value="2025">2022-23</option>
                                                          <option value="2024">2023-24</option>
                                                          <option value="2023">2024-25</option>
                                                          <option value="2022">2025-26</option>
                                                          <option value="2021">2026-27</option>
                                                          <option value="2020">2027-28</option>
                                                          <option value="2019">2028-29</option>
                                                          <option value="2018">2029-30</option>
                                                    </select>
                                            </div>
                                        </div>
                           
                           <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Financial Year_3:</label>
                                                    <select name="month" class="form-control">
                                                          <option value="2030">2017-18</option>
                                                          <option value="2029">2018-19</option>
                                                          <option value="2028">2019-20</option>
                                                          <option value="2027">2020-21</option>
                                                          <option value="2026">2021-22</option>
                                                          <option value="2025">2022-23</option>
                                                          <option value="2024">2023-24</option>
                                                          <option value="2023">2024-25</option>
                                                          <option value="2022">2025-26</option>
                                                          <option value="2021">2026-27</option>
                                                          <option value="2020">2027-28</option>
                                                          <option value="2019">2028-29</option>
                                                          <option value="2018">2029-30</option>
                                                    </select>
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
                                	<!-- <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                                	<button class="btn btn-secondary" onclick="window.pdf()"><i class="fa fa-file"></i> Save</button> -->
                                    <div class="table-responsive" style="margin-top: 5px;">
                                        <table class="table mb-4">
                                          <thead>
                                                <tr>
                                                <th class="t-th" rowspan="2">Sl. No</th>
                                                <th class="t-th" rowspan="2" >Employee Type</th>
                                                <th class="t-th" rowspan="2" >Employee Code</th>
                                                <th class="t-th" rowspan="2">Name Of The Employee</th>
                                                <th class="t-th" rowspan="2">Designation</th>
                                                <th class="t-th" rowspan="2">Department</th>
                                                <th class="t-th" colspan="3" style="horizontal-align : middle;text-align:center;  ">Total Gross Salary</th>
                                                <th class="t-th" rowspan="2">Total</th>
                                            </tr>

                                            <tr>
                                                <th class="t-th" scope="col">2017-18</th>
                                                <th class="t-th" scope="col">2018-19</th>
                                                <th class="t-th" scope="col">2019-20</th>
                                            </tr>
                                            </thead>
                                            
                                            <tbody>
                                              <tr>
                                                  <td class="text-center"><h5>WORKING JOURNALISTS</h5></td>
                                                  <td ></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td class=""></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">01</td>
                                                    <td class="text-primary">Permanent</td>
                                                    <td>005</td>
                                                    <td>TAPASH KUMAR MISHRA</td>
                                                    <td class="">News Editor</td>
                                                    <td>Editorial</td>
                                                    <td>968355.00</td>
                                                    <td>24478.00</td>
                                                    <td>125640.00</td>
                                                    <td>992833.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">02</td>
                                                    <td class="text-primary">Permanent</td>
                                                    <td>007</td>
                                                    <td>SUSANTA KUMAR MOHANTY</td>
                                                    <td class="">Executive Editor</td>
                                                    <td>Editorial</td>
                                                    <td>862190.00</td>
                                                    <td>913139.00</td>
                                                    <td>955501.00</td>
                                                    <td>2730830.00</td>
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
        <!--  END CONTENT AREA  -->
       