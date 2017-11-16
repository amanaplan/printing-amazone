<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['product_slug','id'];

    public function formfields()
    {
		return $this->belongsToMany('App\FieldTypes', 'map_prod_form', 'product_id', 'form_field_id')->withPivot('id','form_field_id');
    }

    public function review()
    {
		return $this->hasMany('App\Review');
    }

    public function category()
    {
		return $this->belongsTo('App\Category');
    }

    public function variations()
    {
        return $this->hasMany('App\TemplateProdVar', 'product_id');
    }

    protected $casts = [
        'allow_custom_size' => 'boolean',
        'is_circle'         => 'boolean'
    ];
}
