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

Route::get('/', 'HomeController@index');


Route::get('/companies', 'CompanyController@index');
Route::get('/timesheets', 'TimesheetManagerController@index');
Route::get('/tasks', 'WorkforceManagerController@index');

/***************************
*** Resource Controllers ***
****************************/
Route::resource('employee','EmployeeController');
Route::resource('company','CompanyController');
Route::resource('tasks', 'WorkforceManagerController');


/*******************************
**** Task Invitation Action ****
********************************/
Route::get('/invite/task={task_id}&employee={employee_id}', 'TaskAssignmentController@send_invite');

/**********************************************
*** Show Accepted/Rejected/Invited Requests ***
***********************************************/
Route::get('/tasks/employee/{employee_id}/task-invitations', 'EmployeeController@show_task_requests');
Route::get('/tasks/employee/{employee_id}/accepted-invitations', 'EmployeeController@show_accepted_requests');

/*************************
** Task Accept / Reject **
**************************/ 
Route::get('/employee/accept/task={task_id}&employee={employee_id}', 'TaskAssignmentController@accept_invite');
Route::get('/employee/reject/task={task_id}&employee={employee_id}', 'TaskAssignmentController@reject_invite');	

/***************************
**** Approve New Company ****
****************************/
Route::get('/company/approve/{company_id}', 'CompanyController@approve');

/**************************
*** Email Notification ****
***************************/
Route::get('/settings/customize-email-notifications', 'SendEmailController@customize_notifications');
Route::put('/settings/customize-email-notifications/update/', 'SendEmailController@update_notifications');

/*********************
* Deactivate Profile *
**********************/
Route::get('/settings/employee/deactivate', 'EmployeeController@deactivate_account');
Route::get('/deactivated', 'EmployeeController@show_reactivate_account_page');

Route::get('/deactivated/no', 'EmployeeController@reactivate_no');
Route::get('/deactivated/yes', 'EmployeeController@reactivate_yes');

/***************************
* Selection Option Manager *
****************************/
Route::get('/settings/selection-option-manager', 'AdminController@show_selection_manager');
Route::put('/settings/selection-option-manager/update', 'AdminController@update_selection_manager');

/***************************
****** Change Picture ******
****************************/
Route::put('/employee-change-picture/{employee_id}/', 'EmployeeController@change_profile_picture');
Route::put('/company-change-picture/{company_id}/', 'CompanyController@change_profile_picture');

/***********************
** Download CV / Cert **
************************/
Route::get('/download/{file_path}', 'EmployeeController@download');

/**********************
** Timesheet Manager **
***********************/
Route::get('/timesheets/edit/employee_id={employee_id}&task_id={task_id}', 'TimesheetManagerController@edit_timesheet');
Route::post('/timesheets/store/employee_id={employee_id}&task_id={task_id}', 'TimesheetManagerController@save_timesheet');

/***********************
** Admin Approve Task **
************************/
Route::get('/tasks/{task_id}/employee/{employee_id}/approve/', 'TaskAssignmentController@admin_approve');

/*****************
***** Logout *****
******************/
Route::get('/logout', 'EmployeeController@getLogout');

/***********************
** Advanced Searching **
************************/
Route::get('/search/employee', 'EmployeeController@advanced_search');
Route::get('/search/tasks', 'WorkforceManagerController@advanced_search');

Route::get('/search/tasks/invitations', 'EmployeeController@task_advanced_search_invitations');
Route::get('/search/tasks/accepted', 'EmployeeController@task_advanced_search_accepted');

/********** Reset Password Redirect ***********/
Route::get('/login/success', 'AdminController@resetPasswordLogout');

/*************
** Test API **
**************/
Route::get('/api-test', 'AdminController@testAPI');
Route::get('/api-test/{id}', 'AdminController@singleapi');

Auth::routes();