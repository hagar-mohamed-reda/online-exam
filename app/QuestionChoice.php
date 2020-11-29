<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionChoice extends Model
{
    
    protected $table = "exam_question_choices";

    protected $fillable = [
        'question_id', 'text', 'is_answer'
    ]; 

}
