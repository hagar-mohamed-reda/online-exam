<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    
    public static $lang = "Ar";

    
    public static function getLang() {
        if (session('locale')) {
            $lang = session('locale'); 
        } else {
            $lang = Setting::find(2)->value;
            session(["locale" => $lang]);
        }
        return $lang;
    }
}
