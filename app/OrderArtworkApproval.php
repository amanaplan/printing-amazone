<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderArtworkApproval extends Model
{
    protected $table = 'order_artwork_approval';
    protected $guarded = ['review_text'];

    protected $casts = [
        'approved'   => 'boolean',
    ];

    public function mockups()
    {
        return $this->hasMany('App\OrderMockupApprovalArtworks', 'artwork_approval_id');
    }
}
