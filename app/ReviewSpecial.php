<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewSpecial extends Model
{
    protected $table = 'review_special';
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
}
