<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateCategory extends Model
{
    protected $table = 'template_category';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function products()
    {
    	return $this->hasMany('App\TemplateProducts', 'category_id', 'id');
    }
}
