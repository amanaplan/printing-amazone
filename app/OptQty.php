<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptQty extends Model
{
    protected $table = 'qty_options';
    protected $guarded = ['option','id'];
    public $timestamps = false;
}
