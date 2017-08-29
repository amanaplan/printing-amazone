<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['order_token', 'transaction_id', 'user_id', 'price'];
}
