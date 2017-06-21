<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptSize extends Model
{
    protected $table = 'size_options';
    protected $guarded = ['width','height','id'];
    public $timestamps = false;
}
