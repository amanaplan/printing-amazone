<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapProdFrmOpt extends Model
{
   	protected $table = 'map_prod_form_options';
    protected $guarded = ['id'];
    public $timestamps = false;
}
