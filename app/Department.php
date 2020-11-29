<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;


use App\helper\ViewBuilder;
 
class Department extends Model
{
    use SoftDeletes;

    protected $table = "departments";

    protected $fillable = [
        'name',	'notes' 
    ]; 

    /**
     * build view object this will make view html
     *
     * @return ViewBuilder
     */
    public function getViewBuilder() {
        $builder = new ViewBuilder($this, "rtl");
 
        
        $builder->setAddRoute(url('/department/store'))
                ->setEditRoute(url('/department/update') . "/" . $this->id)
                ->setCol(["name" => "id", "label" => __('id'), "editable" => false ])
                ->setCol(["name" => "name", "label" => __('name'), "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setCol(["name" => "notes", "label" => __('notes'), "required" => false, "col" => 'col-lg-12 col-md-12 col-sm-12'])
                ->setUrl(url('/images/department'))
                ->build();

        return $builder;
    }
}
