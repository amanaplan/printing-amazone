<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresetQtyGrpOne extends Model
{
    protected $table = 'preset_qty_rule_one';

    public $timestamps = false;

    protected $guarded = ['id'];
}
