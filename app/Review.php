<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = ['id'];

    public function scopePublished($query)
    {
        return $query->where('publish', 1);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('publish', 0);
    }

    public function user()
    {
		return $this->belongsTo('App\User');
    }

    public function product()
    {
		return $this->belongsTo('App\Product');
    }
}
