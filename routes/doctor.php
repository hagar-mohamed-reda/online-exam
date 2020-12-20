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


Route::group(["middleware" => "admin"], function() {

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
    Route::post("question/store2", "doctor\QuestionController@store2");
    Route::get("question/create", "doctor\QuestionController@create");
    Route::get("question/create2", "doctor\QuestionController@create2");
    Route::get("question/data", "doctor\QuestionController@getData");
    Route::get("question/show/{question}", "doctor\QuestionController@show");
    Route::get("question/edit/{question}", "doctor\QuestionController@edit");
    Route::get("question/remove/{question}", "doctor\QuestionController@destroy");
    Route::post("question/update/{question}", "doctor\QuestionController@update");

// exam routes
    Route::get("student/assign/data", "doctor\ExamController@getAssignStudent");
    Route::get("exam", "doctor\ExamController@index");
    Route::post("exam/store", "doctor\ExamController@store");
    Route::get("exam/create", "doctor\ExamController@create");
    Route::get("exam/data", "doctor\ExamController@getData");
    Route::get("exam/show/{exam}", "doctor\ExamController@show");
    Route::get("exam/correct_blank/{exam}", "doctor\ExamController@correctBlank");
    Route::post("exam/correct_blank", "doctor\StudentExamController@correctMultiExam");
    Route::get("exam/show2/{exam}", "doctor\ExamController@show2");
    Route::get("exam/edit/{exam}", "doctor\ExamController@edit");
    Route::get("exam/recorrect/{exam}", "doctor\ExamController@recorrect");
    Route::post("exam/recorrect", "doctor\ExamController@performRecorrect");
    Route::get("exam/remove/{exam}", "doctor\ExamController@destroy");
    Route::get("exam/assign/{exam}", "doctor\ExamController@assign");
    Route::post("exam/approveResult/{exam}", "doctor\ExamController@approveResult");
    Route::post("exam/assign/store/{exam}", "doctor\ExamController@assignStudents");
    Route::post("exam/update/{exam}", "doctor\ExamController@update");

    // doctor-course routes
    Route::get("doctor-course", "doctor\CourseController@index");
    Route::get("doctor-course/data", "doctor\CourseController@getData");
    Route::get("doctor-course/show/{course}", "doctor\CourseController@show");
    
    
    // student-exam routes
    Route::get("student-exam", "doctor\StudentExamController@index");
    Route::get("student-exam/data", "doctor\StudentExamController@getData");
    Route::get("student-exam/show/{exam}", "doctor\StudentExamController@show");
    Route::post("student-exam/correct", "doctor\StudentExamController@correct");
});

    



Route::get('test_course', function() {
    $course = App\Course::find(105);

    dump($course->studentCourses()->get());
});
