<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptLamination extends Model
{
    protected $table = 'lamination_options';
    protected $guarded = ['id'];
    public $timestamps = false;
}
