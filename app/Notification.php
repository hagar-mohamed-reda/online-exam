<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    
    protected $table = "notifications";

    protected $fillable = [
        'id',
        'title',
        'body',
        'seen',
        'photo',
        'user_id'
    ];
    
    public static function notify($title, $body='') {
        Notification::create([
            "title" => $title,
            "body" => $body,
            "seen" => 0,
            "user_id" => Auth::user()->id,
        ]);
    }
    
    public function user() {
        return $this->belongsTo("App\User");
    }
     
}
