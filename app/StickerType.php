<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StickerType extends Model
{
	protected $guarded = ['id'];
    public $timestamps = false;

    public function linkedproducts()
    {
        return $this->belongsToMany('App\Product', 'map_product_sticker_type', 'sticker_type_id', 'product_id');
    }
}
