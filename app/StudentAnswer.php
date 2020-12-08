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
     
}
