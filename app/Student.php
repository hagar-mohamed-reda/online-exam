<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\helper\ViewBuilder;

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
    
    public function toStudent() {
        return $this;
    }
    
    /**
     * get all available exams of student
     * 
     * return Exam
     */
    public function exams() {
        $currentTime = date("Y-m-d H:i:s");
        
        $exams = Exam::join("exam_exam_assigns", "exam_exams.id", "=", "exam_id") 
                ->where("student_id", "=", $this->id)
                ->where("start_time", "<=", $currentTime)
                ->where("end_time", ">=", $currentTime);
        
        return $exams;
    }
      
    
    public function department() {
        return $this->belongsTo("App\Department");
    }
    
    public function studentExams() {
        return $this->hasMany("App\StudentExam", 'student_id');
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
 
    /**
     * build view object this will make view html
     *
     * @return ViewBuilder
     */
    public function getViewBuilder() {
        $builder = new ViewBuilder($this, "rtl");

        $levels = [];

        foreach(Level::all() as $item)
            $levels[] = [$item->id, $item->name];

        $departments = [];

        foreach(Department::all() as $item)
            $departments[] = [$item->id, $item->name . "-" . optional($item->level)->name];

        $builder->setAddRoute(url('/dashboard/student/store'))
                ->setEditRoute(url('/dashboard/student/update') . "/" . $this->id)
                //->setCol(["name" => "id", "label" => __('id'), "editable" => false])
                ->setCol(["name" => "code", "label" => __('code')])
                ->setCol(["name" => "name", "label" => __('name')])
                ->setCol(["name" => "national_id", "label" => __('national_id'), "required" => false])
                ->setCol(["name" => "set_number", "label" => __('set_number'), "required" => false])
                ->setCol(["name" => "phone", "label" => __('phone'), "required" => false])
                ->setCol(["name" => "password", "label" => __('password'), "type" => "password", "required" => false])
                ->setCol(["name" => "active", "label" => __('active'), "type" => "checkbox"])
                ->setCol(["name" => "level_id", "label" => __('level'), "type" => "select", "data" => $levels, "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setCol(["name" => "department_id", "label" => __('department'), "type" => "select", "data" => $departments, "col" => 'col-lg-12 col-md-12 col-sm-12'])

                //->setCol(["name" => "sms_code", "label" => __('sms_code'), "editable" => false])
                ->setCol(["name" => "account_confirm", "label" => __('confirm_account'), "editable" => false])
                ->setCol(["name" => "graduated", "label" => __('graduated'), "editable" => false])
                ->setCol(["name" => "can_see_result", "label" => __('can_see_result'), 'type' => 'checkbox'])
                ->setUrl(url('/image/students'))
                ->build();

        return $builder;
    }
}
