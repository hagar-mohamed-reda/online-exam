<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionChoice extends Model
{
    
    protected $table = "exam_question_choices";

    protected $fillable = [
        'question_id', 'text', 'is_answer'
    ]; 

    
    public function question() {
        return $this->belongsTo("App\Question", 'question_id');
    }
    
    
    public function isAnswerForStudentExam(StudentExam $exam) {
        $answer = false;
        $question = $exam->studentAnswers()->where('question_id', $this->question_id)->first();
        
        if ($question) {
            if (str_replace(" ", "", $question->answer) == str_replace(" ", "", $this->text)) {
                $answer = true;
            }
        }
        
        return $answer;
    }
}
