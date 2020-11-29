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



// student exam routes
Route::get("student/exam", "student\StudentExamController@index");
Route::get("student/exam/data", "student\StudentExamController@getData"); 
Route::get("student/exam/room/{exam}", "student\ExamRoomController@index");
 