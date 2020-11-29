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


//********************************************
// dashboard routes
//********************************************
// check if user login
Route::group(["middleware" => "admin"], function() {

    Route::get("/", "dashboard\DashboardController@index");
    Route::get("main", "dashboard\DashboardController@main");

    // department routes
    Route::get("department", "admin\DepartmentController@index");
    Route::post("department/store", "admin\DepartmentController@store");
    Route::get("department/data", "admin\DepartmentController@getData");
    Route::get("department/edit/{department}", "admin\DepartmentController@edit");
    Route::get("department/remove/{department}", "admin\DepartmentController@destroy");
    Route::post("department/update/{department}", "admin\DepartmentController@update");
   
    // course routes
    Route::get("course", "admin\CourseController@index");
    Route::post("course/store", "admin\CourseController@store");
    Route::get("course/data", "admin\CourseController@getData");
    Route::get("course/edit/{course}", "admin\CourseController@edit");
    Route::get("course/assign/{course}", "admin\CourseController@assign");
    Route::post("course/assign/update/{course}", "admin\CourseController@updateDoctors");
    Route::get("course/remove/{course}", "admin\CourseController@destroy");
    Route::post("course/update/{course}", "admin\CourseController@update");
  
    // notification routes
    Route::get("notification", "dashboard\NotificationController@index"); 
    Route::get("notification/data", "dashboard\NotificationController@getData"); 
    Route::get("notification/remove/{notification}", "dashboard\NotificationController@destroy"); 
  
    // customer routes
    Route::get("customer", "dashboard\CustomerController@index");
    Route::post("customer/import", "dashboard\CustomerController@import");
    Route::post("customer/store", "dashboard\CustomerController@store");
    Route::get("customer/data", "dashboard\CustomerController@getData");
    Route::get("customer/edit/{customer}", "dashboard\CustomerController@edit");
    Route::get("customer/show/{customer}", "dashboard\CustomerController@show");
    Route::get("customer/sheet/{customer}", "dashboard\CustomerController@sheet");
    Route::post("customer/sheet/store/{customer}", "dashboard\SheetController@store");
    Route::get("customer/remove/{customer}", "dashboard\CustomerController@destroy");
    Route::post("customer/update/{customer}", "dashboard\CustomerController@update");
  
    // role routes
    Route::get("role", "dashboard\RoleController@index");
    Route::post("role/store", "dashboard\RoleController@store");
    Route::get("role/data", "dashboard\RoleController@getData");
    Route::get("role/edit/{role}", "dashboard\RoleController@edit");
    Route::get("role/permission/{role}", "dashboard\RoleController@permissions");
    Route::post("role/permission/update/{role}", "dashboard\RoleController@updatePermissions");
    Route::get("role/remove/{role}", "dashboard\RoleController@destroy");
    Route::post("role/update/{role}", "dashboard\RoleController@update");

    // user routes
    Route::get("user", "admin\UserController@index");
    Route::post("user/store", "admin\UserController@store");
    Route::get("user/data", "admin\UserController@getData");
    Route::get("user/edit/{user}", "admin\UserController@edit");
    Route::get("user/remove/{user}", "admin\UserController@destroy");
    Route::post("user/update/{user}", "admin\UserController@update");
 
    // option routes
    Route::get("option/", "dashboard\SettingController@index");
    Route::get("option/update", "dashboard\SettingController@update");
    Route::post("translation/update", "dashboard\SettingController@updateTranslation");
    
    // helper route
    Route::get("print/{page}", "dashboard\HelperController@print");
});

// login route
Route::get("login/", "dashboard\LoginController@index");
Route::post("sign", "dashboard\LoginController@login");
Route::get("logout", "dashboard\LoginController@logout");
 

Route::get("notify", "dashboard\NotificationController@get");

Route::get("test", function(){ 
     session(["locale" => "Ar"]);
});

// show order