<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderBilling extends Model
{
	protected $table = 'order_billing';
    protected $guarded = ['id'];
    public $timestamps = false;
}
