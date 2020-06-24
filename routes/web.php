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

});

Route::group(['middleware' => ['CompanyDoor']], function () {
    Route::get('company_dashboard', "CompanyController@index");
    Route::get('company_logout', "CompanyController@logout");
    Route::get('job_post', "JobController@index");
    Route::post('job_post_process', "JobController@jobPost");
    

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

