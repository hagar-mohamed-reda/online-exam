<?php

namespace App\Http\Controllers\doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;
 
use App\helper\Message;
use App\helper\Helper;
use App\Student; 
use App\Course; 
use App\Exam; 
use App\StudentExam; 
use App\StudentAnswer; 
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
        return view("doctor.student_exam.index");
    }

    /**
     * return json data
     */
    public function getData() {
        $query = null;
        if (Auth::user()->type == 'admin')
            $query = StudentExam::query(); 
        else
            $query = Auth::user()->toDoctor()->studentExams();
        
        if (request()->level_id > 0) {
            $ids = Student::where('level_id', request()->level_id)->pluck('id')->toArray();
            $query->whereIn('student_id', $ids);
        }
        
        if (request()->department_id > 0) {
            $ids = Student::where('department_id', request()->department_id)->pluck('id')->toArray();
            $query->whereIn('student_id', $ids);
        }
        
        if (request()->course_id > 0) {
            $ids = Exam::where('course_id', request()->course_id)->pluck('id')->toArray();
            $query->whereIn('exam_id', $ids);
        }
        
        if (request()->exam_id > 0) { 
            $query->where('exam_id', request()->exam_id);
        }
         
        return DataTables::eloquent($query->latest())
                        ->addColumn('action', function(StudentExam $exam) {
                            return view("doctor.student_exam.action", compact("exam"));
                        }) 
                        ->addColumn('student', function(StudentExam $exam) {
                            return optional($exam->student)->name;
                        }) 
                        ->addColumn('code', function(StudentExam $exam) {
                            return optional($exam->student)->code;
                        }) 
                        ->addColumn('exam', function(StudentExam $exam) {
                            return optional($exam->exam)->name;
                        }) 
                        ->addColumn('level', function(StudentExam $exam) {
                            return optional(optional($exam->student)->level)->name;
                        }) 
                        ->addColumn('department', function(StudentExam $exam) {
                            return optional(optional($exam->student)->department)->name;
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
    public function correct(Request $request)
    { 
        try {
            $data = json_decode($request->resource);
            $studentExam = StudentExam::find($data->student_exam_id);
            
            foreach($data->questions as $q) {
                $studentQuestion = StudentAnswer::where('student_exam_id', $studentExam->id)->where('question_id', $q->question_id)->first();
                
                if ($studentQuestion)
                $studentQuestion->update([
                    "grade" => $q->grade
                ]);
            }
            
            
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
    public function show($exam)
    { 
        $studentExam = StudentExam::find($exam); 
        $exam = $studentExam->exam;
        $showAnswer = true; 
        return view("doctor.student_exam.show", compact('showAnswer', 'exam', 'studentExam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentExam $student)
    {  
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
