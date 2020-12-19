<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Exam extends Model {

    use SoftDeletes;

    protected $table = "exam_exams";
    protected $fillable = [
        'name',
        'header_text',
        'footer_text',
        'notes',
        'password',
        'start_time',
        'end_time',
        'course_id',
        'doctor_id',
        'minutes',
        'total',
        'question_number',
        'show_result',
        'required_password'
    ];
    public $appends = ['can_delete'];

    public function getCanDeleteAttribute() {
        return StudentExam::where('exam_id', $this->id)->exists() ? false : true;
    } 

    public function course() {
        return $this->belongsTo("App\Course");
    }

    public function doctor() {
        return $this->belongsTo("App\Doctor");
    }

    public function questions() {
        return $this->hasMany("App\ExamQuestion");
    }

    public function details() {
        return $this->hasMany("App\ExamDetail");
    }

    public function examQuestions() {
        $ids = $this->questions()->pluck('question_id')->toArray();
        return Question::whereIn('id', $ids);
    }

    public function examAssign() {
        return $this->hasMany("App\ExamAssign");
    }

    public function studentExams() {
        return $this->hasMany("App\StudentExam");
    }

    public function hasQuestion($question) {
        return ExamQuestion::where('question_id', $question)->where('exam_id', $this->id)->exists();
    }
    
    public function hasBlankAnswer() {
        return $this->details()->where('question_type_id', 4)->exists();
    }

    public function getQuestions() { 
        $selectedIds = []; 

        foreach ($this->details()->get() as $item) {
            $questionCount = $this->questions()
                    ->join('exam_questions', 'exam_questions.id', '=', 'question_id')
                    ->where('question_type_id', $item->question_type_id)
                    ->count();

            $typeIds = [];

            if ($item->number < $questionCount) {
                $typeIds = $this->questions()
                        ->join('exam_questions', 'exam_questions.id', '=', 'question_id')
                        ->where('question_type_id', $item->question_type_id)
                        ->orderByRaw("RAND()")
                        ->take($item->number)
                        ->pluck('question_id')
                        ->toArray();
            } else {
                $typeIds = $this->questions()
                        ->join('exam_questions', 'exam_questions.id', '=', 'question_id')
                        ->where('question_type_id', $item->question_type_id) 
                        ->pluck('question_id')
                        ->toArray();
            }
            
            // add to selcted ids 
            foreach($typeIds as $id) {
                $selectedIds[] = $id;
            }
        }
 

        $questionQuery = Question::whereIn('id', $selectedIds);
        $categoryQuery = clone $questionQuery;
        $categories = Category::whereIn('id', $categoryQuery->pluck('category_id')->toArray())->get();

        foreach ($categories as $category) {
            $qq = clone $questionQuery;
            $category->questions = $qq->where('category_id', $category->id)->get();
        }

        return $categories;
    }

    public function difficulteQuestions() {
        $studentExamsIds = StudentExam::where('exam_id', $this->id)->pluck('id')->toArray();
        $studentAnswer = StudentAnswer::whereIn('student_exam_id', $studentExamsIds)->orderBy('grade', 'ASC')->first();

        return Question::find(optional($studentAnswer)->question_id);
    }

    public function easyQuestions() {
        $studentExamsIds = StudentExam::where('exam_id', $this->id)->pluck('id')->toArray();
        $studentAnswer = StudentAnswer::whereIn('student_exam_id', $studentExamsIds)->orderBy('grade', 'DESC')->first();

        return Question::find(optional($studentAnswer)->question_id);
    }

}
