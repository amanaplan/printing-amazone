<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapFrmProd extends Model
{
    protected $table = 'map_prod_form';
    protected $guarded = ['id'];
    public $timestamps = false;
}
