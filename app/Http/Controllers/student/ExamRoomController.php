<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\helper\Message;
use App\helper\Helper;
use App\StudentExam;
use App\Student;
use App\Exam;
use App\Question;
use App\StudentAnswer;
use DB;
use DataTables;

class ExamRoomController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        date_default_timezone_set('Africa/Cairo');
        Carbon::setLocale("ar");

        $exam = Exam::find(request()->exam_id);
        $studentExam = StudentExam::where('student_id', Auth()->user()->fid)
                        ->where('exam_id', request()->exam_id)->first();

        if ($studentExam) {
            $studentExam->update([
                "end_time" => Carbon::now()
            ]);
        } else {
            $studentExam = StudentExam::create([
                        "student_id" => Auth()->user()->fid,
                        "exam_id" => request()->exam_id,
                        "start_time" => Carbon::now(),
                        "end_time" => Carbon::now(),
                        "is_started" => 1,
            ]);
        }

        $startTime = strtotime($exam->start_time);
        $endTime = strtotime($exam->end_time);

        $minutes = ($endTime - $startTime) / (1000 * 60);
        //
        if ($minutes >= $exam->minutes || $studentExam->is_ended) {
            return view("student.examroom.exam_end", ["exam" => $studentExam]);
        } else {
            $exam->minutes -= $minutes;
        }



        return view("student.examroom.index", compact("exam"));
    }

    /**
     * get view of end the exam
     * @return type
     */
    public function end() {
        $studentExam = StudentExam::where('student_id', Auth()->user()->fid)
                        ->where('exam_id', request()->exam_id)->first();
        return view("student.examroom.exam_end", ["exam" => $studentExam]);
    }

    /**
     * return json data
     */
    public function getData() {
        $ids = Auth::user()->toStudent()->studentExams()->where('is_ended', 1)->pluck('exam_id')->toArray();
        $query = Auth::user()
                ->toStudent()
                ->exams()
                ->whereNotIn('exam_id', $ids);

        return DataTables::eloquent($query)
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $data = json_decode($request->resource);
            $studentId = Auth::user()->fid;
            $exam = Exam::find($data->exam_id);
            $studentExam = StudentExam::where('student_id', Auth()->user()->fid)
                            ->where('exam_id', $data->exam_id)->first();
            $questionGrade = $exam->total / $exam->question_number;
            
            if ($studentExam->is_ended)
                return Message::error("exam ended");

            // delete old 
            $studentExam->studentAnswers()->delete();
            
            // add new
            foreach ($data->questions as $q) {
                $question = Question::find($q->question_id);
                $grade = 0;
                $answerId = 0;
                if (str_replace(" ", "", $q->answer) == str_replace(" ", "", $question->answer)) {
                    $grade = $questionGrade > 0 ? $questionGrade : $question->default_grade;
                    $answerId = optional($question->answer_choice)->id;
                }
                StudentAnswer::create([
                    "student_exam_id" => $studentExam->id,
                    "question_id" => $q->question_id,
                    "grade" => $grade,
                    "answer" => $q->answer,
                    "answer_id" => $answerId
                ]);
            }

            $studentExam->update([
                "is_ended" => 1,
                "end_time" => date('Y-m-d H:i:s'),
            ]);


            notify(__('finish the exam'), __('finish the exam ') . " " . $exam->name);
            return Message::success(Message::$DONE);
        } catch (Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }

}
