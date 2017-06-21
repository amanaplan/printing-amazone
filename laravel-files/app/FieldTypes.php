<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldTypes extends Model
{
    protected $table = 'form_field_types';
    protected $guarded = ['name','id'];
}
