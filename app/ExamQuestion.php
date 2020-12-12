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
        $total = optional($this->exam)->total;
        $questionCount = $this->exam()->studentAnswers()->count();
        return ($total / $questionCount);
    }
    
    public function question() {
        return $this->belongsTo("App\Question");
    }
    
    public function exam() {
        return $this->belongsTo("App\Exam");
    }

}
