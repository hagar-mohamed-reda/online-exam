<?php

namespace App\Http\Controllers\doctor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\helper\Message;
use App\Course;
use App\DoctorCourse;
use App\CourseDepartment;
use DataTables;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view("doctor.course.index");
    }

    /**
     * return json data
     */
    public function getData() {
        $doctor = Auth::user()->toDoctor();
        $ids = DoctorCourse::where('doctor_id', optional($doctor)->id)->pluck('course_id')->toArray();
        $query = Course::whereIn('id', $ids);
        
        return DataTables::eloquent($query)
                        ->addColumn('action', function(Course $course) {
                            return view("doctor.course.action", compact("course"));
                        })
                        ->addColumn('students', function(Course $course) {
                            return $course->studentCourses()->count();
                        })
                        ->addColumn('departments', function(Course $course) {
                            return implode(",", $course->departments()->pluck('name')->toArray());
                        })
                        ->rawColumns(['action'])
                        ->toJson();
    }

    /**
     * Show the form for assign doctors to course.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course) {
        return view("doctor.course.show", compact("course"));
    }
     
}
