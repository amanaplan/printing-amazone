<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateProducts extends Model
{
    protected $table = 'template_products';
    protected $guarded = ['id'];
    
    public $timestamps = false;

    public function category()
    {
    	return $this->belongsTo('App\TemplateCategory');
    }

    public function variations()
    {
    	return $this->hasMany('App\TemplateProdVar', 'product_id', 'id');
    }
}
