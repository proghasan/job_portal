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

});

Route::group(['middleware' => ['CompanyDoor']], function () {
    Route::get('company_dashboard', "CompanyController@index");
    Route::get('company_logout', "CompanyController@logout");

});

Route::get("employee_login", "EmployeeController@login");
Route::post("employee_login_process", "EmployeeController@loginProcess");
Route::post("employee_registration", "EmployeeController@registration");
// company login
Route::get("company_login", "CompanyController@login");
Route::post("company_login_process", "CompanyController@loginProcess");
Route::post("company_registration", "CompanyController@registration");
