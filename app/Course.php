<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;


use App\helper\ViewBuilder;

class Course extends Model
{
     

    protected $table = "courses";

    protected $fillable = [
        'name',	'code',	'hours', 'notes'
    ];
    
    
    /**
     * check if this course assigned to doctor
     * 
     * @return boolean
     */
    public function hasDoctor($doctorId) {
        $doctorAssign = DoctorCourse::where("doctor_id", $doctorId)->where("course_id", $this->id)->first();
        
        if ($doctorAssign)
            return true;
        
        return false;
    }
    
    /**
     * check if this course assigned to department
     * 
     * @return boolean
     */
    public function hasDepartment($departId) {
        $courseDepartment = CourseDepartment::where("department_id", $departId)->where("course_id", $this->id)->first();
        
        if ($courseDepartment)
            return true;
        
        return false;
    }
    
    /**
     * return all doctor of course
     * 
     * @return type
     */
    public function doctorCourses() {
        return $this->hasMany("App\DoctorCourse");
    }
    
    /**
     * return all doctor of course
     * 
     * @return type
     */
    public function doctors() {
        return Doctor::whereIn('id', $this->doctorCourses()->pluck('doctor_id')->toArray());
    }
    
    /**
     * return all department of course
     * 
     * @return type
     */
    public function courseDepartments() {
        return $this->hasMany("App\CourseDepartment");
    }
    
    /**
     * return all department of course
     * 
     * @return type
     */
    public function studentCourses() {
        return $this->hasMany("App\StudentCourse");
    }
         
    /**
     * return all departments 
     * 
     * @return type
     */
    public function departments() {
        return Department::whereIn('id', $this->courseDepartments()->pluck('department_id')->toArray());
    }

    /**
     * build view object this will make view html
     *
     * @return ViewBuilder
     */
    public function getViewBuilder() {
        $builder = new ViewBuilder($this, "rtl");
 
        
        $builder->setAddRoute(url('/course/store'))
                ->setEditRoute(url('/course/update') . "/" . $this->id)
                ->setCol(["name" => "id", "label" => __('id'), "editable" => false ])
                ->setCol(["name" => "name", "label" => __('name'), "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setCol(["name" => "code", "label" => __('code'), "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setCol(["name" => "hours", "label" => __('hours'), "type" => "number", "value" => "0", "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setCol(["name" => "notes", "label" => __('notes'), "required" => false, "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setUrl(url('/images/course'))
                ->build();

        return $builder;
    }
}
