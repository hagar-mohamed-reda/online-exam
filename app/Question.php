<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;


class Question extends Model
{
    use SoftDeletes;

    protected $table = "exam_questions";

    protected $fillable = [
        'text',
        'question_type_id',
        'category_id',
        'course_id',	
        'doctor_id',
        'default_grade',
        'is_sharied',
        'active',
        'auto_correct',
        'max_answer_characters',
        'photo'
    ];  
    
    public $appends = ['can_delete', 'answer', 'answer_choice'];
    
    public function getCanDeleteAttribute() {
        return ExamQuestion::where('question_id', $this->id)->exists() ? false : true;
    }
    
    public function getAnswerAttribute() {
        $answer = $this->questionChoices()->where('is_answer', '1')->first();
        return optional($answer)->text;
    }
    
    public function getAnswerChoiceAttribute() {
        return $this->questionChoices()->where('is_answer', '1')->first(); 
    }
    
    public function course() {
        return $this->belongsTo("App\Course");
    }
    
    public function questionType() {
        return $this->belongsTo("App\QuestionType");
    }
    
    public function category() {
        return $this->belongsTo("App\Category");
    }
    
    public function doctor() {
        return $this->belongsTo("App\Doctor");
    }

    public function questionChoices() {
        return $this->hasMany("App\QuestionChoice");
    }
    
    public function getStudentAnswer($studentExam) {
        $resource = $studentExam->studentAnswers()->where('question_id', $this->id)->first();
        return optional($resource)->answer;
    }
    
    public function getView($counter, $showAnswer=null, $studentExam=null) {
        $question = $this;
        $view = null;
        
        if ($this->question_type_id == 1)
            $view = view("dashboard.question.truefalse", compact("question", "counter", "showAnswer", "studentExam"));
        
        else if ($this->question_type_id == 2)
            $view = view("dashboard.question.multichoice", compact("question", "counter", "showAnswer", "studentExam"));
                 
        else if ($this->question_type_id == 3)
            $view = view("dashboard.question.short", compact("question", "counter", "showAnswer", "studentExam"));
                          
        else if ($this->question_type_id == 4)
            $view = view("dashboard.question.blank", compact("question", "counter", "showAnswer", "studentExam"));
        
        return $view;
    }
    
    public function isAnswerForStudentExam(StudentExam $exam) {
        
    }
}
