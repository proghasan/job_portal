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

Route::group(['middleware' => ['EmployeeDoor']], function () {
    Route::get('employee_dashboard', "EmployeeController@index");
    Route::get('employee_logout', "EmployeeController@logout");
    Route::get('apply_job/{id}', "EmployeeController@applyJob");
    Route::get('applied_job', "EmployeeController@appliedJob");
    Route::get('build_resume', "EmployeeController@buildResume");
    Route::get('get_user_info', "EmployeeController@getUserInfo");
    Route::get('get_education_info', "EmployeeController@getEducationInfo");
    Route::get('get_work_info', "EmployeeController@getWorkInfo");
    Route::get('get_other_info', "EmployeeController@getBasicInfo");
    Route::post('save_education_info', "EmployeeController@saveEducationInfo");
    Route::post('save_work_info', "EmployeeController@saveWorkInfo");
    Route::post('save_basic_info', "EmployeeController@saveBasicInfo");
    Route::post('update_user_info', "EmployeeController@UpdateUserInfo");

});

Route::group(['middleware' => ['CompanyDoor']], function () {
    Route::get('company_dashboard', "CompanyController@index");
    Route::get('company_logout', "CompanyController@logout");
    Route::get('job_post', "JobController@index");
    Route::post('job_post_process', "JobController@jobPost");
    Route::get('applied_list', "CompanyController@appliedList");
    

});

Route::get("employee_login", "EmployeeController@login");
Route::post("employee_login_process", "EmployeeController@loginProcess");
Route::post("employee_registration", "EmployeeController@registration");
// company login
Route::get("company_login", "CompanyController@login");
Route::post("company_login_process", "CompanyController@loginProcess");
Route::post("company_registration", "CompanyController@registration");

// show index page
Route::get("/", "FrontendController@index");
Route::get("show_job/{id}", "FrontendController@jobs");
Route::get("single_job/{id}", "FrontendController@showSingleJob");

// resume view
Route::get("view_resume/{id}", "FrontendController@viewResume");

