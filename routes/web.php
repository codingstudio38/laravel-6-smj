<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('login');
});
Auth::routes();
//Route::get('/resetdata', 'HomeController@resetdata');
//Route::get('/changedata','HomeController@changedata');
// Route::get('/oracle_db', 'UserController@update_contract_details');
Route::get('/Employee_last_Recordview', 'HomeController@EmployeelastRecordview');
Route::get('/Employee_first_Recordview', 'HomeController@EmployeefirstRecordview');
Route::get('/Employee_Next_Recordview', 'HomeController@EmployeeNextRecordview');
Route::get('/Employee_Prev_Recordview', 'HomeController@EmployeePreviousRecordview');
Route::get('/Employee_delete_Recordview','HomeController@EmpDeleteRecordview');

Route::get('/autocomplete', 'AutocompleteController@index');
Route::post('/autocomplete/fetch', 'AutocompleteController@fetch')->name('autocomplete.fetch');
Route::post('/fetchrole', 'UserController@fetchrole');

Route::group(['middleware' =>['preventbackhistory','auth']],function(){
Route::get('/designation-master', function () {
    return view('Frontend.designation-master');
});

Route::get('/delete_doc', 'HomeController@delete_doc')->middleware('auth');

Route::get('/designation-master', 'HomeController@Designation_Master_view')->middleware('auth');
Route::post('/add-designation-master', 'HomeController@Add_Designation_Master')->middleware('auth');
Route::post('/Update_Designation_Data','HomeController@Update_Designation_data')->middleware('auth');
Route::get('delete_Designation_data/{id}','HomeController@Delete_Designation_data')->middleware('auth');



Route::get('/department-master', 'HomeController@Department_Master_view')->middleware('auth');
Route::post('/add-department-master', 'HomeController@Add_Department')->middleware('auth');
Route::post('/Update_Department_Data','HomeController@Update_Department_Data')->middleware('auth');
Route::get('delete_Department_data/{id}','HomeController@Delete_Department_data')->middleware('auth');



Route::get('/pay-grade-master', 'HomeController@Paygrade_view')->middleware('auth');
Route::post('/add-pay-grade-master', 'HomeController@AddPaygrade')->middleware('auth');
Route::post('/Update-pay-grade-master', 'HomeController@Update_Paygrade_Data')->middleware('auth');
Route::get('delete_pay-grade_data/{id}','HomeController@Delete_Paygrade_data')->middleware('auth');
Route::post('fetch_paygrade_details/{id}','HomeController@fetch_paygrade_details')->middleware('auth');



// Route::get('/user-maintenance', function () {
//     return view('Frontend.user-maintenance');
// });

Route::get('/board-university', 'HomeController@Board_view')->middleware('auth');
Route::post('/add-board-university', 'HomeController@AddBoard')->middleware('auth');
Route::post('/Update_Board_data','HomeController@Update_Board_data')->middleware('auth');
Route::get('delete_Board_data/{id}','HomeController@Delete_Board_data')->middleware('auth');

Route::get('/workplace', 'HomeController@Work_place_view')->middleware('auth');
Route::post('/add-work-place', 'HomeController@AddWorkplace')->middleware('auth');
Route::post('/Update_Work_place','HomeController@Update_WorkPlace_data')->middleware('auth');
Route::get('delete_Work_place/{id}','HomeController@Delete_WorkPlace_data')->middleware('auth');

Route::get('/bank', 'HomeController@Bank_view')->middleware('auth');
Route::post('/add-bank', 'HomeController@AddBank')->middleware('auth');
Route::post('/Update_Bank_data','HomeController@Update_Bank_Data')->middleware('auth');
Route::get('delete_Bank_data/{id}','HomeController@Delete_Bank_data')->middleware('auth');

 
Route::get('/category', 'HomeController@Category_Master_view')->middleware('auth');
Route::post('/add-category', 'HomeController@AddCategory')->middleware('auth');
Route::post('/Update_Category_data','HomeController@Update_Category_Data')->middleware('auth');
Route::get('delete_Category_data/{id}','HomeController@Delete_category_data')->middleware('auth');



Route::get('/employee_type', 'HomeController@EmployeeType_Master_view')->middleware('auth');
Route::post('/add-employee-type', 'HomeController@AddEmployeeType')->name('HomeController.AddEmployeeMaster');
Route::post('/Update_employee-type','HomeController@Update_EmployeeType_Data')->middleware('auth');
Route::get('delete_Emp_type_data/{id}','HomeController@Delete_employee_type_data')->middleware('auth');

 
Route::get('/edit_login_access', 'UserController@Editloginaccess')->middleware('auth');
Route::post('/edit_login_access', 'UserController@EditloginaccessPOST')->middleware('auth');
Route::get('/user-maintenance', 'UserController@user_maintenance')->middleware('auth');
Route::get('/user-profile', 'UserController@user_profile')->middleware('auth');
Route::get('/employee_list', 'HomeController@employee_list')->middleware('auth');
Route::get('/employee_master', 'HomeController@Employee_view')->middleware('auth');
Route::get('/employee_edit_master', 'HomeController@allEmployeDetails')->middleware('auth');
Route::post('/add-employee-master', 'HomeController@AddEmployeeMaster')->middleware('auth');
Route::get('/delete_empremark/{id}/{emp_id}', 'HomeController@delete_empremark')->middleware('auth');
Route::post('/AddEmployeeMasterOfficial', 'HomeController@AddEmployeeMasterOfficial')->middleware('auth');
Route::post('/updateEmployeeDetails','HomeController@updateEmployeeDetails')->middleware('auth');
Route::post('/delete_dependent', 'HomeController@depdelete')->middleware('auth');
Route::post('/delete_qualification', 'HomeController@deletequali')->middleware('auth');
Route::post('/delete_organization', 'HomeController@deleteorganization')->middleware('auth');
Route::post('/delete_transfer', 'HomeController@deletetransfer')->middleware('auth');
Route::post('/delete_promotion', 'HomeController@deletepromotion')->middleware('auth');
Route::post('/delete_probation', 'HomeController@deleteprobation')->middleware('auth');
Route::post('/delete_contract', 'HomeController@contractdelete')->middleware('auth');
Route::post('/delete_antecedent', 'HomeController@antecedentdelete')->middleware('auth');
Route::post('/delete_revocation', 'HomeController@revocationdelete')->middleware('auth');
Route::post('/delete_intiation', 'HomeController@delete_intiation')->middleware('auth');
Route::post('/deleteachievement', 'HomeController@deleteachievement')->middleware('auth');
Route::post('/delete_appreciation', 'HomeController@appreecitaiondelete')->middleware('auth');
Route::post('/delete_reward', 'HomeController@rewarddelete')->middleware('auth');
Route::post('/getPackage', 'HomeController@getPackage')->middleware('auth');
Route::post('/getPromotion', 'HomeController@getPromotion')->middleware('auth');
Route::post('/gettoPromotion', 'HomeController@gettoPromotion')->middleware('auth');
Route::post('/getProbation', 'HomeController@gettoProbation')->middleware('auth');

/*
Route::get('/employee_edit_master', function () {
    return view('Frontend.edit_profile');
});*/
 
Route::post('/getEmailuser', 'UserController@getEmailuser')->middleware('auth');
Route::post('/getEmailDetails', 'UserController@getEmailDetails')->middleware('auth');
Route::post('/Update_User_Data','UserController@Update_User_Data')->middleware('auth');
Route::post('/userData', 'UserController@store')->middleware('auth');
Route::get('/regular-employee', function () {
    return view('Frontend.regular-employee');
});
Route::get('/contract-employee', function () {
    return view('Frontend.contract-employee');
});

 
///
Route::get('/employee-list-category-wise','ReportsController@index')->middleware('auth');
Route::get('/employee-list-category-wise-print','ReportsControllerPrint@index')->middleware('auth');
Route::get('/employee-list-category-wise-xl','ReportsControllerExcel@index')->middleware('auth');


Route::get('/employee-list-department-wise','ReportsController@emp_department_report')->middleware('auth');
Route::get('/employee-list-department-wise-print','ReportsControllerPrint@emp_department_report')->middleware('auth');
Route::get('/employee-list-department-wise-xl','ReportsControllerExcel@emp_department_report')->middleware('auth');

Route::get('/employee-list-pay-grade-wise','ReportsController@emp_pay_report')->middleware('auth');
Route::get('/employee-list-pay-grade-wise-print','ReportsControllerPrint@emp_pay_report')->middleware('auth');
Route::get('/employee-list-pay-grade-wise-xl','ReportsControllerExcel@emp_pay_report')->middleware('auth'); 

Route::get('/employee-list-email-category-code-wise','ReportsController@emp_email_report')->middleware('auth');
Route::get('/employee-list-email-category-code-wise-print','ReportsControllerPrint@emp_email_report')->middleware('auth');
Route::get('/employee-list-email-category-code-wise-xl','ReportsControllerExcel@emp_email_report')->middleware('auth');


Route::get('/employee-list-pan-category-wise','ReportsController@emp_pan_report')->middleware('auth'); 
Route::get('/employee-list-pan-category-wise-print','ReportsControllerPrint@emp_pan_report')->middleware('auth'); 
Route::get('/employee-list-pan-category-wise-xl','ReportsControllerExcel@emp_pan_report')->middleware('auth'); 

Route::get('/employee-master-list','ReportsController@emp_master_list')->middleware('auth'); 
Route::get('/employee-master-list-print','ReportsControllerPrint@emp_master_list')->middleware('auth'); 
Route::get('/employee-master-list-xl','ReportsControllerExcel@emp_master_list')->middleware('auth'); 

Route::get('/employee-master-list-with-joining-period','ReportsController@emp_master_list_joining_period')->middleware('auth'); 
Route::get('/employee-master-list-with-joining-period-print','ReportsControllerPrint@emp_master_list_joining_period')->middleware('auth'); 
Route::get('/employee-master-list-with-joining-period-xl','ReportsControllerExcel@emp_master_list_joining_period')->middleware('auth');

Route::get('/birthday-fall-report','ReportsController@emp_birthday_report')->middleware('auth');
Route::get('/birthday-fall-report-print','ReportsControllerPrint@emp_birthday_report')->middleware('auth');
Route::get('/birthday-fall-report-xl','ReportsControllerExcel@emp_birthday_report')->middleware('auth');


Route::get('/contract-completion-report','ReportsController@emp_completion_report')->middleware('auth');
Route::get('/contract-completion-report-print','ReportsControllerPrint@emp_completion_report')->middleware('auth');
Route::get('/contract-completion-report-xl','ReportsControllerExcel@emp_completion_report')->middleware('auth');

Route::get('/probation-completion-report','ReportsController@emp_probation_completion_report')->middleware('auth');
Route::get('/probation-completion-report-print','ReportsControllerPrint@emp_probation_completion_report')->middleware('auth');
Route::get('/probation-completion-report-xl','ReportsControllerExcel@emp_probation_completion_report')->middleware('auth');

Route::get('/retirement-due-reports','ReportsController@emp_retirement_due_report')->middleware('auth');
Route::get('/retirement-due-reports-print','ReportsControllerPrint@emp_retirement_due_report')->middleware('auth');
Route::get('/retirement-due-reports-xl','ReportsControllerExcel@emp_retirement_due_report')->middleware('auth');

Route::get('/retired-employees-detail-reports','ReportsController@emp_retired_report')->middleware('auth');
Route::get('/retired-employees-detail-reports-print','ReportsControllerPrint@emp_retired_report')->middleware('auth');
Route::get('/retired-employees-detail-reports-xl','ReportsControllerExcel@emp_retired_report')->middleware('auth');

Route::get('/employee-official-information-details-report','ReportsController@emp_official_dtl_report')->middleware('auth');
Route::get('/employee-official-information-details-report-print','ReportsControllerPrint@emp_official_dtl_report')->middleware('auth');
Route::get('/employee-official-information-details-report-xl','ReportsControllerExcel@emp_official_dtl_report')->middleware('auth');

Route::get('/employee-personal-information-details-report','ReportsController@emp_personal_dtl_report')->middleware('auth');
Route::get('/employee-personal-information-details-report-print','ReportsControllerPrint@emp_personal_dtl_report')->middleware('auth');
Route::get('/employee-personal-information-details-report-xl','ReportsControllerExcel@emp_personal_dtl_report')->middleware('auth');


Route::get('/employee-contract-renewal-details-report','ReportsController@emp_contract_renewal_report')->middleware('auth');
Route::get('/employee-contract-renewal-details-report-print','ReportsControllerPrint@emp_contract_renewal_report')->middleware('auth');
Route::get('/employee-contract-renewal-details-report-xl','ReportsControllerExcel@emp_contract_renewal_report')->middleware('auth');


 
Route::get('/employee-master-data-report','ReportsController@emp_data_dtl_report')->middleware('auth');
Route::get('/employee-master-data-report-print','ReportsControllerPrint@emp_data_dtl_report')->middleware('auth');
Route::get('/employee-master-data-report-xl','ReportsControllerExcel@emp_data_dtl_report')->middleware('auth');


Route::get('/employee-qualification-experience-details-report','ReportsController@emp_qualification_experience_dtl_report')->middleware('auth');
Route::get('/employee-qualification-experience-details-report-print','ReportsControllerPrint@emp_qualification_experience_dtl_report')->middleware('auth');
Route::get('/employee-qualification-experience-details-report-xl','ReportsControllerExcel@emp_qualification_experience_dtl_report')->middleware('auth');


Route::get('/employee-yr-of-service-qualification-pay-grade-details','ReportsController@emp_service_pay_dtl_report')->middleware('auth');
Route::get('/employee-yr-of-service-qualification-pay-grade-details-print','ReportsControllerPrint@emp_service_pay_dtl_report')->middleware('auth');
Route::get('/employee-yr-of-service-qualification-pay-grade-details-xl','ReportsControllerExcel@emp_service_pay_dtl_report')->middleware('auth');
 
 


// Reports2Controller
Route::get('/employees-basic-pay-pp1-pp2-allowance-list','Reports2Controller@bsp_pp1_pp2_all');
Route::get('/employees-basic-pay-pp1-pp2-allowance-list-print','ReportsControllerPrint@bsp_pp1_pp2_all');
Route::get('/employees-basic-pay-pp1-pp2-allowance-list-xl','ReportsControllerExcel@bsp_pp1_pp2_all');

Route::get('/employees-address-qualification-pan-account-remuneration-year','Reports2Controller@bankdetails')->middleware('auth');
Route::get('/employees-address-qualification-pan-account-remuneration-year-print','ReportsControllerPrint@bankdetails')->middleware('auth');
Route::get('/employees-address-qualification-pan-account-remuneration-year-xl','ReportsControllerExcel@bankdetails')->middleware('auth');


Route::get('/employee-life-insurance-scheme','Reports2Controller@life_insurance')->middleware('auth');
Route::get('/employee-life-insurance-scheme-print','ReportsControllerPrint@life_insurance')->middleware('auth');
Route::get('/employee-life-insurance-scheme-xl','ReportsControllerExcel@life_insurance')->middleware('auth');

Route::get('/employee-qualification-experience-remuneration','Reports2Controller@rpmsbcd')->middleware('auth');
Route::get('/employee-qualification-experience-remuneration-print','ReportsControllerPrint@rpmsbcd')->middleware('auth');
Route::get('/employee-qualification-experience-remuneration-xl','ReportsControllerExcel@rpmsbcd')->middleware('auth');


Route::get('/employee-monthly-remuneration', function () {
    return view('Frontend.employee-monthly-remuneration');
});
Route::get('/employee-monthly-remuneration-deduction-report', function () {
    return view('Frontend.employee-monthly-remuneration-deduction-report');
});
Route::get('/employee-monthly-remuneration-details-report', function () {
    return view('Frontend.employee-monthly-remuneration-details-report');
});
Route::get('/employee-month-year-dedcuction-details', function () {
    return view('Frontend.employee-month-year-dedcuction-details');
});
Route::get('/employee-gross-salary-three-financial-year', function () {
    return view('Frontend.employee-gross-salary-three-financial-year');
});
Route::get('/employee-gross-salary-for-12-month-wise', function () {
    return view('Frontend.employee-gross-salary-for-12-month-wise');
});

Route::get('/employee-remuneration-summary-branch-wise', function () {
    return view('Frontend.employee-remuneration-summary-branch-wise');
});

Route::get('/esi-deduction-of-regular-employee', function () {
    return view('Frontend.esi-deduction-of-regular-employee');
});

Route::get('/esi-deduction-of-contract-employee', function () {
    return view('Frontend.esi-deduction-of-contract-employee');
});

 
Route::get('/home', 'TemplateController@index')->middleware('auth');
Route::get('logout', 'TemplateController@logout')->middleware('auth');






Route::get('/contractindex', 'HomeController@contract_index');

Route::post('/Update_contractdetails','HomeController@Update_contract_details');

Route::get('/home', 'TemplateController@index')->middleware('auth');
Route::post('/agecheck', 'HomeController@agecounter')->middleware('auth');
});