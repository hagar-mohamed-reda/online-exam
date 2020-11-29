<?php

namespace App\Http\Controllers\admin;

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
        return view("admin.course.index");
    }

    /**
     * return json data
     */
    public function getData() {
        return DataTables::eloquent(Course::query())
                        ->addColumn('action', function(Course $course) {
                            return view("admin.course.action", compact("course"));
                        })
                        ->addColumn('doctors', function(Course $course) {
                            return implode(",", $course->doctors()->pluck('name')->toArray());
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
    public function assign(Course $course) {
        return view("admin.course.assign", compact("course"));
    }

    /**
     * update doctor coures
     *
     * @return \Illuminate\Http\Response
     */
    public function updateDoctors(Course $course, Request $request) {
        
        // delete old and add new
        $course->doctorCourses()->delete();
        
        for($index = 0; $index < count($request->doctor_id); $index ++) {
            
            if ($request->assign[$index] == 1) {
                DoctorCourse::create([
                    "doctor_id" => $request->doctor_id[$index],
                    "course_id" => $course->id
                ]);
            }
        }
        
        notify(__('assign course'), __('assign course to doctors => ') . " " . $course->name);
        return Message::success(Message::$DONE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $course = Course::create($request->all());
            
            for($index = 0; $index < count($request->department_id); $index ++) {
                if ($request->assign[$index] == 1) {
                    CourseDepartment::create([
                        "course_id" => $course->id,
                        "department_id" => $request->department_id[$index]
                    ]);
                }
            }

            notify(__('add course'), __('add course') . " " . $course->name);
            return Message::success(Message::$DONE);
        } catch (Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course) {
        return view("admin.course.edit", compact("course"));//$course->getViewBuilder()->loadEditView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course) {
        try {
            $course->update($request->all());

            $course->courseDepartments()->delete();
            for($index = 0; $index < count($request->department_id); $index ++) {
                if ($request->assign[$index] == 1) {
                    CourseDepartment::create([
                        "course_id" => $course->id,
                        "department_id" => $request->department_id[$index]
                    ]);
                }
            }
            notify(__('edit course'), __('edit course') . " " . $course->name);
            return Message::success(Message::$EDIT);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course) {
        try {
            notify(__('remove course'), __('remove course') . " " . $course->name);
            $course->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
}
