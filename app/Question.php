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
    
    public $appends = ['can_delete'];
    
    public function getCanDeleteAttribute() {
        return ExamQuestion::where('question_id', $this->id)->exists() ? false : true;
    }
    
    public function course() {
        return $this->belongsTo("App\Course");
    }
    
    public function questionType() {
        return $this->belongsTo("App\QuestionType");
    }

    public function questionChoices() {
        return $this->hasMany("App\QuestionChoice");
    }
}
