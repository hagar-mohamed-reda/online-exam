<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\helper\ViewBuilder;

class Doctor extends Model {

    protected $table = "doctors";
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
        'active',
        'account_confirm'
    ]; 
    
    /**
     * return courses of the user
     * 
     * @return DoctorCourse
     */
    public function doctorCourses() {
        return $this->hasMany('App\DoctorCourse');
    }
    
    /**
     * return courses of the user
     * 
     * @return DoctorCourse
     */
    public function courses() {
        return $this->hasMany('App\DoctorCourse');
    }
    
    /**
     * return questions of the user
     * 
     * @return Question
     */
    public function questions() {
        return $this->hasMany('App\Question')->latest();
    }
    
    /**
     * return categories of the user
     * 
     * @return Category
     */
    public function categories() {
        return $this->hasMany('App\Category', 'doctor_id')->latest();
    }
    
    /**
     * return categories of the user
     * 
     * @return Category
     */
    public function hardLevels() {
        return $this->hasMany('App\HardLevel', 'doctor_id')->latest();
    }
    
    /**
     * return categories of the user
     * 
     * @return Category
     */
    public function exams() {
        return $this->hasMany('App\Exam', 'doctor_id')->latest();
    }
    
    /**
     * return all student exam for doctor 
     * 
     * @return type
     */
    public function studentExams() {
        $examIds = Exam::where('doctor_id', $this->id)->pluck('id')->toArray();
        return StudentExam::whereIn('exam_id', $examIds);
    }

    /**
     * build view object this will make view html
     *
     * @return ViewBuilder
     */
    public function getViewBuilder() {
        $builder = new ViewBuilder($this, "rtl");

        $builder->setAddRoute(url('/dashboard/doctor/store'))
                ->setEditRoute(url('/dashboard/doctor/update') . "/" . $this->id)
                ->setCol(["name" => "id", "label" => __('id'), "editable" => false ])
                ->setCol(["name" => "name", "label" => __('name')])
                ->setCol(["name" => "phone", "label" => __('phone')])
                ->setCol(["name" => "password", "label" => __('password'), "type" => "password"])
                ->setCol(["name" => "active", "label" => __('active'), "type" => "checkbox"])
                ->setCol(["name" => "account_confirm", "label" => __('confirm_account'), "editable" => false])
                ->setUrl(url('/image/doctors'))
                ->build();

        return $builder;
    }
    
    
}
