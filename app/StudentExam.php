<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    
    protected $table = "exam_student_exams";

    protected $fillable = [
        'exam_id',
        'student_id',
        'grade',
        'feedback',
        'is_started',
        'is_ended',
        'start_time',
        'end_time'	
    ];
    
    public function getGradeAttribute() {
        $grade = 0;
        foreach($this->studentAnswers()->get() as $item) {
            $grade += $item->grade;
        }
        
        $this->update([
            "grade" => $grade
        ]);
        
        return $grade;
    }
    
    public function student() {
        return $this->belongsTo("App\Student");
    }
    
    public function exam() {
        return $this->belongsTo("App\Exam");
    }
    
    public function studentAnswers() {
        return $this->hasMany("App\StudentAnswer", "student_exam_id");
    }
    
    public function getQuestions() {
        $qIds = $this->studentAnswers()->pluck('question_id')->toArray();
        $quetionQuery = Question::whereIn('id', $qIds);
        $categoryIds = Question::whereIn('id', $qIds)->select('category_id')->distinct()->pluck('category_id')->toArray();
        $categories = Category::whereIn('id', $categoryIds)->get();
        
        foreach($categories as $category) {
            $qq = clone $quetionQuery;
            $category->questions = $qq->where('category_id', $category->id)->get();
        }
        
        return $categories;
    }
    
    public function questionGrade() {
        $total = optional($this->exam)->total;
        $questionCount = $this->studentAnswers()->count();
        return round(($total / $questionCount), 2);
    }
}
