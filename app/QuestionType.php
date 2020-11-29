<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class QuestionType extends Model
{
    
    use SoftDeletes;

    protected $table = "exam_question_types";

    protected $fillable = [
        'name',	'icon'
    ]; 
}
