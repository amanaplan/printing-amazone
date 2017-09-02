<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Auth;

class Order extends Model
{
    protected $guarded = ['order_token', 'transaction_id', 'user_id', 'price'];

    public function billing()
    {
        return $this->hasOne('App\OrderBilling');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderStatus()
    {
        return $this->belongsTo('App\OrderStatus', 'status');
    }

    public function scopeOfType($query, $type)
    {
    	if($type == 'complete')
    	{
    		return $query->whereIn('status', [5,6]);
    	}

        return $query->whereNotIn('status', [5,6]);
    }

    public function scopeByToken($query, $token)
    {
        return $query->where('order_token', $token);
    }

    public function scopeOfCurrentUser($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function getCreatedAtAttribute($value)
    {
    	$dt = Carbon::parse($value);
        return $dt->toDayDateTimeString();
    }
}
