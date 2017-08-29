<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';
    protected $guarded = ['cc_fips', 'country_name'];
    public $timestamps = false;
}
