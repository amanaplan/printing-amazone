<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function laminatingOpt()
    {
    	return $this->belongsTo('App\OptLamination', 'laminating');
    }
}
