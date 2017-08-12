<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpecial extends Model
{
    protected $table = 'product_special';
    protected $guarded = ['product_slug','id'];

    public function review()
    {
		return $this->hasMany('App\ReviewSpecial', 'special_product_id', 'id');
    }
}
