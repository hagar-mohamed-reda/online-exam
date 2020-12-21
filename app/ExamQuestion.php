<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    
    protected $table = "exam_exam_questions";

    protected $fillable = [
        'question_id', 'exam_id', 'grade'
    ]; 

    public $appends = [
        'exam_grade'
    ]; 
    
    public function getExamGradeAttribute() {
        $examCategory = $this->exam->details->where('question_type_id', optional($this->question)->question_type_id)->first();
        $grade = optional($examCategory)->grade / optional($examCategory)->number;
        return $grade;
    }
    
    public function question() {
        return $this->belongsTo("App\Question");
    }
    
    public function exam() {
        return $this->belongsTo("App\Exam");
    }

}
