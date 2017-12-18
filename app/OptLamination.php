<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptLamination extends Model
{
    protected $table = 'lamination_options';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function linkedproducts()
    {
        return $this->belongsToMany('App\Product', 'map_product_lamination', 'lamination_id', 'product_id');
    }
}
