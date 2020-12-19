<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 


use App\helper\ViewBuilder;
 
class DegreeMap extends Model
{ 

    protected $table = "exam_degree_map";

    protected $fillable = [
        'name',	'gpa', 'key', 'percent_from', 'percent_to'
    ]; 
    
    public $appends = ['can_delete'];
    
    public function getCanDeleteAttribute() {
        return true;
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
 
        
        $builder->setAddRoute(url('/degreemap/store'))
                ->setEditRoute(url('/degreemap/update') . "/" . $this->id) 
                ->setCol(["name" => "percent_from", "label" => __('percent_from'), "type" => "number"])
                ->setCol(["name" => "percent_to", "label" => __('percent_from'), "type" => "number"])
                ->setCol(["name" => "name", "label" => __('name'), "type" => "text"])
                ->setCol(["name" => "key", "label" => __('key_'), "type" => "text"])
                ->setCol(["name" => "gpa", "label" => __('gpa'), "type" => "text"])
                ->setUrl(url('/images/degreemap'))
                ->build();

        return $builder;
    }
}
