<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{ 
    protected $table = "exam_settings";

    protected $fillable = [
        'name',	'value'	 
    ];
    
    public static function getSetting($id) {
        $setting = Setting::find($id);
        if (!$setting)
            $setting::create([
                "id" => $id,
                "name" => "-",
                "value" => "-"
            ]);
        
        return $setting;
    }
    
}
