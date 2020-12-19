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
        'end_time',
        'degree_map_id'
    ];
    
    protected $appends = [
        'degree_map'
    ];

    public function getDegreeMapAttribute() {
        $degree = $this->calculateDegreeMap();
        $this->update([
            "degree_map_id" => optional($degree)->id
        ]);
        return $degree;
    }

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
    
    public function getBlankQuestions() {
        $ids =  $this->studentAnswers()
                ->join('exam_questions', 'exam_questions.id', '=', 'question_id')
                ->where('question_type_id', 4) 
                ->pluck('question_id')
                ->toArray();
        return Question::whereIn('id', $ids)->get();
    }
    
    public function calculateDegreeMap() {
        $percent = (($this->grade) / optional($this->exam)->total) * 100;
        return DegreeMap::where('percent_from', '<=', $percent)->where('percent_to', ">=", $percent)->first();
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
