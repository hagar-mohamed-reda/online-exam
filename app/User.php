<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use \Illuminate\Database\Eloquent\SoftDeletes;

use App\helper\ViewBuilder;

class User  extends Authenticatable
{
    use SoftDeletes; 
    use Notifiable;
    
    /**
     * user enum of roles
     * 
     * @var String 
     */
    public static $STUDENT = "student";
    public static $DOCTOR = "doctor";
    public static $ADMIN = "admin";

    /**
     * name of table
     * 
     * @var String
     */
    protected $table = "users";

    /**
     * the attribute of table
     * 
     * @var Array 
     */
    protected $fillable = [ 
        'name',
        'username',
        'password',
        'department_id',
        'role',
        'is_paid',
        'active',
        'phone',
        'notes',
        'level',
        'section',
        'photo',
        'fid'
    ];
    
    /**
     * return doctor of user
     * 
     * @return Doctor
     */
    public function toDoctor() {
        return Doctor::find($this->fid);
    }
    
    /**
     * return student of user
     * 
     * @return Student
     */
    public function toStudent() {
        return Student::find($this->fid);
    }
    
    /**
     * return department of the user
     * 
     * @return Department
     */
    public function department() {
        return $this->belongsTo('App\Department');
    }
    
    /**
     * return courses of the user
     * 
     * @return DoctorCourse
     */
    public function doctorCourses() {
        $resource = $this->toDoctor(); 
        return $resource? $resource->doctorCourses() : Course::query(); 
    }
    
    /**
     * return questions of the user
     * 
     * @return Question
     */
    public function questions() {
        $resource = $this->toDoctor(); 
        return $resource? $resource->questions() : Question::query();  
    }
    
    /**
     * return categories of the user
     * 
     * @return Category
     */
    public function categories() {
        $resource = $this->toDoctor(); 
        return $resource? $resource->categories() : Category::query();   
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
        
        $data = [];
        foreach(Department::all() as $item)
            $data[] = [$item->id, $item->name];
        
        $data2 = [
            ["student" , __('student')],
            ["doctor" , __('doctor')],
            ["admin" , __('admin')], 
        ];
        
        $builder->setAddRoute(url('/user/store'))
                ->setEditRoute(url('/user/update') . "/" . $this->id)
                ->setCol(["name" => "id", "label" => __('id'), "editable" => false ])
                ->setCol(["name" => "name", "label" => __('name')])
                ->setCol(["name" => "username", "label" => __('username')])
                ->setCol(["name" => "password", "label" => __('password'), "type" => "password"])
                ->setCol(["name" => "role", "label" => __('role'), "type" => "select", "data" => $data2]) 
                ->setCol(["name" => "department_id", "label" => __('department'), "type" => "select", "data" => $data]) 
                ->setCol(["name" => "is_paid", "label" => __('is paid'), "type" => "checkbox"]) 
                ->setCol(["name" => "active", "label" => __('active'), "type" => "checkbox"]) 
                ->setCol(["name" => "phone", "label" => __('phone'), "required" => false]) 
                ->setCol(["name" => "notes", "label" => __('notes'), "required" => false, "type" => "textarea"]) 
                ->setCol(["name" => "level", "label" => __('level'), "required" => false]) 
                ->setCol(["name" => "section", "label" => __('section'), "required" => false]) 
                ->setCol(["name" => "photo", "label" => __('photo'), "required" => false, "type" => "image"]) 
                ->setUrl(url('/images/user'))
                ->build();

        return $builder;
    }
}
