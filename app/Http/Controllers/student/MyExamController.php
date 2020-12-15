<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;
 
use App\helper\Message;
use App\helper\Helper;
use App\StudentStudentExam; 
use App\Student; 
use App\StudentExam; 
use DB;
use DataTables;

class MyExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("student.myexam.index");
    }

    /**
     * return json data
     */
    public function getData() {
        $exams = Auth::user()->toStudent()->studentExams();
         
        return DataTables::eloquent($exams->latest())
                        ->addColumn('action', function(StudentExam $exam) {
                            return view("student.myexam.action", compact("exam"));
                        }) 
                        ->addColumn('course', function(StudentExam $exam) {
                            return optional(optional($exam->exam)->course)->name;
                        }) 
                        ->addColumn('doctor', function(StudentExam $exam) {
                            return optional(optional($exam->exam)->doctor)->name;
                        }) 
                        ->addColumn('exam_name', function(StudentExam $exam) {
                            return optional($exam->exam)->name;
                        }) 
                        ->addColumn('minutes', function(StudentExam $exam) {
                            return optional($exam->exam)->minutes;
                        }) 
                        ->addColumn('exam_start_time', function(StudentExam $exam) {
                            return optional($exam->exam)->start_time;
                        }) 
                        ->addColumn('exam_end_time', function(StudentExam $exam) {
                            return optional($exam->exam)->end_time;
                        }) 
                        ->addColumn('total', function(StudentExam $exam) {
                            return optional($exam->exam)->total;
                        }) 
                        ->editColumn('grade', function(StudentExam $exam) {
                            if ($exam->exam->show_result == 1)
                                return $exam->grade . "/" . optional($exam->exam)->total;
                            else 
                                return __('cant see result'); 
                        }) 
                        ->rawColumns(['action'])
                        ->toJson();
    } 
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($exam)
    { 
        $studentExam = StudentExam::find($exam); 
        $exam = $studentExam->exam;
        $showAnswer = true; 
        return view("student.myexam.show", compact('showAnswer', 'exam', 'studentExam'));
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
            $student = StudentStudentExam::create($data); 
            
            notify(__('add student'), __('add student') . " " . $student->name); 
            return Message::success(Message::$DONE);
        } catch (Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentStudentExam $student)
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
    public function update(Request $request, StudentStudentExam $student)
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
    public function destroy(StudentStudentExam $student)
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
