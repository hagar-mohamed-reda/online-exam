<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    
    protected $table = "student_courses";

    protected $fillable = [
        'course_id', 'student_id'
    ];
    
    public $appends = [
        'name'
    ];
    
    public function getNameAttribute() {
        return optional($this->course)->name;
    }
    
    public function course() {
        return $this->belongsTo("App\Course");
    }
    
    public function student() {
        return $this->belongsTo("App\Student");
    }
}
