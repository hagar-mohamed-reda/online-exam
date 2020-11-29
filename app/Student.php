<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends User
{
    
    public static function all($columns = array()) {
        return parent::where('role', 'student')->get();
    }
    
    public static function get($columns = array()) {
        return parent::where('role', 'student')->get($columns);
    }
    
    /**
     * get all levels of student
     * 
     * return array
     */
    public static function levels() {
        return User::where("role", User::$STUDENT)
                ->where("level", "!=", "null")
                ->distinct("level")
                ->orderBy("level")
                ->pluck("level")
                ->toArray();
    }
    
    /**
     * get all sections of student
     * 
     * return array
     */
    public static function sections() {
        return User::where("role", User::$STUDENT)
                ->where("section", "!=", "null")
                ->distinct("section")
                ->orderBy("section")
                ->pluck("section")
                ->toArray();
    }
    
    /**
     * get all available exams of student
     * 
     * return Exam
     */
    public static function exams($student) {
        $currentTime = date("Y-m-d H:i:s");
        
        $exams = Exam::join("exam_assigns", "exams.id", "=", "exam_id")
                ->where("student_id", "=", $student)
                ->where("start_time", "<=", $currentTime)
                ->where("end_time", ">", $currentTime);
        
        return $exams;
    }
      
}
