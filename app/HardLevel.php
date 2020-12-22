<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;


use App\helper\ViewBuilder;
 
class HardLevel extends Model
{ 

    protected $table = "exam_hard_levels";

    protected $fillable = [
        'name', 'doctor_id'
    ]; 
    
    public $appends = ['can_delete'];
    
    public function getCanDeleteAttribute() {
        return Question::where('hard_level_id', $this->id)->exists() ? false : true;
    }
    
    public function doctor() {
        return $this->belongsTo("App\Doctor");
    }

    /**
     * build view object this will make view html
     *
     * @return ViewBuilder
     */
    public function getViewBuilder() {
        $builder = new ViewBuilder($this, "rtl");
 
        $builder->setAddRoute(url('/hardlevel/store'))
                ->setEditRoute(url('/hardlevel/update') . "/" . $this->id)
                ->setCol(["name" => "id", "label" => __('id'), "editable" => false ])
                ->setCol(["name" => "name", "label" => __('name'), "type" => "textarea",  "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setCol(["name" => "notes", "label" => __('notes'), "type" => "textarea", "required" => false, "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setUrl(url('/images/hardlevel'))
                ->build();

        return $builder;
    }
}
