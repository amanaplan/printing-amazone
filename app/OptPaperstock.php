<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptPaperstock extends Model
{
    protected $table = 'paperstock_options';
    protected $guarded = ['option','id'];
    public $timestamps = false;
}
