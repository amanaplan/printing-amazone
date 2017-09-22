<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = ['id'];

    public function getcontentsAttribute($value)
    {
    	return preg_replace("/\[BASE_URL\]/", asset('assets/images/'), $value);
    }
}
