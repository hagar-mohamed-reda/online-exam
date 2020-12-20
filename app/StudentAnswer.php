<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    
    protected $table = "exam_student_answers";

    protected $fillable = [
        'student_exam_id',
        'question_id',
        'answer_id',
        'grade',
        'answer'	
    ];
    
    public function question() {
        return $this->belongsTo("App\Question", 'question_id');
    }
    
    public function studentExam() {
        return $this->belongsTo("App\StudentExam", "student_exam_id");
    }
    
    public function getQuestionOfExamGrade() {
        $examCategory = $this->studentExam()->exam()->details()->where('question_type_id', optional($this->question)->question_type_id)->first();
        $grade = optional($examCategory)->grade / optional($examCategory)->number;
        return $grade;
    }
     
}
