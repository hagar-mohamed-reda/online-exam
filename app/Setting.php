<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{ 
    protected $table = "exam_settings";

    protected $fillable = [
        'name',	'value'	 
    ];
}
