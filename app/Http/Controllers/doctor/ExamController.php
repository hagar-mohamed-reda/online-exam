<?php

namespace App\Http\Controllers\doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;
 
use App\helper\Message;
use App\helper\Helper;
use App\Exam; 
use App\Student; 
use App\Course; 
use App\ExamQuestion; 
use App\ExamAssign; 
use DB;
use DataTables;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("doctor.exam.index");
    }

    /**
     * return json data
     */
    public function getData() {
        $query = Exam::where("doctor_id", Auth::user()->fid);
        
        return DataTables::eloquent($query)
                        ->addColumn('action', function(Exam $exam) {
                            return view("doctor.exam.action", compact("exam"));
                        })->editColumn('course_id', function(Exam $exam) {
                            return optional($exam->course)->name;
                        }) 
                        ->rawColumns(['action'])
                        ->toJson();
    } 

    /**
     * return json data
     */
    public function getAssignStudent() {
        $exam = Exam::find(request()->exam_id);
        $query = Student::query();
        
        if (request()->level_id > 0)
            $query->where('level_id', request()->level_id);
        
        if (request()->department_id > 0)
            $query->where('department_id', request()->department_id);
        
        return DataTables::eloquent($query)
                        ->addColumn('action', function(Student $student) use($exam) {
                            return view("doctor.exam.assign_action", compact("student", "exam"));
                        })->editColumn('level_id', function(Student $student) {
                            return optional($student->level)->name;
                        })->editColumn('department_id', function(Student $student) {
                            return optional($student->department)->name;
                        }) 
                        ->rawColumns(['action'])
                        ->toJson();
    } 
    
    
    /**
     * Show the form for assign students for exam.
     *
     * @return \Illuminate\Http\Response
     */
    public function assign(Exam $exam)
    { 
        return view("doctor.exam.assign", compact("exam"));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view("doctor.exam.add");
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
            $data["doctor_id"] = Auth::user()->fid;
            $data["name"] = Course::find($request->course_id)->code . "-" . date('Y-m-d') . "-" . $request->name;
             
            $exam = Exam::create($data);  
            for($index = 0; $index < count($request->question_id); $index ++) {
                if ($request->is_selected[$index] == 1) {
                    ExamQuestion::create([
                        "exam_id" => $exam->id, 
                        "question_id" => $request->question_id[$index],  
                    ]);
                }
            }
            
            
            notify(__('add exam'), __('add exam') . " " . $exam->name); 
            return Message::success(Message::$DONE);
        } catch (Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
    
    
    public function assignStudents(Exam $exam, Request $request) {
        try {
            // delete old and add new
            $exam->examAssign()->delete();

            for($index = 0; $index < count($request->student_id); $index ++) {

                if ($request->assign[$index] == 1) {
                    ExamAssign::create([
                        "student_id" => $request->student_id[$index],
                        "exam_id" => $exam->id
                    ]);
                }
            }

            notify(__('assign exam'), __('assign exam to students => ') . " " . $exam->name);
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
    public function show(Exam $exam)
    {
        return view("doctor.exam.show", compact("exam"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    { 
        return view("doctor.exam.edit", compact("exam"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    { 
        try {
            $exam->update($request->all()); 
            
            // delete old and add new
            $exam->questions()->delete();
            
            // add new
            for($index = 0; $index < count($request->question_id); $index ++) {
                if ($request->is_selected[$index] == 1) {
                    ExamQuestion::create([
                        "exam_id" => $exam->id, 
                        "question_id" => $request->question_id[$index],  
                    ]);
                }
            }
            
            
            notify(__('edit exam'), __('edit exam') . " " . $exam->name);
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
    public function destroy(Exam $exam)
    { 
        try { 
            notify(__('remove exam'), __('remove exam') . " " . $exam->name);
            $exam->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
}
