<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $casts = [
        'mockup_approved'   => 'boolean',
    ];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function laminatingOpt()
    {
    	return $this->belongsTo('App\OptLamination', 'laminating');
    }

    public function artworks()
    {
        return $this->hasMany('App\OrderArtworkApproval', 'order_item_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
