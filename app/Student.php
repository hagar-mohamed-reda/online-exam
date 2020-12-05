<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
     /**
     * table name of user model
     *
     * @var type
     */
    protected $table = "students";

    public static $STUDENT_STORE_API = "http://lms.seyouf.sphinxws.com/api/student-store";
    public static $STUDENT_UPDATE_API = "http://lms.seyouf.sphinxws.com/api/student-update";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'code',
        'name',
        'set_number',
        'sms_code',
        'active',
        'phone',
        'username',
        'email',
        'password',
        'national_id',
        'level_id',
        'type',
        'account_confirm',
        'department_id',
        'graduated',
        'can_see_result'
    ];
    
    /**
     * get all levels of student
     * 
     * return array
     */
    public static function levels() {
        return Student::query()
                ->where("level_id", "!=", "null")
                ->distinct("level_id")
                ->orderBy("level_id")
                ->pluck("level_id")
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
      
    
    public function department() {
        return $this->belongsTo("App\Department");
    }

    public function level() {
        return $this->belongsTo("App\Level");
    }

    public function courses() {
        return Course::whereIn('id', StudentCourse::where('student_id', $this->id)->pluck('course_id')->toArray());
    }
    
    
    /**
     * check if the student has the exam
     * 
     * @return boolean
     */
    public function hasExam($exam) {
        $exam = ExamAssign::where("student_id", $this->id)->where("exam_id", $exam)->first();
        
        if ($exam)
            return true;
        
        return false;
    }
    
}
