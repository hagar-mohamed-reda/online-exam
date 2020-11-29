<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;


class Exam extends Model
{
    
    use SoftDeletes;

    protected $table = "exam_exams";

    protected $fillable = [
        'name',
        'header_text',
        'footer_text',
        'notes',
        'password',
        'start_time',
        'end_time',
        'course_id',
        'user_id',
        'minutes',
        'total',
        'question_number',
        'required_password'
    ]; 

    public function course() {
        return $this->belongsTo("App\Course");
    }

    public function questions() {
        return $this->hasMany("App\ExamQuestion");
    }
    
    public function examAssign() {
        return $this->hasMany("App\ExamAssign");
    }
}
