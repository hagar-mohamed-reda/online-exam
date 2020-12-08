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


//  exam room routes
Route::get("exam-room", "student\ExamRoomController@index");
Route::get("exam-room/end", "student\ExamRoomController@end");  
Route::get("exam-room/data", "student\ExamRoomController@getData");  
Route::post("exam-room/store", "student\ExamRoomController@store");  


// student exam routes
Route::get("student/exam", "student\StudentExamController@index");
Route::get("student/exam/data", "student\StudentExamController@getData"); 
Route::get("student/exam/room/{exam}", "student\ExamRoomController@index");
 

// myexam routes
Route::get("student/myexam", "student\MyExamController@index");
Route::get("student/myexam/data", "student\MyExamController@getData"); 
Route::get("student/myexam/show/{exam}", "student\MyExamController@show"); 
 