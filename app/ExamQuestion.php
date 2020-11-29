<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    
    protected $table = "exam_exam_questions";

    protected $fillable = [
        'question_id', 'exam_id'
    ]; 
    
    public function question() {
        return $this->belongsTo("App\Question");
    }

}
