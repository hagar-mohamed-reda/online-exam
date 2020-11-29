<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * return questions of the user
     * 
     * @return Question
     */
    public function questions() {
        return $this->hasMany('App\Question');
    }
    
    /**
     * return categories of the user
     * 
     * @return Category
     */
    public function categories() {
        return $this->hasMany('App\Category', 'doctor_id');
    }

    
}
