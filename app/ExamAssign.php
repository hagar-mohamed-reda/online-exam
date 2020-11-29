<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamAssign extends Model
{
    
    protected $table = "exam_exam_assigns";

    protected $fillable = [
        'student_id', 'exam_id'
    ]; 
     
}
