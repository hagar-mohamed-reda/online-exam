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



// category routes
Route::get("category", "doctor\CategoryController@index");
Route::post("category/store", "doctor\CategoryController@store");
Route::get("category/data", "doctor\CategoryController@getData");
Route::get("category/edit/{category}", "doctor\CategoryController@edit");
Route::get("category/remove/{category}", "doctor\CategoryController@destroy");
Route::post("category/update/{category}", "doctor\CategoryController@update");

// question routes
Route::get("question", "doctor\QuestionController@index");
Route::post("question/store", "doctor\QuestionController@store");
Route::get("question/create", "doctor\QuestionController@create");
Route::get("question/data", "doctor\QuestionController@getData");
Route::get("question/show/{question}", "doctor\QuestionController@show");
Route::get("question/edit/{question}", "doctor\QuestionController@edit");
Route::get("question/remove/{question}", "doctor\QuestionController@destroy");
Route::post("question/update/{question}", "doctor\QuestionController@update");

// exam routes
Route::get("exam", "doctor\ExamController@index");
Route::post("exam/store", "doctor\ExamController@store");
Route::get("exam/create", "doctor\ExamController@create");
Route::get("exam/data", "doctor\ExamController@getData");
Route::get("exam/show/{exam}", "doctor\ExamController@show");
Route::get("exam/edit/{exam}", "doctor\ExamController@edit");
Route::get("exam/remove/{exam}", "doctor\ExamController@destroy");
Route::get("exam/assign/{exam}", "doctor\ExamController@assign");
Route::post("exam/assign/store/{exam}", "doctor\ExamController@assignStudents");
Route::post("exam/update/{exam}", "doctor\ExamController@update");
