<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;
 
use App\helper\Message;
use App\helper\Helper;
use App\StudentExam; 
use App\Student; 
use App\Exam; 
use DB;
use DataTables;

class StudentExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("student.exams.index");
    }

    /**
     * return json data
     */
    public function getData() {
        $exams = Student::exams(Auth::user()->id);
         
        return DataTables::eloquent($exams=>latest())
                        ->addColumn('action', function(Exam $exam) {
                            return view("student.exams.action", compact("exam"));
                        }) 
                        ->editColumn('course_id', function(Exam $exam) {
                            return optional($exam->course)->name;
                        }) 
                        ->rawColumns(['action'])
                        ->toJson();
    } 
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all(); 
            $student = StudentExam::create($data); 
            
            notify(__('add student'), __('add student') . " " . $student->name); 
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentExam $student)
    { 
        return $student->getViewBuilder()->loadEditView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentExam $student)
    { 
        try {
            $student->update($request->all()); 
            
            notify(__('edit student'), __('edit student') . " " . $student->name);
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
    public function destroy(StudentExam $student)
    { 
        try { 
            notify(__('remove student'), __('remove student') . " " . $student->name);
            $student->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
}
