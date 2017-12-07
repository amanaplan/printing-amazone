<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $guarded = ['price'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function artworks()
    {
        return $this->hasMany('App\CartArtworks', 'cart_id', 'id');
    }

    public function paperstockopt()
    {
        return $this->belongsTo('App\OptPaperstock', 'paperstock');
    }
}
