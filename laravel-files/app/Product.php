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
}
