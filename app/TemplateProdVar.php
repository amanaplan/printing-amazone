<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateProdVar extends Model
{
    protected $table = 'template_product_variations';
    protected $guarded = ['id'];
    
    public $timestamps = false;

    public function ofproduct()
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }
}
