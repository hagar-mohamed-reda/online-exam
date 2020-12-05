<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    
    protected $table = "exam_student_exams";

    protected $fillable = [
        'exam_id',
        'student_id',
        'grade',
        'feedback',
        'is_started',
        'is_ended',
        'start_time',
        'end_time'	
    ];
}
