<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMockupApprovalArtworks extends Model
{
    protected $table = 'order_artwork_approval_artworks';
    protected $guarded = ['id'];

    public $timestamps = false;
}
