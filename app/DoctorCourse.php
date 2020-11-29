<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorCourse extends Model
{
    
    protected $table = "doctor_courses";

    protected $fillable = [
        'course_id', 'doctor_id'
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
}
