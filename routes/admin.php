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

// remote post login
Route::get('/remote', 'dashboard\StudentRemoteLoginController@login')->name('remoteLogin');



//********************************************
// dashboard routes
//********************************************
// check if user login
Route::group(["middleware" => "admin"], function() {

    Route::get("/", "dashboard\DashboardController@index");

    // department routes
    Route::get("department", "admin\DepartmentController@index");
    Route::post("department/store", "admin\DepartmentController@store");
    Route::get("department/data", "admin\DepartmentController@getData");
    Route::get("department/edit/{department}", "admin\DepartmentController@edit");
    Route::get("department/remove/{department}", "admin\DepartmentController@destroy");
    Route::post("department/update/{department}", "admin\DepartmentController@update");

    // degreemap routes
    Route::get("degreemap", "admin\DegreeMapController@index");
    Route::post("degreemap/store", "admin\DegreeMapController@store");
    Route::get("degreemap/data", "admin\DegreeMapController@getData");
    Route::get("degreemap/edit/{degreemap}", "admin\DegreeMapController@edit");
    Route::get("degreemap/remove/{degreemap}", "admin\DegreeMapController@destroy");
    Route::post("degreemap/update/{degreemap}", "admin\DegreeMapController@update");
   
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
  
    
    // doctor routes
    Route::get("dashboard/doctor", "dashboard\DoctorController@index");
    Route::post("dashboard/doctor/store", "dashboard\DoctorController@store");
    Route::get("dashboard/doctor/data", "dashboard\DoctorController@getData");
    Route::get("dashboard/doctor/edit/{doctor}", "dashboard\DoctorController@edit");
    Route::get("dashboard/doctor/remove/{doctor}", "dashboard\DoctorController@destroy");
    Route::post("dashboard/doctor/update/{doctor}", "dashboard\DoctorController@update");

    // student routes
    Route::get("dashboard/student", "dashboard\StudentController@index");
    Route::post("dashboard/student/store", "dashboard\StudentController@store");
    Route::get("dashboard/student/data", "dashboard\StudentController@getData");
    Route::get("dashboard/student/course/data", "dashboard\StudentController@getData2");
    Route::get("dashboard/student/edit/{student}", "dashboard\StudentController@edit");
    Route::get("dashboard/student/remove/{student}", "dashboard\StudentController@destroy");
    Route::post("dashboard/student/update/{student}", "dashboard\StudentController@update");
    Route::get("dashboard/student/show/{student}", "dashboard\StudentController@show");
    Route::post("dashboard/student/import", "dashboard\StudentController@import");

    
  
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
    // option routes
    Route::get("profile", "dashboard\DashboardController@profile");
    Route::get("dashboard/main", "dashboard\DashboardController@main");

// login route
Route::get("login/", "dashboard\LoginController@index");
Route::post("sign", "dashboard\LoginController@login");
Route::get("logout", "dashboard\LoginController@logout");
 

Route::get("notify", "dashboard\NotificationController@get");

Route::get("test", function(){ 
     session(["locale" => "Ar"]);
});

// show order