<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;


use App\helper\ViewBuilder;
 
class Category extends Model
{
    use SoftDeletes;

    protected $table = "exam_categories";

    protected $fillable = [
        'name',	'notes', 'doctor_id'
    ]; 
    
    public $appends = ['can_delete'];
    
    public function getCanDeleteAttribute() {
        return Question::where('category_id', $this->id)->exists() ? false : true;
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
 
        
        $builder->setAddRoute(url('/category/store'))
                ->setEditRoute(url('/category/update') . "/" . $this->id)
                ->setCol(["name" => "id", "label" => __('id'), "editable" => false ])
                ->setCol(["name" => "name", "label" => __('name'), "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setCol(["name" => "notes", "label" => __('notes'), "required" => false, "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setUrl(url('/images/category'))
                ->build();

        return $builder;
    }
}
