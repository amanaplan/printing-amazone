<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresetGeneral extends Model
{
    protected $table = 'preset_general';

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $casts = [
	    'is_base' => 'boolean',
	];
}
