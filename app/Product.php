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

    public function stickertypes()
    {
      return $this->belongsToMany('App\StickerType', 'map_product_sticker_type', 'product_id', 'sticker_type_id');
    }

    public function laminations()
    {
      return $this->belongsToMany('App\OptLamination', 'map_product_lamination', 'product_id', 'lamination_id');
    }

    protected $casts = [
        'allow_custom_size' => 'boolean',
        'is_circle'         => 'boolean'
    ];
}
