<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamDetail extends Model
{
    
    protected $table = "exam_exam_details";

    protected $fillable = [
        'question_type_id', 'number', 'grade', 'exam_id'
    ]; 

   
    
    public function questionType() {
        return $this->belongsTo("App\QuestionType", 'question_type_id');
    }
    
    public function exam() {
        return $this->belongsTo("App\Exam");
    }

}
